function getleave(identifiant)
{
    var input = $('#'+identifiant+'').val();

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
                if(data[0].test == 'nodata' && identifiant == 'salle')
                {
                    $('#infosx').css('visibility', 'hidden');
                    $('#infosx').css('display', 'none');
                    $("#res").html("");
                }
                if(data[0].test != 'nodata')
                {
                	$('#infos').css('visibility', 'visible');
                	$('#infos').css('display', 'contents');
                    switch (identifiant)
                    {
                        case "salle":
                              //$('#nomdpt').css('visibility', 'hidden');
                              //$('#nomdpt').css('display', 'none');
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
                                $("#res").html("Salle reconnue et informations de localisation récupérées. Vous pouvez corriger ces informations ou les compléter, sinon ne rien modifier. ");
                            
                                if(data[0].departement != 'nodata')
                                {
                                    $("#departement").val(data[0].departement);
                                    if(data[0].region != 'nodata')
                                    {
                                        $("#region").val(data[0].region);
                                        $("#pays").val(data[0].pays);
                                        $("#region").prop( "disabled", true );
                                        $("#pays").prop( "disabled", true );
                                    }
                                    else
                                    {
                                        $('#region').val('');
                                        $('#pays').val('');
                                        $("#region").prop( "disabled", false );
                                        $("#pays").prop( "disabled", true );
                                        $("#region").attr("placeholder", "région non renseignée");
                                        $("#pays").attr("placeholder", "pays non renseigné");
                                    }
                                    $("#departement").prop( "disabled", true );
                                }
                                else
                                {
                                    $('#region').val('');
                                    $('#pays').val('');
                                    $('#departement').val('');
                                    $("#departement").prop( "disabled", false );
                                    $("#region").prop( "disabled", true );
                                    $("#pays").prop( "disabled", true );
                                    $("#departement").attr("placeholder", "departement non renseigné");
                                    $("#region").attr("placeholder", "région non renseignée");
                                    $("#pays").attr("placeholder", "pays non renseigné");
                                }
                                $("#ville").val(data[0].ville);
                                if(data[0].cp != 'nodata')
                                {
                                    $("#cp").val(data[0].cp);
                                    $("#cp").prop( "disabled", true );
                                }
                                else
                                {
                                    $("#cp").prop( "disabled", false );
                                    $('#cp').val('');
                                    $("#cp").attr("placeholder", "code postal non renseigné");
                                }
                                if(data[0].adresse != 'nodata')
                                {
                                    $("#adresse").val(data[0].adresse);
                                }
                                else
                                {
                                    $('#adresse').val('');
                                    $("#adresse").attr("placeholder", "adresse non renseignée");
                                }
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
                                //$("#pays").prop( "disabled", false );
                                $("#pays").attr("placeholder", "ville non connue");
                                //$("#region").prop( "disabled", false );
                                $("#region").attr("placeholder", "ville non connue");
                                $("#departement").prop( "disabled", false );
                                $("#departement").attr("placeholder", "ville non connue");
                                $("#cp").prop( "disabled", false );
                                $("#cp").attr("placeholder", "ville non connue"); 
                                $("#region").prop( "disabled", true );
                                $("#pays").prop( "disabled", true );
                            }
                            else if(data[0].test == 'succes')
                            {
                                $("#resx").html("Ville reconnue et informations récupérées");
                                if(data[0].departement != 'nodata')
                                {
                                    $("#departement").val(data[0].departement);
                                    if(data[0].region != 'nodata')
                                    {
                                        $("#region").prop( "disabled", true );
                                        $("#region").val(data[0].region);
                                        $("#pays").val(data[0].pays);
                                    }
                                    else
                                    {
                                        $('#region').val('');
                                        $('#pays').val('');
                                        $("#region").prop( "disabled", false );
                                        $("#region").attr("placeholder", "région non renseignée");
                                        $("#pays").attr("placeholder", "pays non renseigné"); 
                                    }
                                    $("#pays").prop( "disabled", true );
                                    $("#departement").prop( "disabled", true );
                                }
                                else
                                {
                                    $('#departement').val('');
                                    $('#region').val('');
                                    $('#pays').val('');
                                    $("#departement").prop( "disabled", false );
                                    $("#region").prop( "disabled", false );
                                    $("#pays").prop( "disabled", true );
                                    $("#departement").attr("placeholder", "departement non renseigné pour cette ville");
                                    $("#region").attr("placeholder", "région non renseignée pour cette ville");
                                    $("#pays").attr("placeholder", "pays non renseigné pour cette ville");  
                                }
                                if(data[0].cp != 'nodata')
                                {
                                    $("#cp").val(data[0].cp);
                                    $("#cp").prop( "disabled", true );
                                }
                                else
                                {
                                    $('#cp').val('');
                                    $("#cp").attr("placeholder", "code postal non renseigné"); 
                                    $("#cp").prop( "disabled", false );
                                }  
                            }
                        break;
                        case "departement":
                            if(data[0].test == 'succes')
                            {
                                if(data[0].region != 'nodata')
                                {
                                    $("#resw").html("Département reconnu et informations récupérées");
                                    $("#region").prop( "disabled", true );
                                    $("#region").val(data[0].region);
                                    $("#pays").val(data[0].pays);
                                }
                                else
                                {
                                    $("#resw").html("Département reconnu mais aucune information récupérée");
                                    $("#region").prop( "disabled", false );
                                    $('#region').val('');
                                    $('#pays').val('');
                                    $("#region").attr("placeholder", "région non renseignée pour ce departement");
                                    $("#pays").attr("placeholder", "pays non renseigné pour ce departement");  
                                }
                                $("#pays").prop( "disabled", true );
                            }
                            else if(data[0].test == 'erreur')
                            {
                                //$('#nomdpt').css('visibility', 'visible');
                                //$('#nomdpt').css('display', 'contents');
                                //$("#numdepartement").prop( "disabled", false );
                                //$("#nomdpthtml").html("Departement non reconnu, vous pouvez renseigner le numero associe à ce département. S'il n'en possède pas ou si vous ne le connaissez pas, laisser vide");
                                $("#resw").html("Département non reconnu");
                                $("#region").prop( "disabled", false );
                                $("#region").attr("placeholder", "departement inconnu");
                                $('#region').val('');
                                $('#pays').val('');
                                $("#pays").attr("placeholder", "departement inconnu");
                            }
                        break;
                        case "region":
                            if(data[0].test == 'succes')
                            {
                                $("#pays").prop( "disabled", true );
                                $('#pays').prop( "required", true );
                                $("#pays").val(data[0].pays);
                            }
                            else if(data[0].test == 'erreur')
                            {
                                $('#pays').val('');
                                $("#pays").prop( "disabled", false );
                                $("#pays").attr("placeholder", "région inconnue");
                            }
                        break;
                        case "pays":
                            if(data[0].test == 'erreur')
                            {
                                alert("pays non valide, merci de saisir un pays existant")
                                $("#pays").val('');
                            }
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
        //strdate = strdate+1;
        //console.log(strdate);
        /*tt = 0;
        if($('input[name=checkint]').prop('checked')) //on est sur un concert interieur
        {
            tt=1;
        }
        else if($('input[name=checkext]').prop('checked'))
        {
            tt=2;
        }
        console.log("tttest4");
        console.log(tt);*/
        var datesaisie = new Date(strdate).getTime()

        var now = new Date();
        var heure   = now.getHours();
        heureinf = (heure+1)*3600000; //heure courante multipliée par le nb de ms en 1 heure
        heuresup = 63072000000; //2 ans en milliseconde
        

        var dateinf = datesaisie + heureinf;
        var datesup = Date.now() + heuresup;

        if( (dateinf < Date.now()))
        {
            alert("Erreur, date saisie inférieure à la date actuelle");
            close = 1;
        }
        if(datesaisie > datesup)
        {
            alert("Erreur, impossible de saisir des concerts plus de deux ans en avance");
            close = 1;
        }
        if(!$('input[name=checkint]').prop('checked'))
        {
            if(!$('input[name=checkext]').prop('checked'))
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
        if(!strsalle)
        {
            if($('input[name=checkint]').prop('checked'))
            {
                alert("Erreur le nom de la salle n'a pas été saisi");
                close = 1;
            }
        }
        if(!strdenom)
        {
            if($('input[name=checkext]').is(':checked'))
            {
                alert("Erreur le nom du concert exterieur n'a pas été saisi");
                close = 1;
            }
        }
        if(strdate.length  == 0)
        {
            alert("Erreur la date n'a pas été saisie");
            close = 1;
        }
        if(strdate)
        {
            //
        }
        if(strville.length == 0)
        {
            if($('input[name=checkext]').prop('checked') || $('input[name=checkint]').prop('checked'))
            {
                alert("Erreur la ville n'a pas été saisie");
                close = 1;
            }
        }
        if(strregion.length > 0 && !strpays)
        {
            alert("Erreur, vous devez saisir le pays dont fait partie cette région");
            close = 1;
        }
        if(close == 1)
        {
            //
        }
        if(close == 0)
        {
            $("#divSchedule").dialog("open"); 
            if($('input[name=checkint]').prop('checked')) //on est sur un concert interieur
            {
                $('#denom').val('');
                $("#pint").prop("checked", true);
                $("#pext").prop("checked", false);
                $("#psalle").html(strsalle);
            }
            else
            {
                $('#salle').val('');
                $("#pint").prop("checked", false);
                $("#pext").prop("checked", true);
                $("#pint").prop("checked", false);
                $("#psalle").html(strdenom);
            }

            $("#partiste").html(strartiste);
            $("#pdate").html(strdate);
            $("#pheure").html(strheure);
            if(!strpays)
            {
                $("#ppays").html("pays non saisi");
            }
            else
            {
                $("#ppays").html(strpays);
            }
           
            if(!strregion)
            {
                $("#pregion").html("region non saisie");
            }
            else
            {
                $("#pregion").html(strregion);
            }
            
            if(!strdepartement)
            {
                $("#pdepartement").html("departement non saisi");
            }
            else
            {
                $("#pdepartement").html(strdepartement);
            }
            
            $("#pville").html(strville);
            $("#padresse").html(stradresse);
            $("#pcp").html(strcp);
            $("#pfb").html(strfb);
            $("#pticket").html(strbilletterie);
        }  
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
            if( $('input[name=checkint]').is(':checked') ) //si le bouton interieur n'était pas déjà coché (on vient de le cocher) 
            {
                $('#sallediv').css('visibility', 'visible');
                $('#sallediv').css('display', 'contents');
                $('#extdiv').css('visibility', 'hidden');
                $('#extdiv').css('display', 'none');
                $('#infos').children('input').val('');
                $('#denom').val('');
                if( $('input[name=checkext]').is(':checked') ) //si le bouton interieur n'était pas déjà coché (on vient de le cocher) et que le bouton ext est coché
                {
                    $('#salle').val('');
                    $("#ext").prop("checked", false);
                    $('#infos').css('visibility', 'hidden');
                    $('#infos').css('display', 'none');
                }
            }
           else if(!$('input[name=checkint]').prop('checked')) //si le bouton interieur était déjà coché avant (si on vient de le décocher)
            {
                $('#salle').val('');
                $("#res").html("");
                $('#sallediv').css('visibility', 'hidden');
                $('#sallediv').css('display', 'none');
                $('#infos').css('visibility', 'hidden');
                $('#infos').css('display', 'none');
            }
            $("#cp").prop( "disabled", true );
            $("#pays").prop( "disabled", true );
            $("#region").prop( "disabled", true );
            $("#departement").prop( "disabled", true );
            
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
            $("#cp").prop( "disabled", true );
            $("#pays").prop( "disabled", true );
            $("#region").prop( "disabled", true );
            $("#departement").prop( "disabled", true );
            $("#cp").attr("placeholder", "renseignez la ville");
            $("#ville").attr("placeholder", "renseignez la ville");
            $("#pays").attr("placeholder", "renseignez la ville");
            $("#region").attr("placeholder", "renseignez la ville");
            $("#departement").attr("placeholder", "renseignez la ville");

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
                $('#pays').prop( "required", false );
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
                $('#pays').prop( "required", false );
        break;
    }
}

function verifier()
{
    var strpays = $("#pays").val();
    var strregion = $("#region").val();
    if(strregion.length > 0 && !strpays)
    {
        alert("Erreur, vous devez saisir le pays dont fait partie cette région");
    }
    else
    {
        $('#valider').attr("type", "submit");
        $('#valider').trigger('click');
    }
}