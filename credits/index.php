<?php
	require_once '../files/config.php';
				
	session_start();

	if(!isset($_SESSION['user_login'])) {
		header("location: ../connexion/login/");
	}
				
	$id = $_SESSION['user_login'];
				
	$select_stmt = $db->prepare("SELECT * FROM tbl_user WHERE user_id=:uid");
	$select_stmt->execute(array(":uid"=>$id));
	
	$row=$select_stmt->fetch(PDO::FETCH_ASSOC);


	$articles = $db->query('SELECT * FROM articles ORDER BY date_publication DESC');
	$auteur = $db->query('SELECT * FROM tbl_user');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
		<title>Bar Chat - Home</title>

		<link rel="shortcut icon" href="../../files/images/favicon.ico" type="image/x-icon">

  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  		<link rel="stylesheet" type="text/css" href="../files/css/footer.css">
  		<link rel="stylesheet" type="text/css" href="../files/css/all.css">
	</head>
	<body style="background-color: #232323;">
		<!-- INCLUDE NAVBAR -->
		<?php include('../files/includes/navbar-autre.php') ?>
		<!-- -------------- -->
		<div>
			<center>
				<div>
					<h1>Crédits</h1>
				</div>
				<div>
					<p style="color: white;">
						<span style="color: lightblue;">Loïc</span> <i>(Développeur du site)</i>,
						<span style="color: lightblue;">Zoseq</span> <i>(Designer du logo)</i>
					</p>
				</div>
			</center>
		</div>
		<!-- INCLUDE FOOTER -->
		<?php include('../files/includes/footer.php') ?>
		<!-- -------------- -->
	</body>
</html>