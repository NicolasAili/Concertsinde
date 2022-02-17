<?php
/*
    Type fichier : php
    Fonction : permet d'afficher boîte de dialogue lorsque header
    Emplacement : action
    Connexion à la BDD : non  
    Contenu HTML : oui
    JS+JQuery : oui (pas jquery)
    CSS : non
*/
?>
<?php if (isset($_COOKIE['contentMessage'])) { ?>

    <!-- Boite modale de message (erreur ou validation) -->

    <div id="messageModal"><?php echo $_COOKIE['contentMessage']; ?></div>

   <script> 

        $(document).ready(function(){
            $("#messageModal").dialog();
            $("#main, #reseaux, footer, header").css('filter', 'blur(0.6rem)');
            $(".ui-button").click(function(){
                $("#main, #reseaux, footer, header").css('filter', '');
            });
        });

    </script>
    <?php
    $bool = setcookie('contentMessage', 'modiftest', time() + 3600);
    if($bool)
    {
        echo $bool;
    }
    else 
    {
        echo "cookie not deleted";
    }
}
?>