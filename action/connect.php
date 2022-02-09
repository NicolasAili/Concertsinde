<?php
/*
	Type fichier : php
	Fonction : connecte l'utilisateur
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

	if ( isset($_POST['connexion'])) {
		$pseudo = $_POST['pseudo'];

		require ('../php/inject.php'); //0) ajouter inject et définir redirect
		$redirect = '../connexion.php';

		$values = array($pseudo); //1) mettre données dans un arrray
		$inject = inject($values, null); //2) les vérifier
		$validate = validate($inject, $redirect); //3)validation de tous les champs
		if($validate == 0) //4) si pas d'injection : ajout des variables
		{
		  $pseudo = mysqli_real_escape_string($con, $pseudo); 
		}
		$password = $_POST['password'];
		$passwordh = hash('sha512', $password);
		$sql = "SELECT pseudo, banni FROM utilisateur WHERE pseudo = '$pseudo' AND password = '$passwordh'";
		$result = mysqli_query($con ,$sql);
		$row = mysqli_fetch_assoc($result);

		//echo $passwordh;

	    if ($row['pseudo'] != null )
    	{
    		if($row['banni'] == 1)
    		{
    			header("Location: ../connexion.php?message=Votre compte a été banni");
    		}
    		else
    		{
    			session_set_cookie_params(20); 
				$_SESSION['pseudo'] = $row['pseudo'];
				/*$sql = "SELECT password FROM utilisateur WHERE pseudo = '$pseudo'";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_assoc($result);*/
				$_SESSION['password'] = $passwordh;
				header('Location: ../allconcerts.php');
			}
		}
		else 
		{
			$sql = "SELECT email, banni, pseudo FROM utilisateur WHERE email = '$pseudo' AND password = '$passwordh'";
			$result = mysqli_query($con ,$sql);
			$row = mysqli_fetch_assoc($result);
			if ($row['email'] != null )
    		{
	    		if($row['banni'] == 1)
	    		{
	    			header("Location: ../connexion.php?message=Votre compte a été banni");
	    		}
	    		else
	    		{
	    			session_set_cookie_params(20); 
					$_SESSION['pseudo'] = $row['pseudo'];
					$_SESSION['password'] = $passwordh;
					header('Location: ../allconcerts.php');
				}
			}
			else
			{
				header("Location: ../connexion.php?message=Pseudo ou Mot de Passe incorrect");
			}
		}
}
?>		

