function getleave()
{
	var namesalle = $('#salle').val();
        if(namesalle)
        {
            $.ajax(
            {
                type: 'post',
                url: 'detectsalle.php',
                dataType: "json",
                data: {
                     namesalle:namesalle,
                },
                 success: function (data)
                {
                	if(data[0].test == 'erreur')
                	{
                		$("#res").html("Cette salle n'est pas dans notre base de donnée, vous pouvez (si vous le souhaitez) renseigner ses informations de Pays/Ville/CP/Adresse, sinon un gentil administrateur s'en chargera :D ");
                		$("#pays").attr("placeholder", "salle non connue");
                   	    $("#ville").attr("placeholder", "salle non connue");
                    	$("#cp").attr("placeholder", "salle non connue");
                    	$("#adresse").attr("placeholder", "salle non connue");
                	}
                   	else if(data[0].test == 'succes')
                   	{
                    	$("#pays").attr("placeholder", data[0].pays);
                    	$("#ville").attr("placeholder", data[0].ville);
                    	$("#cp").attr("placeholder", data[0].cp);
                    	$("#adresse").attr("placeholder", data[0].adresse);
                	}
                	else
                	{
                		$("#res").html("erreur technique, merci de contacter l'administrateur du site");
                	}
                }                      
            });
        }        
}				

function getdata()
{
	$( "#salle" ).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: "getdata.php",
				type: 'post',
				dataType: "json",
				data: {
						search: request.term
				  },
				success: function( data ) 
				{
					response( data );
				}
			});
		},
		select: function (event, ui) {
			// Set selection
			$('#salle').val(ui.item.label); // display the selected text
			return false;
		}
	});
}