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
            <td>01</td>
            <td>user_id</td>
            <td>int(11)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td>AUTO_INCREMENT</td>
        </tr>
        <tr>
            <td>02</td>
            <td>username</td>
            <td>varchar(15)</td>
            <td>utf8mb4_general_ci</td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
        <tr>
            <td>03</td>
            <td>avatar</td>
            <td>text</td>
            <td>utf8mb4_general_ci</td>
            <td></td>
            <td>No</td>
            <td>'https://.../default_user.png'</td>
            <td></td>
        </tr>
        <tr>
            <td>04</td>
            <td>email</td>
            <td>varchar(40)</td>
            <td>utf8mb4_general_ci</td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
        <tr>
            <td>05</td>
            <td>password</td>
            <td>varchar(225)</td>
            <td>utf8mb4_general_ci</td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
        <tr>
            <td>06</td>
            <td>followers</td>
            <td>bigint(20)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
        <tr>
            <td>07</td>
            <td>betatest</td>
            <td>tinyint(1)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>0</td>
            <td></td>
        </tr>
        <tr>
            <td>08</td>
            <td>graphiste</td>
            <td>tinyint(1)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>0</td>
            <td></td>
        </tr>
        <tr>
            <td>09</td>
            <td>certified</td>
            <td>tinyint(1)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>0</td>
            <td></td>
        </tr>
        <tr>
            <td>10</td>
            <td>admin</td>
            <td>tinyint(1)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>0</td>
            <td></td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th colspan="8">articles</th>
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
            <td>01</td>
            <td>id</td>
            <td>int(11)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td>AUTO_INCREMENT</td>
        </tr>
        <tr>
            <td>02</td>
            <td>authorId</td>
            <td>bigint(20)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
        <tr>
            <td>03</td>
            <td>content</td>
            <td>varchar(1000)</td>
            <td>utf8mb4_general_ci</td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
        <tr>
            <td>04</td>
            <td>date_publication</td>
            <td>datetime</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th colspan="8">likes</th>
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
            <td>01</td>
            <td>id</td>
            <td>int(11)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td>AUTO_INCREMENT</td>
        </tr>
        <tr>
            <td>02</td>
            <td>id_article</td>
            <td>int(11)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
        <tr>
            <td>03</td>
            <td>id_membre</td>
            <td>int(11)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th colspan="8">dislikes</th>
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
            <td>01</td>
            <td>id</td>
            <td>int(11)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td>AUTO_INCREMENT</td>
        </tr>
        <tr>
            <td>02</td>
            <td>id_article</td>
            <td>int(11)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
        <tr>
            <td>03</td>
            <td>id_membre</td>
            <td>int(11)</td>
            <td></td>
            <td></td>
            <td>No</td>
            <td>None</td>
            <td></td>
        </tr>
    </tbody>
</table>

# Comment faire du localhost simplement ?
Je vous laisse télécharger mon tutorel en pdf !
<a href="" target="_blank"><img style="widht: 60%;" src="https://cdn.discordapp.com/attachments/914271938359210045/1008477462352646296/36C3-PDF-encryption-featured2.jpg" alt="logo PDF"></a>
