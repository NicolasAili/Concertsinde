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
    session_start();
 ?>
<?php      
	require('../php/database.php');
?>
<?php
    //unset($_SESSION['pseudo']);
    //unset($_SESSION['password']);
    session_unset();
    echo $_COOKIE['login'];
	echo "<br>";
	echo $_COOKIE['passwd'];
	echo "xxxxxxxxxxxxxxx";

    setcookie("login", "", time() - 3600);
	setcookie("passwd", "", time() - 3600);

	echo $_COOKIE['login'];
	echo "<br>";
	echo $_COOKIE['passwd'];
    //header('Location: ../accueil.php');
?>