<?php
	error_reporting(E_ALL^E_WARNING^E_NOTICE);
	include("config.php");
	$hao_customerid=$MerId;// '�̻�ID
	$hao_orderNumber=$_REQUEST["orderNumber"];// '�̻���ˮ��
	$hao_ordermoney=$_REQUEST["ordermoney"];//  '�����ܽ��
	$hao_key=$merchantKey;//  '�̻���Կ
	$hao_cardNo=$_REQUEST["cardNo"];//  'ͨ������
	$hao_faceNo=$_REQUEST["faceNo"];// '����ֵ���
	$hao_cardNum=$_REQUEST["cardnum"];// '��ֵ����
	$hao_cardPass=$_REQUEST["cardpass"];// '��ֵ������
	$hao_Mark=$_REQUEST["Mark"];// '�̻��Զ���
	$hao_reMarks=$_REQUEST["reMarks"];// '�̻���ע
	$hao_getawayurl="http://www.xdpay.com/service/GateWay.aspx";//  '�����ַ���������ǵ�֧���ĵ�ַ������ַ�Ƿ��������Ե��ύ��ʽ��ַ  
	$str_sign="customerid=$hao_customerid&orderNumber=$hao_orderNumber&key=$hao_key";   //ƴ�ռ��ܴ� 
	$hao_sign=strtoupper(md5($str_sign)) ;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body onLoad="get_FORM.submit()">
<form action="<?php echo $hao_getawayurl?>" method="post" name="get_FORM" > 
  <!--���¼���Ϊ����֧����Ҫ��Ϣ����Ϣ������ȷ������Ϣ��Ӱ��֧�����У�-->   
  <input type="hidden"  name="customerid"        value="<?php echo $hao_customerid?>"><!--�̻�ID-->
  <input type="hidden"  name="orderNumber"        value="<?php echo $hao_orderNumber?>"><!--�̻���ˮ��-->
  <input type="hidden"  name="ordermoney"        value="<?php echo $hao_ordermoney?>"><!--�������-->
  <input type="hidden"  name="cardNo"        value="<?php echo $hao_cardNo?>"><!--ͨ������-->
  <input type="hidden"  name="sign"        value="<?php echo $hao_sign?>"><!--MD5ǩ��-->
  <input type="hidden"  name="faceNo"        value="<?php echo $hao_faceNo?>"><!--����ֵ���-->
  <input type="hidden"  name="cardNum"        value="<?php echo $hao_cardNum?>"><!--��ֵ����-->
  <input type="hidden"  name="cardPass"        value="<?php echo $hao_cardPass?>"><!--��ֵ������-->
  <input type="hidden"  name="Mark"        value="<?php echo $hao_Mark?>"><!--�̻��Զ���-->
  <input type="hidden"  name="reMarks"        value="<?php echo $hao_reMarks?>"><!--�̻���ע--> 
</form>
</body>
</html>