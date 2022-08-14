<?php
require_once '../files/config.php';

if (isset($_GET['like'], $_GET['id']) AND !empty($_GET['like']) AND !empty($_GET['id'])) {
	$getid = (int) $_GET['id'];
	$gett = (int) $_GET['like'];

	$sessionid = $_GET['user'];

	$check = $db->prepare('SELECT * FROM articles WHERE id = ?');
	$check->execute(array($getid));

	if ($check->rowCount() == 1) {
		if ($gett == 1) {
			$check_likes = $db->prepare('SELECT * FROM likes WHERE id_article = ? AND id_membre = ?');
			$check_likes->execute(array($getid, $sessionid));

			$del = $db->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
			$del->execute(array($getid, $sessionid));

			if ($check_likes->rowCount() == 1) {
				$del = $db->prepare('DELETE FROM likes WHERE id_article = ? AND id_membre = ?');
				$del->execute(array($getid, $sessionid));
			} else {
				$ins = $db->prepare('INSERT INTO likes (id_article, id_membre) VALUES (?, ?)');
				$ins->execute(array($getid, $sessionid));
			}
		}
   		header('Location: '.$_SERVER['HTTP_REFERER']);
	} else {
		exit('Erreur fatale 1');
	}
} else {
	exit('Erreur fatale 2');
}
?>