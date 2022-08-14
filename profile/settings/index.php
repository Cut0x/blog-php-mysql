<?php
	require_once '../../files/config.php';
				
	session_start();

	if(!isset($_SESSION['user_login'])) {
		header("location: ../../connexion/login/");
	}
				
	$id = $_SESSION['user_login'];
				
	$select_stmt = $db->prepare("SELECT * FROM tbl_user WHERE user_id=:uid");
	$select_stmt->execute(array(":uid"=>$id));
	
	$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

	if(isset($_REQUEST['btn_edit_profile'])) {
		if (!empty($_POST['txt_username'])) {
			$article_author_id = $_SESSION['user_login'];
			$new_username = htmlspecialchars($_POST['txt_username']);

			$ins = $db->prepare("UPDATE tbl_user SET username=? WHERE user_id='".$id."'");
			$ins->execute(array($new_username));
			if ($row['certified'] > 0) {
				$cert = $db->prepare("UPDATE tbl_user set certified=? WHERE user_id='".$id."'");
				$cert->execute(array(0));
				$add_text = " Vous avez perdu votre logo certifié !";
			} else {
				$add_text = "";
			}
			header("location: ".$_SERVER['HTTP_REFERER']);
			$YesMsg = 'Pseudo modifier avec succès.'.$add_text.'';
		};
		if (!empty($_POST['txt_email'])) {
			$article_author_id = $_SESSION['user_login'];
			$new_email = htmlspecialchars($_POST['txt_email']);

			$ins = $db->prepare("UPDATE tbl_user SET email=? WHERE user_id='".$id."'");
			$ins->execute(array($new_email));
			header("location: ".$_SERVER['HTTP_REFERER']);
			$YesMsg = 'Email modifier avec succès.';
		};
		if (empty($_POST['txt_email']) AND empty($_POST['txt_username']) AND empty($_POST['txt_avatar'])) {
			$errorMsg[] = 'Veuillez introduire des modifications pour pouvoir modifier.';
		};

	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
		<title>Bar Chat - Profile</title>

<link rel="shortcut icon" href="../../../files/images/favicon.ico" type="image/x-icon">

  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  		<link rel="stylesheet" type="text/css" href="../../files/css/footer.css">
  		<link rel="stylesheet" type="text/css" href="../../files/css/all.css">
	</head>
	<body style="background-color: #232323; color: white;">
		<!-- INCLUDE NAVBAR -->
		<?php include('../../files/includes/navbar-profile-settings.php') ?>
		<!-- -------------- -->
		<div class="wrapper">
			<div class="container">	
				<div class="col-lg-12">
					<?php
						if(isset($errorMsg)) {
							foreach($errorMsg as $error) {
					?>
								<div class="alert alert-danger">
									<strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-slash-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.646-2.646a.5.5 0 0 0-.708-.708l-6 6a.5.5 0 0 0 .708.708l6-6z"/></svg> <?php echo $error; ?></strong>
								</div>
            		<?php
							}
						}
						if(isset($registerMsg)) {
					?>
								<div class="alert alert-success">
									<strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg> <?php echo $registerMsg; ?></strong>
								</div>
        			<?php
						}
					?>
					<p><a class="btn btn-primary" href="../">< Retour</a></p>
                	<div class="row row-centered pos">
                		<center>
                			<h1>Vos informations </h1>
                			<h3><?php if ($row['certified'] > 0) {
                				echo "<br>Si vous modifiez votre pseudo, vous perdez votre badge certifié ! (Voir <a href='../../cu/#certification'>les conditions d'utilisations</a>)<br><br>";
                			} ?></h3>
                		</center>
                		<form method="post" class="form-horizontal">
                			<div class="form-group">
								<label class="col-sm-3 control-label">
									Votre pseudo :
								</label>
								<div class="col-sm-6">
									<input type="text" name="txt_username" class="form-control" style="width: 200px;" placeholder="<?= $row['username'] ?>" />
								</div>
                			</div>

                			<div class="form-group">
								<label class="col-sm-3 control-label">
									Votre email :
								</label>
								<div class="col-sm-6">
									<input type="email" name="txt_email" class="form-control" style="width: 200px;" placeholder="<?= $row['email'] ?>"/>
								</div>
                			</div>

                			<div class="form-group">
								<label class="col-sm-3 control-label">
									Votre avatar : <span style="color: lightcoral;">¹</span><br>
									<span style="color: lightcoral;">¹</span> : <i>Pas encore disponible</i>
								</label>
								<div class="col-sm-6">
									<input type="text" name="txt_avatar" class="form-control" style="width: 200px; pointer-events: none;" placeholder="<?= $row['avatar'] ?>" />
								</div>
                			</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9 m-t-15">
									<input type="submit"  name="btn_edit_profile" class="btn btn-primary" value="Enregistrer les modifications">
									<a href="" name="" class="btn btn-danger" style="pointer-events: none;">Supprimer mon compte</a>
								</div>
							</div>
                		</form>
					</div>
				</div>
			</div>	
		</div>
		<!-- INCLUDE FOOTER -->
		<?php include('../../files/includes/footer-profile-settings.php') ?>
		<!-- -------------- -->					
	</body>
</html>