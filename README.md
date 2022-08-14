# Blog PHP MySQL
Voici un blog open-source fait en PHP, CSS, Bootstrap &amp; MySQL !

# Configuration
Dans le fichier `config.php`, si vous êtes en localhost, le code ressemble à ça *(sous windows)*
### *Le fichier se trouve dans `./files/config.php`*
```php
<?php
$db_host="localhost"; 
$db_user="root";
$db_password=""; // Sous windows, root ne possède pas de mot de passe
$db_name="db_name";

try {
	$db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOEXCEPTION $e) {
	$e->getMessage();
}
?>
```

# Comment est construite la base de donnée ?
<table>
    <thead>
        <tr>
            <th colspan="8">tbl_user</th>
        </tr>
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Type</td>
            <td>Collation</td>
            <td>Attributes</td>
            <td>Null</td>
            <td>Default</td>
            <td>Extra</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>user_id</td>
            <td>int(11)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td>AUTO_INCREMENT</td>
        </tr>
        <tr>
            <td>2</td>
            <td>username</td>
            <td>varchar(15)</td>
            <td>utf8mb4_general_ci</td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

# Comment faire du localhost simplement ?
Je vous laisse télécharger mon tutorel en pdf !
<a href="" target="_blank"><img style="widht: 60%;" src="https://cdn.discordapp.com/attachments/914271938359210045/1008477462352646296/36C3-PDF-encryption-featured2.jpg" alt="logo PDF"></a>
