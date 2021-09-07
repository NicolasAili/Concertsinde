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
<?php if (isset($_COOKIE['contentMessage'])) { ?>

    <!-- Boite modale de message (erreur ou validation) -->

    <div id="messageModal"><?php echo $_COOKIE['contentMessage']; ?></div>


   <script> 

        $(document).ready(function(){
        $("#messageModal").dialog({show: "slide", modal: true, autoOpen: false, width: 500}).dialog("open");
        });

    </script>

    <?php

    setcookie('actionMessage', null, -1, "/");
    setcookie('typeMessage', null, -1, "/");
    setcookie('contentMessage', null, -1, "/");

    ob_end_flush();

}

?>