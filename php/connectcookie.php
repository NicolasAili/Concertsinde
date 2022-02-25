<?php
session_start();
include 'php/database.php';
$pseudo = $_SESSION['pseudo'];
$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
$result = mysqli_query($con ,$sql);
$row = mysqli_fetch_array($result);
$admin = $row['admin'];

if ($admin == 2) 
{
	$sql = "SELECT date_debut, date_fin, actif FROM session WHERE actif = 1";
	$query = mysqli_query($con, $sql);
	$rowsession = mysqli_fetch_array($query);
	$datedebut = $rowsession['date_debut'];
	$datefin = $rowsession['date_fin'];
	$sended = 0;

	$currentdate = date('Y-m-d');
	$curr = new DateTime($currentdate);
	$date = new DateTime($datefin);
						
	$intvl = $curr->diff($date);

	$requestpseudo = "SELECT id_user FROM utilisateur WHERE admin = 2";
	$query = mysqli_query($con, $requestpseudo);
	$row = mysqli_fetch_array($query);
	$sender = $row['id_user'];

	$sql = "SELECT id, date_creation FROM topic WHERE objet = 'RAPPEL SESSION'";
	$query = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_array($query)) 
	{
		$datemsg = $row['date_creation'];
		$datemsg = new DateTime($datemsg);
		$intvl = $curr->diff($datemsg);
		if ($intvl->m == 0 && $intvl->y == 0) 
		{
			if ($intvl->d < 5) 
			{
				$sended = 1;
			}
		}
	}
	if ($sended == 0) 
	{
		if ($intvl->m == 0 && $intvl->y == 0) 
		{
			if ($intvl->d < 4) 
			{
				$sql = "INSERT INTO topic (objet, date_creation, sender, receiver) VALUES ('RAPPEL SESSION', NOW(), $sender, $sender)";
				$query = mysqli_query($con ,$sql);

				$sql = "SELECT MAX(id) AS id_max FROM topic"; //on recupere l'ID le plus haut 
				$query = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($query);
				$idtopicmax = $row['id_max'];

				$sql = "INSERT INTO message (message, utilisateur, id_topic) VALUES ('RAPPEL: changement de session dans moins de 3 jours', '$sender', $idtopicmax)";
				$query = mysqli_query($con ,$sql);
			}
		}
	}
}

if (isset($_COOKIE['login']) && !isset($_SESSION['pseudo'])) 
{
    $_SESSION['pseudo'] = $_COOKIE['login'];
	$_SESSION['password'] = $_COOKIE['passwd'];
}
setcookie('contentMessage', '', 1, "/");
setcookie('contentMessage', '', 1);
?>