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

	if ($row['admin'] == 0) {
		header('location: ../connexion/login/');
	}


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
		<?php include('../files/includes/navbar-admin.php') ?>
		<!-- -------------- -->
        <div class="container" style="width:90%;">
			<h1 style="color: white;">Gérer Les Publications</h1>
		    <?php while($a = $articles->fetch()) {

	$id = $a['authorId'];
				
	$select_stmt = $db->prepare("SELECT * FROM tbl_user WHERE user_id=:uid");
	$select_stmt->execute(array(":uid"=>$id));
	
	$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

	$likes = $db->prepare('SELECT id FROM likes WHERE id_article = ?');
	$likes->execute(array($a['id']));
	$likes->rowCount();

	$dislikes = $db->prepare('SELECT id FROM dislikes WHERE id_article = ?');
	$dislikes->execute(array($a['id']));
	$dislikes->rowCount();
		    	?>
                <div class="row row-centered pos">
		            <div id="<?= $a['id'] ?>" class="col-lg-8 col-xs-12 col-centered" style="background-color: #2f2929; color: white; margin-bottom: 10px; border-radius: 20px">
		            	<img src="<?= $row['avatar'] ?>" alt="Logo HTML w3" style="width:30px; height:auto; border-radius: 60px;" class="float-left"/> @<strong><?= $row['username']; ?> <span style="color: darkblue;"><?php
							if ($row['certified'] > 0) {
								echo ' <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
								<path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
							  </svg>';
							}; ?></span></strong>
                        <p style="font-size:x-large;">
                            <?= $a['content']
							.str_replace('<br>', '<br>', '<br>')
							.str_replace('<script>', '', '') ?>
                        </p>
                        <i style="font-size:small;">Publié le <strong><?= $a['date_publication'] ?></strong></i>
			        <form method="post" class="form-horizontal">
				                <a href="../delete-admin/?id=<?= $a['id'] ?>" class="btn btn-danger"> 🗑️ Supprimer</a>
        			</form>
		            </div>
                </div>
            <?php } ?>
        </div>
		<!-- INCLUDE FOOTER -->
		<?php include('../files/includes/footer.php') ?>
		<!-- -------------- -->
	</body>
</html>