<?php
define('Copyright', '����QQ����Ψһ�M�Ԓ��');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$db = new DB();
$db = new DB();
include_once (dirname(__FILE__)."/yeepayCommon.php");
/*
 * @Description �ױ�֧��B2C����֧���ӿڷ��� 
 * @V3.0
 * @Author rui.xin
 */ 
	
#	ֻ��֧���ɹ�ʱ�ױ�֧���Ż�֪ͨ�̻�.
##֧���ɹ��ص������Σ�����֪ͨ������֧����������е�p8_Url�ϣ�������ض���;��������Ե�ͨѶ.

#	�������ز���.
$return = getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);

#	�жϷ���ǩ���Ƿ���ȷ��True/False��
$bRet = CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
#	���ϴ���ͱ�������Ҫ�޸�.
	 	
#	У������ȷ.
if($bRet){
	if($r1_Code=="1"){
		
	#	��Ҫ�ȽϷ��صĽ�����̼����ݿ��ж����Ľ���Ƿ���ȣ�ֻ����ȵ�����²���Ϊ�ǽ��׳ɹ�.
	#	������Ҫ�Է��صĴ������������ƣ����м�¼�������Դ����ڽ��յ�֧�����֪ͨ���ж��Ƿ���й�ҵ���߼�������Ҫ�ظ�����ҵ���߼�������ֹ��ͬһ�������ظ��������������.  
		if($r9_BType=="2"){ 
			echo "success"; 
		}
		$hao_sdcustomno=$r6_Order; 
		$hao_ordermoney = $r3_Amt;
		$res=$db->query("select p.status,p.g_name,u.g_money_yes from g_payrecord p left join g_user u on p.g_name=u.g_name where p.ordernum='{$hao_sdcustomno}'",1); 
		if($res[0]['status']=="3"){
			$db->query("UPDATE g_payrecord set status=1 where ordernum='{$hao_sdcustomno}'",0);
			$db->query("UPDATE g_user SET g_money_yes=g_money_yes+$hao_ordermoney where g_name='".$res[0]['g_name']."'",0);
		} 
		$valueList = array();
		$valueList['g_name'] = $res[0]['g_name'];
		$valueList['g_f_name'] = $_SESSION['sName'];
		$valueList['g_initial_value'] = $res[0]['g_money_yes'];
		$valueList['g_up_value'] = $res[0]['g_money_yes']+$hao_ordermoney;
		$valueList['g_up_type'] = '��ֵ';
		$valueList['g_s_id'] = 1;
		insertLogValue($valueList);
		
		echo "<BR>֧���ɹ�!";
		echo "<BR>�̻�������: $hao_sdcustomno"; 
		echo "<BR>֧�����: $hao_ordermoney"; 
	}
	
}else{
	echo "������Ϣ���۸�";
}
   
?> 