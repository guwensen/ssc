<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-18
*/
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php'; 
$rows=$db->query("select g_id from g_kaipan_lhc where g_feng_date>'".date("Y-m-d H:i:s")."' And g_lock=2",3); 
if ( $rows<1 )
{
	header("Location: ./right.php"); exit;
}
?>