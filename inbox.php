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

			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/inbox.css">
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
			$requestpseudo = "SELECT admin, id_user FROM utilisateur WHERE pseudo = '$pseudo'";
			$query = mysqli_query($con, $requestpseudo);
			$row = mysqli_fetch_array($query);
			$idpseudo = $row['id_user'];
			$admin = $row['admin'];

			$lu = 0;

			if ($admin == 2) 
			{
				$sql = "SELECT DISTINCT topic.id, objet, date_creation, sender, MAX(message.date_envoi) FROM topic, message WHERE topic.id = message.id_topic AND topic.sender = '$idpseudo' GROUP BY topic.id ORDER BY MAX(message.date_envoi) DESC, topic.id";
			}
			else
			{
				$sql = "SELECT DISTINCT topic.id, objet, date_creation, sender, MAX(message.date_envoi) FROM topic, message WHERE topic.id = message.id_topic AND topic.receiver = '$idpseudo' GROUP BY topic.id ORDER BY MAX(message.date_envoi) DESC, topic.id";
			}
			
			$query = mysqli_query($con, $sql);

			?>
			<div id="intro">
				<?php
				if ($admin == 2) 
				{?>
					Arpenid.com > messages <a href=superadmin/users.php> ➕ Créer un nouveau sujet </a> <?php
				}
				else
				{?>
					Arpenid.com > messages <a href=contact.php class="sendnew"> ➕ Envoyer un nouveau message </a> <?php
				}?>
			</div>
			<table>
	    		<tr>
		        	<th scope="col" id="message">Message de</th>
		       		<th scope="col" id="sujet">Sujet</th>
		        	<th scope="col" id="date">Dernier message</th>
				</tr><?php
				while($row = mysqli_fetch_array($query))
				{
					$lu = 0;
					$idtopic = $row['id'];
					$pseudosender = $row['sender'];

					$sql = "SELECT lu FROM message WHERE id_topic = '$idtopic' AND utilisateur != '$idpseudo'";
					$querylu = mysqli_query($con, $sql);
					while($rowl = mysqli_fetch_array($querylu))
					{
						if($rowl['lu'] == 0)
						{
							$lu = 1;
						}
					}
					$sql = "SELECT MAX(id) AS id FROM message WHERE id_topic = '$idtopic'";
					$queryid = mysqli_query($con, $sql);
					$rowm = mysqli_fetch_array($queryid);
					$idmessage = $rowm['id'];

					$sql = "SELECT date_envoi FROM message WHERE id = $idmessage";
					$querydate = mysqli_query($con, $sql);
					$rowd = mysqli_fetch_array($querydate);
					$dateenvoi = $rowd['date_envoi'];
					$dateenvoi = date("d-m-Y G:i:s", strtotime($dateenvoi));


					$requestpseudo = "SELECT pseudo FROM utilisateur WHERE id_user = '$pseudosender'";
					$querypseudo = mysqli_query($con, $requestpseudo);
					$rowp = mysqli_fetch_array($querypseudo);
					$pseudosender = $rowp['pseudo'];
				?>
				<form method="post" id="connect" action="usermodif.php">
					<tr>
						<td scope="row"><?php echo $pseudosender; ?></td>
						<td scope="row"><?php echo '<a href="inboxmsg.php?idtopic='; echo $idtopic; echo '">'; if($lu == 1){echo "<strong>";} echo $row['objet']; if($lu == 1){echo "</strong>";} echo '</a>' ?></td> 
						<td scope="row"><?php if ($admin == 2){echo $row['date_creation'];}else{echo $dateenvoi;} ?></td>
					</tr>
				</form><?php			
				}?>
			</table><?php		
		}?>
		<?php include('contenu/footer.html'); ?>
	</body>
</html>

<script>
	width = $('table').width();
	doc = $( window ).width();
	margin = (doc - width)/2;
	$('#intro').css('width', width);
	$('#intro').css('margin-left', margin);
</script>