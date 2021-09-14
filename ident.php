<?php
/*
    Type fichier : 
    Fonction : 
    Emplacement : 
    Connexion à la BDD :  
    Contenu HTML : 
    JS+JQuery : 
    CSS : 
*/
?>
<?php

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'webbd';

    //Connexion à la BDD
    $con = mysqli_connect($servername, $username, $password, $dbname);

    //Vérification de la connexion
    if(mysqli_connect_errno($con)){
    echo "Erreur de connexion" .mysqli_connect_error();
    }

if (isset($_POST['inscription']))
{
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordh = hash('sha512', $_POST['password']);
    $cpassword = $_POST['cpassword'];

    
	
    
        
            
    if ($pseudo && strlen($pseudo) > 3)
    {
        $sql = "SELECT pseudo FROM utilisateur WHERE pseudo = '$pseudo'";
        $result = mysqli_query($con, $sql);
        $ok = mysqli_fetch_array($result);
        if (!$ok)
        {
            if($email)
            {
                if($password) 
                {
                    if (strcmp($password, $cpassword) == 0)
                    {	
        				$sql = "INSERT INTO utilisateur (pseudo, email, password, date_inscription) VALUES ('$pseudo', '$email', '$passwordh', NOW())";
        				mysqli_query($con, $sql);
        				
                        setcookie('contentMessage', 'Votre inscription a été effectuée avec succès !', time() + 30, "/");
                        header('Location: ./connexion.php');
                        exit("Votre inscription a été effectuée avec succès !");
                    }
                    else
                    {
                        header("Location: ./inscrire.php?message=Confirmation du mot de passe non valide, veuillez réessayer&mail=". $email ."&pseudo=". $pseudo ."");
                    }
                }
                else
                {
                    header("Location: ./inscrire.php?message=Erreur, vous devez saisir un mot de passe&mail=". $email ."&pseudo=". $pseudo ."");
                }
            }
            else
            {
                header("Location: ./inscrire.php?message=Erreur, vous devez renseigner un email valide&pseudo=". $pseudo ."");
            }
        }
        else
        {
            header("Location: ./inscrire.php?message=Erreur, ce pseudo est déjà pris&mail=". $email ."");
        }
    }
    else 
    {
        if(!$pseudo)
        {
            header("Location: ./inscrire.php?message=Erreur, veuillez saisir un pseudo&mail=". $email ."");
        }
        else
        {
            header("Location: ./inscrire.php?message=Erreur, le pseudo ne peut pas faire moins de 3 caractères&mail=". $email ."");
        }   
    }
}

?>