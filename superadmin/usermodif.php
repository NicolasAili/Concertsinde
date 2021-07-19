<?php
require('../php/database.php');
$points = $_POST['points'];
$points_session = $_POST['points_session'];
$pseudo = $_POST['pseudo'];
$admincheck = $_POST['admincheck'];
$bannicheck = $_POST['bannicheck'];
$action = $_POST['modsuppr'];

$message = $_POST['message'];


$requestpseudo = "SELECT id_user FROM utilisateur WHERE pseudo = '$pseudo'";
$query = mysqli_query($con, $requestpseudo);
$row = mysqli_fetch_array($query);
$idpseudo = $row['id_user'];

if($action == 'Valider')
{
	$sql = "UPDATE utilisateur SET points = '$points', points_session = '$points_session', admin = '$admincheck', banni = '$bannicheck' WHERE pseudo = '$pseudo' ";
	$query = mysqli_query($con ,$sql);
}
else if($action == 'Message')
{
	echo "message à ";
	echo $pseudo;
	?>
	<form  method="post" id="connect" action="usermodif.php">
			<textarea name="message" id="message" cols="40" rows="5"></textarea>
			<input type="hidden" class="pseudo" name="pseudo" <?php echo 'value="' . $pseudo . '"' ?> >
			<input id="envoimsg" type="submit" name="envoimsg" value="Envoi">
	</form>
 <?php
}
else if($message)
{
	$sql = "INSERT INTO message (message, utilisateur) VALUES ('$message', '$idpseudo')";
	$query = mysqli_query($con ,$sql);
}
else
{
	echo "erreur";
}


	


?>