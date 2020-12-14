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
                	$('#infos').css('visibility', 'visible');
                	$('#infos').css('display', 'contents');
                	if(data[0].test == 'erreur')
                	{
                		$("#res").html("Cette salle n'est pas dans notre base de donnée, vous pouvez (si vous le souhaitez) renseigner ses informations de Pays/Ville/CP/Adresse, sinon un gentil administrateur s'en chargera :D ");
                		$("#pays").attr("placeholder", "salle non connue");
                		$("#region").attr("placeholder", "salle non connue");
                		$("#departement").attr("placeholder", "salle non connue");
                   	    $("#ville").attr("placeholder", "salle non connue");
                    	$("#cp").attr("placeholder", "salle non connue");
                    	$("#adresse").attr("placeholder", "salle non connue");
                	}
                   	else if(data[0].test == 'succes')
                   	{
                   		$("#res").html("Salle reconnue, informations récupérées. Vous pouvez corriger les informations suivantes si vous décelez une erruer, sinon ne rien modifier. ");
                    	$("#pays").attr("placeholder", data[0].pays);
                    	$("#region").attr("placeholder", data[0].region);
                    	$("#departement").attr("placeholder", data[0].departement);
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
	$( this ).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: "getdata.php",
				type: 'post',
				dataType: "json",
				data: {
						search: request.term,
						this: this
				  },
				success: function( data ) 
				{
					response( data );
					console.log(data);
				}
			});
		},
		select: function (event, ui) {
			// Set selection
			$( this ).val(ui.item.label); // display the selected text
			return false;
		}
	});
}

function checkbox()
{
	$("#res").html("ok checkbox");
	$("#salle").prop('required',false);
}