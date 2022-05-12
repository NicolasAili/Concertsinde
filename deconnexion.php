<?php
/*
	Type fichier : php
	Fonction : Permet de se déconnecter
	Emplacement : action
	Connexion à la BDD : oui  
	Contenu HTML : non
	JS+JQuery : non
	CSS : non
*/
?>
<?php
	include '../php/error.php';  
	require '../php/connectcookie.php';
	require '../php/database.php';
?>
<?php
    unset($_SESSION['pseudo']);
    unset($_SESSION['password']);
    session_unset();

	setcookie("passwd", null, time() - 3600, "/");
	setcookie('login', null, time() - 3600, "/");

    header('Location: ../index.php');
?>