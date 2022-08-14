<?php
	require_once '../files/config.php';
				
	session_start();

	if(!isset($_SESSION['user_login'])) {
		header("location: ../connexion/login/");
	};
	
	$articles = $db->query('SELECT * FROM articles ORDER BY date_publication DESC');

   	$select_stmt_idU = htmlspecialchars($_GET['id']);
	$select_stmtU = $db->prepare("SELECT * FROM tbl_user WHERE user_id=:uid");
	$select_stmtU->execute(array(":uid"=>$_SESSION['user_login']));

	$rowU = $select_stmtU->fetch(PDO::FETCH_ASSOC);

	if(isset($_GET['id']) AND !empty($_GET['id'])) {
   		$select_stmt_id = htmlspecialchars($_GET['id']);
		$select_stmt = $db->prepare("SELECT * FROM tbl_user WHERE user_id=:uid");
		$select_stmt->execute(array(":uid"=>$_GET['id']));

		$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
		<title>Bar Chat - <?= $row['username'] ?></title>

		<link rel="shortcut icon" href="../../files/images/favicon.ico" type="image/x-icon">

  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  		<link rel="stylesheet" type="text/css" href="../files/css/footer.css">
  		<link rel="stylesheet" type="text/css" href="../files/css/all.css">
	</head>
	<body style="background-color: #232323; color: white;">
		<!-- INCLUDE NAVBAR -->
		<?php include('../files/includes/navbar-user.php') ?>
		<!-- -------------- -->
		<div class="wrapper">
			<div class="container">	
				<div class="col-lg-12">
					<center>
						<img src="<?= $row['avatar'] ?>" alt="Logo HTML w3" style="width:100px; height:auto; border-radius: 60px;" class="float-left">
						<h1><a href="javascript:void();">@<span style="<?php
		            		if ($row['admin'] == 1) {
		            			echo "color: #DE1010;";
		            		} else {
		            			echo "color: white;";
		            		}
		            	?>"><strong><?= $row['username']; ?></a></h1>
						<div style="color: darkblue;">
							<?php
							if ($row['betatest'] > 0) {
								echo ' <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bug-fill" viewBox="0 0 16 16"><path d="M4.978.855a.5.5 0 1 0-.956.29l.41 1.352A4.985 4.985 0 0 0 3 6h10a4.985 4.985 0 0 0-1.432-3.503l.41-1.352a.5.5 0 1 0-.956-.29l-.291.956A4.978 4.978 0 0 0 8 1a4.979 4.979 0 0 0-2.731.811l-.29-.956z"/><path d="M13 6v1H8.5v8.975A5 5 0 0 0 13 11h.5a.5.5 0 0 1 .5.5v.5a.5.5 0 1 0 1 0v-.5a1.5 1.5 0 0 0-1.5-1.5H13V9h1.5a.5.5 0 0 0 0-1H13V7h.5A1.5 1.5 0 0 0 15 5.5V5a.5.5 0 0 0-1 0v.5a.5.5 0 0 1-.5.5H13zm-5.5 9.975V7H3V6h-.5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 0-1 0v.5A1.5 1.5 0 0 0 2.5 7H3v1H1.5a.5.5 0 0 0 0 1H3v1h-.5A1.5 1.5 0 0 0 1 11.5v.5a.5.5 0 1 0 1 0v-.5a.5.5 0 0 1 .5-.5H3a5 5 0 0 0 4.5 4.975z"/></svg>';
							};
							if ($row['graphiste'] > 0) {
								echo ' <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16"><path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/></svg>';
							};
							if ($row['certified'] > 0) {
								echo ' <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16"><path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/></svg>';
							};
							if ($row['admin'] > 0) {
								echo ' <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16"><path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z"/></svg>';
							};
							?>
						</div>
					</center>
					<div>
						<center>
							<h1>Ses Publications</h1>
						</center>
		    			<?php while($a = $articles->fetch()) {
							$id = $a['authorId'];
							$idArticle = $a['id'];

							$likes = $db->prepare('SELECT id FROM likes WHERE id_article = ?');
							$likes->execute(array($a['id']));
							$likes->rowCount();

							$dislikes = $db->prepare('SELECT id FROM dislikes WHERE id_article = ?');
							$dislikes->execute(array($a['id']));
							$dislikes->rowCount();

							$newDescr = trim(str_replace('\n', '<br>', $a['content']));

							if ($id == $row['user_id']) {
    					?>
          				<div id="<?= $a['id'] ?>" class="row row-centered pos">
            				<div class="col-lg-8 col-xs-12 col-centered" style="background-color: #2f2929; margin-bottom: 10px; border-radius: 20px">
                   				<p style="font-size:x-large;">
                     				<?= $newDescr; ?>
                   				</p>
                       			<i style="font-size:small;">Publié le <strong><?= $a['date_publication'] ?></strong></i>
							<br><button class="btn btn-primary" onclick='window.location.href="../actions/?t=1&id=<?= $a['id']; ?>&user=<?= $_SESSION['user_login']; ?>"'> ❤️ <?= $likes->rowCount(); ?></button>
				            </div>
        		        </div>
            			<?php
            					}
            				} 
            			?>
						
					</div>
				</div>
			</div>	
		</div><br><br>
		<!-- INCLUDE FOOTER -->
		<?php include('../files/includes/footer.php') ?>
		<!-- -------------- -->					
	</body>
</html>