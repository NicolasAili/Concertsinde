<?php
	$action = $_POST['submit'];
	require '../php/connectcookie.php';
	require('../php/database.php');

	if($action == 'ajoutartiste')
	{
		$uploaddir = '../image/artiste/';
	}
	else if ($action == 'ajoutdrapeau') 
	{
		$uploaddir = '../image/flags/';
	}
	
	$target_file = $uploaddir . basename($_FILES["userfile"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	//$_FILES['userfile']['name']  = "news" . $idmax . "." . $imageFileType;

	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

	echo '<pre>';
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
	{
	    header("Location: saccueil.php");
	} 
	else 
	{
	    echo "Erreur dans la mise en ligne du fichier\n";
	    echo 'Infos de debug:';
		print_r($_FILES);
	}
	print "</pre>";

	switch ($action) {
		case 'Modifier':
			$nomartiste = $_POST['nomartiste'];
			$description = $_POST['description'];
			$userfile = $_POST['userfile'];
			$delete = $_POST['delete'];
			$idconcert = $_POST['idconcert'];
			
			if ($delete == 'Suppression')
			{
				$sql = "DELETE FROM artiste WHERE nom_artiste = '$nomartiste'";
				$query = mysqli_query($con, $sql);
				header("Location: saccueil.php");
			}
			else
			{
				$sql = "UPDATE artiste SET nom_artiste = '$nomartiste', description = '$description' WHERE nom_artiste = '$idconcert'";
				$query = mysqli_query($con, $sql);
			}
			echo $nomartiste;
			echo "<br>";
			echo $description;
			echo "<br>";
			echo $userfile;
			echo "<br>";
			break;
		case 'Ajouter':
			
			break;
		case 'ajoutdrapeau':
			# code...
			break;
		default:
			?>
			<a href="ajoutimage.php"> erreur </a><?php 
			break;
	}
?>