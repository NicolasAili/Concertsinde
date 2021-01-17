function getleave(identifiant)
{
    var input = $('#'+identifiant+'').val();
    //alert(identifiant);
    if(!$('#'+identifiant+'').val())
    {
        $('#infos').css('visibility', 'hidden');
        $('#infos').css('display', 'none');
        $("#res").html("");
    }
        if(identifiant)
        {
            $.ajax(
            {
                type: 'post',
                url: 'detectsalle.php',
                dataType: 'json',
                data: {
                     identifiant:identifiant,
                     input:input
                },
                 success: function ( data )
                {
                    if(data[0].test != 'nodata')
                    {
                    	$('#infos').css('visibility', 'visible');
                    	$('#infos').css('display', 'contents');
                        switch (identifiant)
                        {
                            case "salle":
                                if(data[0].test == 'erreur')
                                {
                                    $('#infos').children('input').attr("placeholder", "salle non connue");
                                    $('#infos').children('input').val('');
                                    $("#ville").prop( "required", true );
                                    $("#res").html("Cette salle n'est pas dans notre base de donnée, vous pouvez (si vous le souhaitez) renseigner ses informations de Pays/Ville/CP, sinon un gentil administrateur s'en chargera :D ");
                                }
                                else if(data[0].test == 'succes')
                                {
                                    $('#infos').children('input').val('');
                                    $("#res").html("Salle reconnue et informations de localisation récupérées. Vous pouvez corriger ces informations si vous décelez une erreur, sinon ne rien modifier. ");
                                    $("#pays").val(data[0].pays);
                                    $("#region").val(data[0].region);
                                    $("#departement").val(data[0].departement);
                                    $("#ville").val(data[0].ville);
                                    $("#cp").val(data[0].cp);
                                    $("#adresse").val(data[0].adresse);
                                }
                                else
                                {
                                    $("#res").html("erreur technique, merci de contacter l'administrateur du site");
                                }
                            break;
                            case "ville":
                                if(data[0].test == 'erreur')
                                {
                                    $('#cp').val('');
                                    $('#departement').val('');
                                    $('#region').val('');
                                    $('#pays').val('');
                                    $("#resv").html("Cette ville n'est pas dans notre base de donnée, vous pouvez (si vous le souhaitez) renseigner ses informations de Pays/region/departement/CP, sinon un (gentil) administrateur s'en chargera :D ");
                                    $("#pays").prop( "disabled", false );
                                    $("#pays").attr("placeholder", "ville non connue");
                                    $("#region").prop( "disabled", false );
                                    $("#region").attr("placeholder", "ville non connue");
                                    $("#departement").prop( "disabled", false );
                                    $("#departement").attr("placeholder", "ville non connue");
                                    $("#cp").prop( "disabled", false );
                                    $("#cp").attr("placeholder", "ville non connue"); 
                                }
                                else if(data[0].test == 'succes')
                                {
                                    $("#resx").html("Ville reconnue et informations récupérées");
                                    $("#pays").val(data[0].pays);
                                    $("#region").val(data[0].region);
                                    $("#departement").val(data[0].departement);
                                    $("#cp").val(data[0].cp);
                                }
                            break;
                            case "departement":
                                if(data[0].test == 'succes')
                                {
                                    $("#region").prop( "disabled", true );
                                    $("#region").val(data[0].region);
                                    $("#pays").prop( "disabled", true );
                                    $("#pays").val(data[0].pays);
                                }
                                else if(data[0].test == 'erreur')
                                {
                                    $("#region").prop( "disabled", false );
                                    $("#region").attr("placeholder", "departement inconnu");
                                    $("#pays").prop( "disabled", false );
                                    $("#pays").attr("placeholder", "departement inconnu");
                                }
                            break;
                            case "region":
                                if(data[0].test == 'succes')
                                {
                                    $("#pays").prop( "disabled", true );
                                    $("#pays").val(data[0].pays);
                                }
                                else if(data[0].test == 'erreur')
                                {
                                    $("#pays").prop( "disabled", false );
                                    $("#pays").attr("placeholder", "région inconnue");
                                }
                            break;
                            case "pays":
                                //ne rien faire ici
                            break;
                            default:
                            alert("erreur");
                        }
                    }               	
                },
                error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                }
            });
        }        
}				

function getdata(identifiant)
{
	$( '#'+identifiant+'' ).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: "getdata.php",
				type: 'post',
				dataType: "json",
				data: {
						search: request.term,
						this: identifiant
				  },
				success: function( data ) 
				{
					response( data );
				}
			});
		},
		select: function (event, ui) {
			// Set selection
			$( this ).val(ui.item.label); // display the selected text
            getleave(this.id);
			return false;
		}
	});
}


