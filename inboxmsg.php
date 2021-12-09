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
<?php
    session_start();
?>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'contenu/reseaux.php';
			require('php/database.php');
			require('php/error.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/inboxmsg.css">
	</head>
	<header>
		<?php include('contenu/header.php'); ?>
	</header>
	<body>
		<?php
		if (isset($_SESSION['pseudo']) == null)
		{
			echo "erreur, vous devez être connecté pour accéder à ce contenu";
		}
		else
		{
			$pseudo = $_SESSION['pseudo'];
			$requestpseudo = "SELECT id_user FROM utilisateur WHERE pseudo = '$pseudo'";
			$query = mysqli_query($con, $requestpseudo);
			$row = mysqli_fetch_array($query);
			$idpseudo = $row['id_user'];

			$idtopic = $_GET['idtopic'];
			if(!$idtopic)
			{
				$idtopic = $_POST['idtopic'];
				$message = $_POST['message'];
				$sql = "INSERT INTO message (utilisateur, message, id_topic) VALUES ('$idpseudo', '$message', '$idtopic')";
				$query = mysqli_query($con, $sql);
			}

			$sql = "UPDATE message SET lu='1' WHERE id_topic = $idtopic AND utilisateur != '$idpseudo'";
			$query = mysqli_query($con, $sql);

			$sql = "SELECT objet FROM topic where id = $idtopic";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);
			$objettopic = $row['objet'];

			$sql = "SELECT message, id, utilisateur, date_envoi FROM message WHERE id_topic = $idtopic ORDER BY date_envoi ASC";
			$query = mysqli_query($con, $sql);?>
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
					{?>
						<div class="msg"><?php
							$pseudop = $row['utilisateur'];
							$requestpseudo = "SELECT pseudo FROM utilisateur WHERE id_user = '$pseudop'";

							$querytest = mysqli_query($con, $requestpseudo);
							$rowp = mysqli_fetch_array($querytest);
							$pseudop = $rowp['pseudo'];?>
							<div class="head">
								<div class="pseudo"><?php echo $pseudop;?></div>
								<div class="dateenvoi"><?php echo $row['date_envoi'];?></div>
							</div>
							<div class="message">
								<pre> <?php echo $row['message']; ?> </pre> <?php
								echo "<br>";?>
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
	</body>
</html>


