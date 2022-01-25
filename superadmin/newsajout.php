
<?php
require('../php/database.php');

$type = $_POST['type'];
$rubrique = $_POST['rubrique'];
$titre = $_POST['titre'];
$soustitre = $_POST['soustitre'];
$contenu = $_POST['contenu'];

$sql = "INSERT INTO actualites(type, date, rubrique, titre, soustitre, contenu) VALUES ('$type', NOW(), '$rubrique', '$titre', '$soustitre', '$contenu')";
$query = mysqli_query($con ,$sql);


$idactu = "SELECT MAX(id) AS id_max FROM actualites"; //on recupere l'ID le plus haut 
$query = mysqli_query($con, $idactu);
$row = mysqli_fetch_array($query);
$idmax = $row['id_max'];

$uploaddir = '../image/actualites/';
$target_file = $uploaddir . basename($_FILES["userfile"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$_FILES['userfile']['name']  = "news" . $idmax . "." . $imageFileType;

$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    header("Location: saccueil.php");
} else {
    echo "Erreur dans la mise en ligne du fichier\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";
echo "<a href='saccueil.php'>retour accueil</a>";

//
?>