//verification non nul
function popup(){
        var close = 0;
        var strartiste = $("#artiste").val();
        var strdate = $("#date").val();
        var strheure = $("#heure").val();
        var strsalle = $("#salle").val();
        var strdenom = $("#denom").val();
        var strfb = $("#fb").val();
        var strbilletterie = $("#ticket").val();
        var strpays = $("#pays").val();
        var strregion = $("#region").val();
        var strdepartement = $("#departement").val();
        var stradresse = $("#adresse").val();
        var strcp = $("#cp").val();
        var strville = $("#ville").val();
        if( !$('input[name=checkint]').is(':checked') )
        {
            if( !$('input[name=checkext]').is(':checked') )
            {
                alert("Erreur, veuillez cocher le lieu du concert");
                close = 1;
            }
        }
        if(strartiste.length == 0)
        {
            alert("Erreur le nom de l'artiste n'a pas été saisi");
            close = 1;
        }
        if(strsalle.length == 0)
        {
            if($('input[name=checkint]').is(':checked'))
            {
                alert("Erreur le nom de la salle n'a pas été saisi");
                close = 1;
            }
        }
        if(strdate.length  == 0)
        {
            alert("Erreur la date n'a pas été saisie");
            close = 1;
        }
        if(close == 0)
        {
            $("#divSchedule").dialog("open"); 
        }
        if($('input[name=checkint]').is(':checked')) //on est sur un concert interieur
        {
            $("#pint").prop("checked", true);
            $("#pext").prop("checked", false);
            $("#ext").prop("checked", false);
            $("#psalle").html(strsalle);
        }
        else
        {
            $("#pext").prop("checked", true);
            $("#pint").prop("checked", false);
            $("#psalle").html(strdenom);
        }
        $("#partiste").html(strartiste);
        $("#pdate").html(strdate);
        $("#pheure").html(strheure);
        $("#ppays").html(strpays);
        $("#pregion").html(strregion);
        $("#pdepartement").html(strdepartement);
        $("#pville").html(strville);
        $("#padresse").html(stradresse);
        $("#pcp").html(strcp);
        $("#pfb").html(strfb);
        $("#pticket").html(strbilletterie);
        return false;
    }

function retour()
{
    $("#nonsaisie").closest('.ui-dialog-content').dialog('close'); 
}

function submit()
{
    $("#valider").attr("type", "submit");
    $("#valider").trigger('click');
    $("#dialog").attr("type", "hidden");
}

function checkbox(identifiant)
{
    switch (identifiant)
    {
        case "int":
            if( $('input[name=checkint]').is(':checked') )
            {
                $('#sallediv').css('visibility', 'visible');
                $('#sallediv').css('display', 'contents');
                $('#extdiv').css('visibility', 'hidden');
                $('#extdiv').css('display', 'none');
                $('#infos').children('input').val('');
                if( $('input[name=checkext]').is(':checked') )
                {
                    $('#salle').val('');
                    $("#ext").prop("checked", false);
                    $('#infos').css('visibility', 'hidden');
                    $('#infos').css('display', 'none');
                }
            }
           else 
            {
                $('#sallediv').css('visibility', 'hidden');
                $('#sallediv').css('display', 'none');
                $('#infos').css('visibility', 'hidden');
                $('#infos').css('display', 'none');
            }
            
        break;
        case "ext":
            if( $('input[name=checkext]').is(':checked') )
            {
                $('#extdiv').css('visibility', 'visible');
                $('#extdiv').css('display', 'contents');
                $('#sallediv').css('visibility', 'hidden');
                $('#sallediv').css('display', 'none');
                $('#infos').children('input').val('');
                $('#infos').children('input').attr("placeholder", "");
                if( $('input[name=checkint]').is(':checked') )
                { 
                    $("#int").prop("checked", false);
                }
                
                $('#infos').css('visibility', 'visible');
                $('#infos').css('display', 'contents');
            }
           else 
            {
                $('#extdiv').css('visibility', 'hidden');
                $('#extdiv').css('display', 'none');
                $('#infos').css('visibility', 'hidden');
                $('#infos').css('display', 'none');
            }
        break;
    }
}

function checkboxmodif(identifiant)
{
    switch (identifiant)
    {
        case "int":
                $("#ext").prop("checked", false);
                $("#int").prop("disabled", true);
                $("#ext").prop("disabled", false);
                $('#extdiv').css('visibility', 'hidden');
                $('#extdiv').css('display', 'none');
                $('#exthiddiv').css('visibility', 'hidden');
                $('#exthiddiv').css('display', 'none');
                $('#inthiddiv').css('visibility', 'visible');
                $('#inthiddiv').css('display', 'contents');
                $('#intdiv').css('visibility', 'visible');
                $('#intdiv').css('display', 'contents');
                $('#intext').val("int");
                $('#ext').prop( "required", false );
                $('#salle').prop( "required", true );
        break;
        case "ext":
                $("#int").prop("checked", false);
                $("#ext").prop("disabled", true);
                $("#int").prop("disabled", false);
                $('#intdiv').css('visibility', 'hidden');
                $('#intdiv').css('display', 'none');
                $('#inthiddiv').css('visibility', 'hidden');
                $('#inthiddiv').css('display', 'none');
                $('#exthiddiv').css('visibility', 'visible');
                $('#exthiddiv').css('display', 'contents');
                $('#extdiv').css('visibility', 'visible');
                $('#extdiv').css('display', 'contents');
                $('#intext').val("ext");
                $('#extval').prop( "required", true );
                $('#salle').prop( "required", false );
        break;
    }
}