<?php
require_once "../../files/config.php";

session_start();

if(isset($_SESSION["user_login"])) {
	header("location: ../../home/");
}

if(isset($_REQUEST['btn_login'])) {
	$username	=strip_tags($_REQUEST["txt_username_email"]);
	$email		=strip_tags($_REQUEST["txt_username_email"]);
	$password	=strip_tags($_REQUEST["txt_password"]);
		
	if (empty($username)) {						
		$errorMsg[] = "Veuillez entrer votre pseudo ou votre email";
	} else if (empty($email)) {
		$errorMsg[] = "Veuillez entrer votre pseudo ou votre email";
	} else if (empty($password)) {
		$errorMsg[] = "Veuillez entrer votre mot de passe";
	} else {
		try {
			$select_stmt=$db->prepare("SELECT * FROM tbl_user WHERE username=:uname OR email=:uemail");
			$select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email));
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($select_stmt->rowCount() > 0) {
				if ($username==$row["username"] OR $email==$row["email"]) {
					if (password_verify($password, $row["password"])) {
						$_SESSION["user_login"] = $row["user_id"];
						$_SESSION["certified"] = $row["certified"];
						$loginMsg = 'Succès de connexion !';
						header("refresh:0; ../../home/");
					} else {
						$errorMsg[] = "Mauvais mot de passe";
					}
				} else {
					$errorMsg[] = "Mauvais pseudo ou email";
				}
			} else {
				$errorMsg[] = "Mauvais pseudo ou email";
			}
		} catch(PDOException $e) {
			$e->getMessage();
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
		<title>Bar Chat - Login</title>

		<link rel="shortcut icon" href="../../files/images/favicon.ico" type="image/x-icon">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="../../files/css/footer.css">
		<link rel="stylesheet" type="text/css" href="../../files/css/all.css">
	</head>
	<body style="background-color: #232323; color: white;">
		<!-- INCLUDE NAVBAR -->
		<?php include('../../files/includes/navbar-login.php') ?>
		<!-- -------------- -->
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		
			<center>
				<?php
					if(isset($errorMsg)) {
						foreach($errorMsg as $error) {
				?>
				<div class="alert alert-danger">
					<strong><img src="../../files/images/svg/error.svg"> <?php echo $error; ?></strong>
				</div>
        <?php
						}
					}
					if(isset($loginMsg)) {
				?>
				<div class="alert alert-success">
					<strong><img src="../../files/images/svg/check.svg"> <?php echo $loginMsg; ?></strong>
				</div>
        <?php
					}
				?>
			</center>
			<center><h2>Page de connexion</h2></center>
			<form method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-3 control-label">Pseudo ou Email</label>
					<div class="col-sm-6">
						<input type="text" name="txt_username_email" class="form-control" placeholder="Entrez votre pseudo ou votre email" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Mot de Passe</label>
					<div class="col-sm-6">
						<input type="password" name="txt_password" class="form-control" placeholder="Entrez votre mot de passe" />
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9 m-t-15">
						<input type="submit" name="btn_login" class="btn btn-success" value="Connexion">
						<a href="../register/" name="" class="btn btn-info">Créer un compte</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	</div>
		<!-- INCLUDE NAVBAR -->
		<?php include('../../files/includes/footer-login-register.php') ?>
		<!-- -------------- -->		
	</body>
</html>