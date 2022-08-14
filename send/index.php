<?php
	require_once '../files/config.php';
				
	session_start();

	if(!isset($_SESSION['user_login'])) {
		header("location: ../connexion/login/");
	};
				
	$id = $_SESSION['user_login'];


		if (!empty($_POST['txt_article_content'])) {
			$article_author_id = $_SESSION['user_login'];
			$article_title = htmlspecialchars($_POST['txt_article_title']);
			$article_content = htmlspecialchars($_POST['txt_article_content']);

			$ins = $db->prepare('INSERT INTO articles (authorId, content, date_publication) VALUES (?, ?, NOW())');
			$ins->execute(array($article_author_id, $article_content));
			$YesMsg = 'Publication posté avec succès. Vous allez être redirigé !';
			header("location: ../home/");
		} else {
			$errorMsg[] = 'Veuillez remplir tous les champs.';
		}

	$select_stmt = $db->prepare("SELECT * FROM tbl_user WHERE user_id=:uid");
	$select_stmt->execute(array(":uid"=>$id));
	
	$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
	$articles = $db->query('SELECT * FROM articles ORDER BY date_publication DESC');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
		<title>Bar Chat - Profile</title>

<link rel="shortcut icon" href="../files/images/favicon.ico" type="image/x-icon">

  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  		<link rel="stylesheet" type="text/css" href="../files/css/footer.css">
  		<link rel="stylesheet" type="text/css" href="../files/css/all.css">
	</head>
	<body style="background-color: #232323; color: white;">
		<!-- INCLUDE NAVBAR -->
		<?php include('../files/includes/navbar-send.php') ?>
		<!-- -------------- -->
		<div class="wrapper">
			<div class="container">	
				<div class="col-lg-12">
					<center><p><a href="../home/"><- Retour</a></p></center>
		
					<?php
						if(isset($errorMsg)) {
							foreach($errorMsg as $error) {
					?>
								<div class="alert alert-danger">
									<strong><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-slash-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.646-2.646a.5.5 0 0 0-.708-.708l-6 6a.5.5 0 0 0 .708.708l6-6z"/></svg> <?php echo $error; ?></strong>
								</div>
            		<?php
							}
						}
						if(isset($YesMsg)) {
					?>
								<div class="alert alert-success">
									<strong><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg> <?php echo $YesMsg; ?></strong>
								</div>
        			<?php
						}
					?>   
			        <center><h2>Poster une publication</h2></center>
			        <form method="post" class="form-horizontal">
        				<div class="form-group">
		            		<label class="col-sm-3 control-label">Contenu</label>
				            <div class="col-sm-6">
				                <textarea style="background-color: #2f2929; color: white;" rows="20" name="txt_article_content" class="form-control" placeholder="Ecrivez le contenu ici"></textarea>
								<p>
									Pour sauter une ligne : <strong>\n</strong> <i>(Exemple: Coucou<strong>\n</strong>ça va ?)</i>
								</p>
				            </div>
				        </div>
        				<div class="form-group">
		            		<div class="col-sm-offset-3 col-sm-9 m-t-15">
				                <input type="submit" name="btn_article" class="btn btn-success" value="Publier">
				            </div>
				        </div>
        			</form>
				</div>
			</div>	
		</div>
		<!-- INCLUDE FOOTER -->
		<?php include('../files/includes/footer.php') ?>
		<!-- -------------- -->					
	</body>
</html>"