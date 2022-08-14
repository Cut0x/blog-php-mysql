<?php
$db_host="mysql-la-papote.alwaysdata.net"; 
$db_user="la-papote";
$db_password="Loic2||005||";   
$db_name="la-papote_blog";

try {
	$db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOEXCEPTION $e) {
	$e->getMessage();
}
?>