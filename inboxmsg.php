<?php
/*
	Type fichier : php
	Fonction : page profil
	Emplacement : /
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			require 'php/connectcookie.php';
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'php/js.php';
			include 'contenu/reseaux.php';
			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/inboxmsg.css">
	</head>
	<?php
	if (isset($_SESSION['pseudo']) == null)
	{
		echo "erreur, vous devez être connecté pour accéder à ce contenu";
	}
	else
	{
		$pseudo = $_SESSION['pseudo'];
		$requestpseudo = "SELECT id_user, admin FROM utilisateur WHERE pseudo = '$pseudo'";
		$query = mysqli_query($con, $requestpseudo);
		$row = mysqli_fetch_array($query);
		$idpseudo = $row['id_user'];
		$admin = $row['admin'];

		$idtopic = $_GET['idtopic'];
		if(!$idtopic)
		{
			$idtopic = $_POST['idtopic'];
			$message = $_POST['message'];
			$sql = "INSERT INTO message (utilisateur, message, id_topic) VALUES ('$idpseudo', '$message', '$idtopic')";
			$query = mysqli_query($con, $sql);
			?>
			<script>
				$(document).ready(function() {
           			$("html, body").animate({
                		scrollTop: $('html, body').get(0).scrollHeight
                	}, 2000);
    			});
			</script><?php
		}

		$sql = "UPDATE message SET lu='1' WHERE id_topic = $idtopic AND utilisateur != '$idpseudo'";
		if($admin == 2)
		{
			$sql = "UPDATE message SET lu='1' WHERE id_topic = $idtopic";
		}
		$query = mysqli_query($con, $sql);

		$sql = "SELECT objet FROM topic where id = $idtopic";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		$objettopic = $row['objet'];

		$sql = "SELECT message, id, utilisateur, date_envoi FROM message WHERE id_topic = $idtopic ORDER BY date_envoi ASC";
		$query = mysqli_query($con, $sql);?>
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<body>
			<div id="top">
				Arpenid.com > messages > <strong> <?php echo $objettopic; ?> </strong>
			</div>
			<div id="main">
				<div class="retour">
					<a href="inbox.php"> ⏎ Retour liste des messages </a>
				</div>
				<h1>
					<?php echo $objettopic; ?> 
				</h1>
				<div id="fil"> <?php
					while($row = mysqli_fetch_array($query)) 
					{
						$dateenvoi = $row['date_envoi'];
						$dateenvoi = date("d-m-Y G:i:s", strtotime($dateenvoi));
						?>
						<div class="msg"><?php
							$pseudop = $row['utilisateur'];
							$requestpseudo = "SELECT pseudo FROM utilisateur WHERE id_user = '$pseudop'";

							$querytest = mysqli_query($con, $requestpseudo);
							$rowp = mysqli_fetch_array($querytest);
							$pseudop = $rowp['pseudo'];?>
							<div class="head">
								<div class="pseudo"><?php echo $pseudop;?></div>
								<div class="dateenvoi"><?php echo $dateenvoi;?></div>
							</div>
							<div class="message">
								<?php echo nl2br($row['message']); ?>
							</div>
						</div><?php
					}?>
					<div class="retour">
						<a href="inbox.php"> ⏎ Retour liste des messages </a>
					</div>
					<div id="repondre">
						Répondre
					</div>
					<form action="inboxmsg.php" method="post">
						<textarea name="message" id="messageinput" placeholder="Entrez votre message, soyez respecteux et courtois"></textarea>
						<input type="hidden" id="idtopic" name="idtopic" <?php echo 'value='; echo $idtopic;?>>
						<br>
						<input type="submit" id="envoi" value="Envoyer">
					</form>
				</div>
			</div><?php
		}?>
		<?php include('contenu/footer.html'); ?>
	</body>
</html>


