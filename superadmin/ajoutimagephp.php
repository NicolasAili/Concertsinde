<?php
	$action = $_POST['submit'];
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
?>