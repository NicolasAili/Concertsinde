<?php
	$action = $_POST['submit'];
	require '../php/connectcookie.php';
	require('../php/database.php');
	


	switch ($action) {
		case 'Modifier':
			$nomartiste = $_POST['nomartiste'];
			$nomartiste = ucfirst($nomartiste);
			$description = $_POST['description'];
			$userfile = $_POST['userfile'];
			$delete = $_POST['delete'];
			$idconcert = $_POST['idconcert'];

			$uploaddir = '../image/artiste/';
			
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

			//$target_file = $uploaddir . basename($_FILES["userfile"]["name"]);
			//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			//$_FILES['userfile']['name']  = "news" . $idmax . "." . $imageFileType;

			//$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

			$extension = pathinfo(basename($_FILES['userfile']['name'],PATHINFO_EXTENSION)); //recupère l'extension du fichier DL
			$extension = $extension['extension']; //string
			$extension = strtolower($extension); //minuscule
			
			if($extension)
			{
				$uploadfile = $uploaddir . $nomartiste . '.' . $extension;

				array_map('unlink', glob("../image/artiste/$idconcert.*")); //supprimer l'ancienne image si elle existe, peu importe son extension


				echo '<pre>';
				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))  //upload
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
			}
			else
			{
				if ($nomartiste != $idconcert) 
				{
					$filename = '../image/artiste/' . $idconcert . '.jpg';
					$newfilename = '../image/artiste/' . $nomartiste . '.jpg';

					if (file_exists($filename)) 
					{
					    rename($filename, $newfilename);
					} 
					else 
					{
					    $filename = '../image/artiste/' . $idconcert . '.png';
						$newfilename = '../image/artiste/' . $nomartiste . '.png';
						if (file_exists($filename)) 
						{
						    rename($filename, $newfilename);
						};
					}
				}
				header("Location: saccueil.php");
			}
			break;
		case 'Ajouter':
			$uploaddir = '../image/artiste/';
			$nomartiste = $_POST['nomartiste'];
			$nomartiste = ucfirst($nomartiste);
			$description = $_POST['description'];
			$userfile = $_POST['userfile'];
			

			$sql = "SELECT nom_artiste FROM artiste WHERE nom_artiste = '$nomartiste'";
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($query);

			if($row['nom_artiste']) 
			{
				echo "erreur: cet artiste existe déjà";
			}
			else
			{
				$sql = "INSERT INTO artiste (nom_artiste, description) VALUES ('$nomartiste', '$description')";
				$query = mysqli_query($con, $sql);
			}

			$extension = pathinfo(basename($_FILES['userfile']['name'],PATHINFO_EXTENSION));
			$extension = $extension['extension'];
			$extension = strtolower($extension);
			
			if($extension)
			{
				$uploadfile = $uploaddir . $nomartiste . '.' . $extension;

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
			}
			else
			{?>
				<a href="ajoutimage.php"> pas d'image </a><?php
			}
			break;
		case 'ajoutdrapeau':
			$pays = $_POST['pays'];
			$userfile = $_POST['userfile'];
			$uploaddir = '../image/flags/';
			$extension = pathinfo(basename($_FILES['userfile']['name'],PATHINFO_EXTENSION));
			$extension = $extension['extension'];
			$extension = strtolower($extension);
			
			if($extension)
			{
				$uploadfile = $uploaddir . $nomartiste . '.' . $extension;

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
			}
			else
			{?>
				<a href="ajoutimage.php"> pas d'image </a><?php
			}
			
			break;
		default:
			?>
			<a href="ajoutimage.php"> erreur </a><?php 
			break;
	}?>
	<a href="ajoutimage.php"> retour </a>