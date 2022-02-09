<?php
require('../php/database.php');

$mail = $_POST['mail'];
$mail = strtolower($mail);
$objet = "réinitialisation de votre mot de passe";


require ('../php/inject.php'); //0) ajouter inject et définir redirect
$redirect = '../oubli.php';

$inject = array(); 
$returnval = inject($mail, 'mail'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
if (!is_null($returnval)) 
{
  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
}
$validate = validate($inject, $redirect); //3)validation de tous les champs
if($validate == 0) //4) si pas d'injection : ajout des variables
{
  $mail = mysqli_real_escape_string($con, $mail); 
}

//echo $mail;
//echo "<br>";

$sql = "SELECT email FROM utilisateur WHERE email = '$mail'";
$query = mysqli_query($con, $sql);

//echo $sql;
//echo "<br>";
if(!$row = mysqli_fetch_array($query))
{
	setcookie('contentMessage', 'Erreur: cet email n\'est lié à aucun compte', time() + 30, "/");
    header("Location: ../oubli.php");
    exit("Erreur: cet email n\'est lié à aucun compte");
}

//supprimer les vieilles clés liées à ce mail

$sql = "UPDATE oublimdp SET actif = 0 WHERE mail = '$mail'";
$query = mysqli_query($con, $sql);

//créer une nouvelle clé

$key=rand();
$result = md5($key);

//envoyer le mail

//===== Création du header du mail.
$header = "From: <no-reply@test.com> \n";
$header .= "Reply-To: ".$mail."\n";
$header .= "MIME-version: 1.0\n";
$header .= "Content-type: text/html; charset=utf-8\n";
$header .= "Content-Transfer-Encoding: 8bit";
 
//===== Contenu de votre message
$contenu =  "<html>".
    "<body>".
    "<p style='text-align: center; font-size: 18px'><b>Bonjour vous avez fait une requête suite à l'oublie de votre mot de passe. Cliquez sur le lien suivant afin de la réinitialiser" . "</b>,</p><br/>".
    "<p style='text-align: justify'><i><b>resetpassword.php?key=</b></i>".$key."</p><br/>".
    "</body>".
    "</html>";
//===== Envoi du mail
mail($mail, $objet, $contenu, $header);
echo $header;
echo "<br>";
echo $objet;
echo "<br>";
echo $contenu;

/*ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$from = "localhost@arpenid.com";
$to = "nicolas31.busquet@laposte.net";
$subject = "PHP Mail Test script";
$message = "This is a test to check the PHP Mail functionality";
$headers = "From:" . $from;
mail($to,$subject,$message, $headers);
echo "Test email sent";*/

$sql = "INSERT INTO oublimdp (mail, keyid) VALUES ('$mail', '$key')";
$query = mysqli_query($con, $sql);
setcookie('contentMessage', 'Mail envoyé avec succès', time() + 30, "/");
header("Location: ../oubli.php");
exit("Mail envoyé avec succès");
?>