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

	if(isset($_REQUEST['btn_send'])) {
		if (!empty($_POST['txt_article_content'])) {
			$article_author_id = $_SESSION['user_login'];
			$article_content = htmlspecialchars($_POST['txt_article_content']);

			$ins = $db->prepare('INSERT INTO articles (authorId, content, date_publication) VALUES (?, ?, NOW())');
			$ins->execute(array($article_author_id, $article_content));
			$YesMsg = 'Publication posté avec succès.';
			header("location: ".$_SERVER['HTTP_REFERER']);
		} else {
			$errorMsg[] = 'Veuillez remplir tous les champs.';
		}
	}

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
		<?php include('../files/includes/navbar-home.php') ?>
		<!-- -------------- -->
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3520658157164824" crossorigin="anonymous"></script>
        <div class="container" style="width:90%;">
					<center>
					<?php
						if(isset($errorMsg)) {
							foreach($errorMsg as $error) {
					?>
								<div style="width: 300px; height: 50px;" class="alert alert-danger">
									<strong><img src="../files/images/svg/error.svg"> <?php echo $error; ?></strong>
								</div>
            		<?php
							}
						}
						if(isset($YesMsg)) {
					?>
								<div style="width: 300px; height: 50px;" class="alert alert-success">
									<strong><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg> <?php echo $YesMsg; ?></strong>
								</div>
        			<?php
						}
					?>
						<form method="post" class="form-horizontal">
							<textarea style="float: left; background-color: #2f2929; color: white; width: 400px; height: 35px;" name="txt_article_content" class="form-control" placeholder="Quoi de neuf ? (utilise \n pour sauter une ligne)"></textarea>

							<input style="float: left;" type="submit" name="btn_send"  class="btn btn-primary" value='Envoyer'>
						</form><br><br>
					</center>
			<h1 style="color: white;">Les Publications</h1>
		    <?php while($a = $articles->fetch()) {

	$id = $a['authorId'];
				
	$select_stmt = $db->prepare("SELECT * FROM tbl_user WHERE user_id=:uid");
	$select_stmt->execute(array(":uid"=>$id));
	
	$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

	$likes = $db->prepare('SELECT id FROM likes WHERE id_article = ?');
	$likes->execute(array($a['id']));
	$likes->rowCount();
	
	$check_likes = $db->prepare('SELECT * FROM likes WHERE id_article = ? AND id_membre = ?');
	$check_likes->execute(array($a['id'],$id));

	$result = '';

	if ($check_likes->rowCount() > 0) {
		$result = "❤️";
	} else {
		$result = "❤️";
	}

		    	?>
                <div class="row row-centered pos">
		            <div id="<?= $a['id'] ?>" class="col-lg-8 col-xs-12 col-centered" style="background-color: #2f2929; color: white; margin-bottom: 10px; border-radius: 20px">
		            	<img src="<?= $row['avatar'] ?>" alt="Logo HTML w3" style="width:30px; height:auto; border-radius: 60px;" class="float-left"/> <a href="../user/?id=<?= $row['user_id'] ?>">@<span style="<?php
		            		if ($row['admin'] == 1) {
		            			echo "color: #DE1010;";
		            		} else {
		            			echo "color: white;";
		            		}
		            	?>"><strong><?= $row['username']; ?></a></strong></span> <span style="color: darkblue;"><?php
							if ($row['certified'] > 0) {
								echo ' <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
								<path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
							  </svg>';
							}; ?></span></strong>
                        <p style="font-size:x-large;">
                            <?= str_replace('\n', '<br>', $a['content']); ?>
                        </p>
                        <i style="font-size:small;">Publié le <strong><?= $a['date_publication'] ?></strong></i>
							<br><button class="btn btn-primary" onclick='window.location.href="../actions/?like=1&id=<?= $a['id']; ?>&user=<?= $_SESSION['user_login']; ?>"'>  <?= $result; ?> <?= $likes->rowCount(); ?></button>
		            </div>
                </div>
            <?php } ?>
        </div>
		<!-- INCLUDE FOOTER -->
		<?php include('../files/includes/footer.php') ?>
		<!-- -------------- -->
	</body>
</html>