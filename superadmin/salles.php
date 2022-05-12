<?php
/*
	Type fichier : php
	Fonction : gestion des salles
	Emplacement : supermadmin
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : non
*/
    session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gestion des salles</title>
		<meta charset="utf-8">
		<?php
			include '../php/error.php';
			require '../php/connectcookie.php';
			require '../php/database.php';
            echo "<script src='../jquery/jquery.min.js'></script>";
			echo "<script src='../jquery/jquery-ui-1.13.0/jquery-ui.min.js'></script>";
			echo "<link rel='stylesheet' type='text/css' href='../jquery/jquery-ui-1.13.0/jquery-ui.css'>";
		?>
		<!--<style>
			#content
			{
				display: flex;
				justify-content: space-around;
			}
		</style>-->
	</head>
	<body>
		<?php
		require('../php/database.php');
		$pseudo = $_SESSION['pseudo'];
		$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
		$result = mysqli_query($con ,$sql);
		$row = mysqli_fetch_array($result);

		if($row['admin'] == 2)
		{
            $salle = $_GET['salle'];
            ?>
			<a href='saccueil.php'>retour accueil</a>
            <br>
            <a href='salles.php'>reset</a>
			<div id="content">
                <br>
                <form action="salles.php" method="get">
                    <label for="salle">Salle:</label>
                    <input type="text" id="salle" name="salle" onkeyup="getdata(this.id);" required><br><br>
                    <input type="submit">
                </form>
                <?php
                if(!$salle)
                {
                    $sql = "SELECT DISTINCT id_salle, nom_salle, nom_ext, adresse, intext FROM salle";
                }
                else
                {
                    $sql = "SELECT id_salle, nom_salle, nom_ext, adresse, intext FROM salle WHERE nom_salle = '$salle'";
                }
                $query = mysqli_query($con, $sql);
                ?>

                <table>
                    <caption>Salles</caption>
                    <tr>
                    <th scope="col">nom salle</th>
                    <th scope="col">nom ext</th>
                    <th scope="col">adresse</th>
                    </tr>
                    <?php
                    while($row = mysqli_fetch_array($query))
                    {?>
                        <form method="post" id="connect" action="sallesmodif.php">
                            <tr>
                                <td><input type="text" name="nomsalle" <?php echo 'value="' . $row['nom_salle'] . '"' ?> id="nomsalle"></td>
                                <td><input type="text" name="nomext" <?php echo 'value="' . $row['nom_ext'] . '"' ?> id="nomext"></td>
                                <td><input type="text" name="adresse" <?php echo 'value="' . $row['adresse'] . '"' ?> id="adresse"></td>
                                <input type="hidden" class="idsalle" name="idsalle" <?php echo 'value="' . $row['id_salle'] . '"' ?> >
                                <td><input type="submit" value="Valider" class="Valider" name="modsuppr" href=""></td>
                            </tr>
                            </tr>
                        </form>
                    <?php
                    }
                    ?>
			    </table>
            </div>
        <?php
        }?>
    </body>

    <script>
        function getdata(identifiant)
        {
            $( '#'+identifiant+'' ).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: "../action/getdata.php",
                        type: 'post',
                        dataType: "json",
                        data: {
                                search: request.term,
                                this: identifiant
                        },
                        success: function( data ) 
                        {
                            response( data );
                            if(data.length == 1 && data[0].label == request.term)
                            {
                                $( '#'+identifiant+'' ).autocomplete( "close" );
                                getleave(identifiant);
                            }
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $( this ).val(ui.item.label); // display the selected text in the field
                    return false;
                }
            });
        }
    </script>
</html>