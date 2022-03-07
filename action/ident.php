<?php
/*
    Type fichier : php
    Fonction : permet l'inscription d'un utilisateur
    Emplacement : action
    Connexion à la BDD : oui  
    Contenu HTML : non
    JS+JQuery : non
    CSS : non
*/
?>
<?php

    require('../php/database.php');

if (isset($_POST['inscription']))
{
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordh = hash('sha512', $_POST['password']);
    $cpassword = $_POST['cpassword'];

    require ('../php/inject.php'); //0) ajouter inject et définir redirect
    $redirect = '../inscrire.php?mail=' . $email . '&pseudo=' . $pseudo;

    $values = array($pseudo); //1) mettre données dans un arrray
    $inject = inject($values, null); //2) les vérifier

    $returnval = inject($email, 'mail'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
    if (!is_null($returnval)) 
    {
      array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
    }

    $validate = validate($inject, $redirect); //3)validation de tous les champs
    if($validate == 0) //4) si pas d'injection : ajout des variables
    {
      $artiste = mysqli_real_escape_string($con, $artiste); 
    }
            
    if ($pseudo && strlen($pseudo) > 3 && $validate == 0)
    {
        $sql = "SELECT pseudo FROM utilisateur WHERE pseudo = '$pseudo'";
        $result = mysqli_query($con, $sql);
        $ok = mysqli_fetch_array($result);
        if (!$ok)
        {
            if($email)
            {
                $sql = "SELECT email FROM utilisateur WHERE email = '$email'";
                $result = mysqli_query($con, $sql);
                $ok = mysqli_fetch_array($result);
                if(!$ok)
                {
                    if($password) 
                    {
                        if (strcmp($password, $cpassword) == 0)
                        {   
                            $pseudo = strtoupper($pseudo);
                            $sql = "INSERT INTO utilisateur (pseudo, email, password, date_inscription) VALUES ('$pseudo', '$email', '$passwordh', NOW())";
                            mysqli_query($con, $sql);
                            
                            setcookie('contentMessage', 'Votre inscription a été effectuée avec succès !', time() + 15, "/");
                            header('Location: ../connexion.php');
                            exit("Votre inscription a été effectuée avec succès !");
                        }
                        else
                        {
                            header("Location: ../inscrire.php?message=Confirmation du mot de passe non valide, veuillez réessayer&mail=". $email ."&pseudo=". $pseudo ."");
                        }
                    }
                    else
                    {
                        header("Location: ../inscrire.php?message=Erreur, vous devez saisir un mot de passe&mail=". $email ."&pseudo=". $pseudo ."");
                    }
                }
                else
                {
                    header("Location: ../inscrire.php?message=Erreur, cet email est déjà pris&pseudo=". $pseudo ."");
                }
            }
            else
            {
                header("Location: ../inscrire.php?message=Erreur, vous devez renseigner un email valide&pseudo=". $pseudo ."");
            }
        }
        else
        {
            header("Location: ../inscrire.php?message=Erreur, ce pseudo est déjà pris&mail=". $email ."");
        }
    }
    else 
    {
        if(!$pseudo)
        {
            header("Location: ../inscrire.php?message=Erreur, veuillez saisir un pseudo&mail=". $email ."");
        }
        else
        {
            header("Location: ../inscrire.php?message=Erreur, le pseudo ne peut pas faire moins de 3 caractères&mail=". $email ."");
        }   
    }
}

?>