<?php
require_once "../../files/config.php";

if(isset($_REQUEST['btn_register'])) {
	$username = strip_tags($_REQUEST['txt_username']);
	$email = strip_tags($_REQUEST['txt_email']);
	$password = strip_tags($_REQUEST['txt_password']);
		
	if (empty($username)) {
		$errorMsg[] = "Entrez un pseudo";
	} else if (empty($email)) {
		$errorMsg[] = "Entrez un email";
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errorMsg[] = "Entrez un email valide";
	} else if (empty($password)) {
		$errorMsg[] = "Entrez un mot de passe";
	} else if (strlen($password) < 6) {
		$errorMsg[] = "Votre mot de passe doit faire minimum 6 caractères";
	} else {	
		try {	
			$select_stmt=$db->prepare("SELECT username, email FROM tbl_user WHERE username=:uname OR email=:uemail");
			
			$select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email));
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			
			try {
				if (!isset($errorMsg)) {
					$new_password = password_hash($password, PASSWORD_DEFAULT);
					
					$insert_stmt=$db->prepare("INSERT INTO tbl_user	(username,email,password) VALUES (:uname,:uemail,:upassword)");				
					
					if ($insert_stmt->execute(array(':uname' =>$username, ':uemail' =>$email, ':upassword'=>$new_password))) {
						$registerMsg='Succès de l\'enregistrement !';
						header('location: ../login/');
					}
				}
			} catch(PDOException $e) {
				$errorMsg[] = "Email ou nom d'utilisateur déjà utilisé";
			}
		} catch(PDOException $e) {
			//echo $e
		}
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
		<title>Bar Chat - Register</title>

		<link rel="shortcut icon" href="../../files/images/favicon.ico" type="image/x-icon">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="../../files/css/footer.css">
		<link rel="stylesheet" type="text/css" href="../../files/css/all.css">

		<!--<script src="https://js.hcaptcha.com/1/api.js?hl=fr" async defer></script>-->
	</head>
	<body style="background-color: #232323; color: white;">
		<!-- INCLUDE NAVBAR -->
		<?php include('../../files/includes/navbar-register.php') ?>
		<!-- -------------- -->
		<div class="wrapper">
			<div class="container">
				<div class="col-lg-12">
		
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
						if(isset($registerMsg)) {
					?>
								<div class="alert alert-success">
									<strong><img src="../../files/images/svg/check.svg"> <?php echo $registerMsg; ?></strong>
								</div>
        			<?php
						}
					?>
					<center><h2>Page d'enregistrement</h2></center>
					<form method="post" class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-3 control-label">
								Pseudo <span style="color: red;">*</span>
							</label>
							<div class="col-sm-6">
								<input type="text" name="txt_username" class="form-control" placeholder="Entrez un pseudo" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Email <span style="color: red;">*</span></label>
							<div class="col-sm-6">
								<input type="text" name="txt_email" class="form-control" placeholder="Entrez une email" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Mot de passe <span style="color: red;">*</span></label>
							<div class="col-sm-6">
								<input type="password" name="txt_password" class="form-control" placeholder="Entre un mot de passe" />
							</div>
						</div>

						<div><center>
      				<input type="checkbox" id="scales" name="scales" required>
      					<label for="scales">J'ai lu et j'accepte <a href="../../cu/">les conditions d'utilisation</a></label></center>
    					</div>
    <!--<div class="h-captcha"
      data-sitekey="dd297b3d-1310-4b91-a4d5-fccc925202eb"
      data-theme="dark"
      data-error-callback="onError"
    ></div>-->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9 m-t-15">
								<input type="submit"  name="btn_register" class="btn btn-primary "  value="Enregistrer">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9 m-t-15">
								Tu as déjà un compte d'enregistré ? <a href="../login/"><p class="text-info">Connecte toi !</p></a>		
							</div>
						</div>
					</form>
				</div>
			</div>	
		</div>
		<!-- INCLUDE FOOTER -->
		<?php include('../../files/includes/footer-login-register.php') ?>
		<!-- -------------- -->					
	</body>
</html>