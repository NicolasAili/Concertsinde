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
	require('php/database.php');
?>
<?php
    unset($_SESSION['pseudo']);
    header('Location: ./accueil.php');
?>