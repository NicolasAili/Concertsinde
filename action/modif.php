<?php
/*
	Type fichier : php
	Fonction : modifier son mot de passe
	Emplacement : action
	Connexion à la BDD : oui  
	Contenu HTML : non
	JS+JQuery : non
	CSS : non
*/
?>
<?php
	require '../php/connectcookie.php';      
	require('../php/database.php');

if (isset($_POST['modif_password']))
	$password = $_POST['password'];
	$newpassword = $_POST['newpassword'];
	$cnewpassword = $_POST['cnewpassword'];
	$mail = $_POST['mail'];
	$key = $_POST['key'];
	$pass = $_SESSION['password'];
	$user = $_SESSION['pseudo'];

	$passwordh = hash('sha512', $password);

	require ('../php/inject.php'); //0) ajouter inject et définir redirect
	$redirect = '../resetpassword.php';

	$inject = array(); 
	$returnval = inject($mail, 'mail'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
	if (!is_null($returnval)) 
	{
	  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
	}
	$returnval = inject($key, 'num'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
	if (!is_null($returnval)) 
	{
	  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
	}
	$validate = validate($inject, $redirect); //3)validation de tous les champs
	if($validate == 0) //4) si pas d'injection : ajout des variables
	{
	  $mail = mysqli_real_escape_string($con, $mail); 
	  $key = mysqli_real_escape_string($con, $key); 
	}


	if($mail) //réinitialisation du mot de passe
	{
		$passwordh = hash('sha512', $newpassword);
		if ($newpassword == $cnewpassword)
		{
			$sql = "UPDATE utilisateur SET password = '$passwordh' WHERE email = '$mail'";
			$result = mysqli_query($con ,$sql);
			setcookie('contentMessage', 'Mot de passe réinitialisé avec succès', time() + 15, "/");
			header("Location: ../connexion.php");
			exit("Mot de passe réinitialisé avec succès");

		}
		else
		{
			$sql = "UPDATE oublimdp SET actif = 1 WHERE keyid = '$key'";
			$result = mysqli_query($con ,$sql);
			setcookie('contentMessage', 'Erreur: le mot de passe saisi et sa confirmation ne correspondent pas, veuillez réessayer', time() + 15, "/");
			header("Location: ../resetpassword.php?key=" . $key . "");
			exit("Erreur: le mot de passe saisi et sa confirmation ne correspondent pas, veuillez réessayer");
		}
	}
	else //modification du mot de passe
	{
		if ($passwordh == $pass ) 
		{
			$passwordh = hash('sha512', $newpassword);
			if ($newpassword == $cnewpassword)
			{
				$sql = "UPDATE utilisateur SET password = '$passwordh' WHERE pseudo = '$user'";
				$result = mysqli_query($con ,$sql);
				$_SESSION['password']=$newpassword;
				setcookie('contentMessage', 'Mot de passe modifié avec succès !', time() + 15, "/");
				header("Location: ../profil.php");
				exit("Mot de passe modifié avec succès !");
			}
			else 
			{	
				setcookie('contentMessage', 'Erreur: le mot de passe saisi et sa confirmation ne correspondent pas, veuillez réessayer', time() + 15, "/");
				header("Location: ../resetpassword.php");
				exit("Erreur: le mot de passe saisi et sa confirmation ne correspondent pas, veuillez réessayer");
			}
		}
		else 
		{ 
			setcookie('contentMessage', 'Erreur: le mot de passe actuel saisi est incorrect', time() + 15, "/");
			header("Location: ../resetpassword.php");
			exit("Le mot de passe actuel saisi est incorrect");
		}
	}
?>



