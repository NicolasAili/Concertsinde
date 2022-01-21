<?php
/*
	Type fichier : php
	Fonction : modifier points, points sessions, admin, banni d'un user + envoi de msg
	Emplacement : superadmin
	Connexion à la BDD : oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : non
*/
require('../php/database.php');
session_start();
$points = $_POST['points'];
$points_session = $_POST['points_session'];
$pseudo = $_POST['pseudo'];
$admincheck = $_POST['admincheck'];
$bannicheck = $_POST['bannicheck'];
$action = $_POST['modsuppr'];

$message = $_POST['message'];
$topic = $_POST['topic'];

$sender = $_SESSION['pseudo'];

$requestpseudo = "SELECT id_user FROM utilisateur WHERE pseudo = '$sender'";
$query = mysqli_query($con, $requestpseudo);
$row = mysqli_fetch_array($query);
$sender = $row['id_user'];


$requestpseudo = "SELECT id_user FROM utilisateur WHERE pseudo = '$pseudo'";
$query = mysqli_query($con, $requestpseudo);
$row = mysqli_fetch_array($query);
$idpseudo = $row['id_user'];

if($action == 'Valider')
{
	$sql = "UPDATE utilisateur SET points = '$points', points_session = '$points_session', admin = '$admincheck', banni = '$bannicheck' WHERE pseudo = '$pseudo' ";
	$query = mysqli_query($con ,$sql);
	echo "action effectuée avec succès";
	echo "<br>";
	echo "<a href=users.php> retour </a>";
}
else if($action == 'Message')
{
	echo "Nouveau fil de discussion avec ";
	echo $pseudo;
	?>
	<form  method="post" id="connect" action="usermodif.php">
			<input name="topic" id="topic" placeholder="objet du fil">
			<br>
			Message : 
			<br>
			<textarea name="message" id="message" cols="40" rows="5"></textarea>
			<input type="hidden" class="pseudo" name="pseudo" <?php echo 'value="' . $pseudo . '"' ?> >
			<input id="envoimsg" type="submit" name="envoimsg" value="Envoi">
	</form>
 <?php
}
else if($message)
{
	$sql = "INSERT INTO topic (objet, date_creation, sender, receiver) VALUES ('$topic', NOW(), $sender, $idpseudo)";
	$query = mysqli_query($con ,$sql);
	echo "<br>";

	$sql = "SELECT MAX(id) AS id_max FROM topic"; //on recupere l'ID le plus haut 
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	$idtopicmax = $row['id_max'];

	$sql = "INSERT INTO message (message, utilisateur, id_topic) VALUES ('$message', '$sender', $idtopicmax)";
	$query = mysqli_query($con ,$sql);
	header("Location: users.php");
}
else
{
	echo "erreur";
}

?>