<?php
/*
  Type fichier : php
  Fonction : ajouter une description à un artiste
  Emplacement : action
  Connexion à la BDD : oui  
  Contenu HTML : non
  JS+JQuery : non
  CSS : nonx
*/
  header('Content-type: application/json');
  if( isset( $_POST['artiste'] ) )
  {
    require('../php/database.php');
    
    $artiste = $_POST['artiste']; //variable envoyée grâce à la méthode "post" par notre script JQuery
    $description = $_POST['description'];

    require ('../php/inject.php'); //0) ajouter inject et définir redirect
    $redirect = '../supartiste.php?artiste=$artiste';

    $values = array($artiste); //1) mettre données dans un arrray
    $inject = inject($values, null); //2) les vérifier

    $returnval = inject($description, 'text'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
    if (!is_null($returnval)) 
    {
      array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
    }

    $validate = validate($inject, $redirect); //3)validation de tous les champs
    if($validate == 0) //4) si pas d'injection : ajout des variables
    {
      $artiste = mysqli_real_escape_string($con, $artiste); 
      $description = mysqli_real_escape_string($con, $description);
    }
    
    $sql = "UPDATE artiste SET description = '$description' WHERE Nom_artiste = '$artiste' ";
    $query = mysqli_query($con, $sql);
    header("Location: ../supartiste.php?artiste=". $artiste ."");
  }
