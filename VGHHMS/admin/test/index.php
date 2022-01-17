<?php
	header("Content-Type:text/html; charset=utf-8");
	
	ini_set('display_errors', '1');
	
	echo phpinfo();
	
	try{
		// $db_server = '211.20.169.178';
		// $db_name = 'VGHHMS';
		// $db_user = 'sa';
		// $db_pass = 'uhome168..';

		$db_server = 'ftp.uhome.tw';
		$db_name = 'VGHHMS';
		$db_user = 'sa';
		$db_pass = 'osun000';
		
		$conn = mssql_connect($db_server, $db_user, $db_pass);
	} catch(Exception $e){
		echo $e->getMessage();
	}
	
	
	
?>