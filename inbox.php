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

			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/inbox.css">
	</head>
	<header>
		<?php include('contenu/header.php'); ?>
	</header>
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

		$lu = 0;

		$sql = "SELECT DISTINCT topic.id, objet, date_creation, sender, MAX(message.date_envoi) FROM topic, message WHERE topic.id = message.id_topic AND topic.receiver = '$idpseudo' GROUP BY topic.id ORDER BY MAX(message.date_envoi) DESC, topic.id";
		$query = mysqli_query($con, $sql);

		?>
		<table>
    		<caption>Liste des fils de discussion</caption>
    		<tr>
	        	<th scope="col">Message de</th>
	       		<th scope="col">Sujet</th>
	        	<th scope="col">Date</th>
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
				$requestpseudo = "SELECT pseudo FROM utilisateur WHERE id_user = '$pseudosender'";
				$querypseudo = mysqli_query($con, $requestpseudo);
				$rowp = mysqli_fetch_array($querypseudo);
				$pseudosender = $rowp['pseudo'];
			?>
			<form method="post" id="connect" action="usermodif.php">
				<tr>
					<td scope="row"><?php echo $pseudosender; ?></td>
					<td scope="row"><?php echo '<a href="inboxmsg.php?idtopic='; echo $idtopic; echo '">'; if($lu == 1){echo "<strong>";} echo $row['objet']; if($lu == 1){echo "</strong>";} echo '</a>' ?></td> 
					<td scope="row"><?php echo $row['date_creation']; ?></td>
				</tr>
			</form><?php			
			}?>
		</table><?php		
	}?>
</html>

<?php 
/* 
 
1) trier les topics par nouveaux messages x
2) mettre en gras si un topic comporte des messages non lus x
3) mettre en lu lors du clic sur le topic x
4) vérifier que les nouveauxmessages s'affichent bien sur le profil du header
5) vérifier la lecture des messages depuis admin
6) bouton pour nouveau topic admin dans les MP

*/?>