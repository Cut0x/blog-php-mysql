# Blog PHP MySQL
Voici un blog open-source fait en PHP, CSS, Bootstrap &amp; MySQL !

# Configuration
Dans le fichier `config.php`, si vous êtes en localhost, le code ressemble à ça *(sous windows)*
```php
<?php
$db_host="localhost"; 
$db_user="root";
$db_password="";   
$db_name="db_name";

try {
	$db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOEXCEPTION $e) {
	$e->getMessage();
}
?>
```
# Comment faire du localhost simplement ?
Je vous laisse télécharger mon tutorel en pdf !
<a href="" target="_blank"><img style="widht: 60%;" src="https://cdn.discordapp.com/attachments/914271938359210045/1008477462352646296/36C3-PDF-encryption-featured2.jpg" alt="logo PDF"></a>
