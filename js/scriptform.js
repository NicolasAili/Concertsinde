/*
    Type fichier : JS
    Fonction : Fichier de script principal
    Emplacement : js
    Contenu HTML : n
    JS+JQuery : n
    CSS : n
*/

function getleave(identifiant)
{
    
    $( '#'+identifiant+'' ).autocomplete( "close" );
    try {
        var input = $('#'+identifiant+'').val();
    } catch (error) {
        var input = $('.'+identifiant+'').val();
    }
    

    if(identifiant)
    {
        $.ajax(
        {
            type: 'post',
            url: 'action/detectsalle.php',
            dataType: 'json',
            data: {
                 identifiant:identifiant,
                 input:input
            },
             success: function ( data )
            { 
                if(data.test == 'nodata' && identifiant == 'salle')
                {
                    $('#infosx').css('visibility', 'hidden');
                    $('#infosx').css('display', 'none');
                    $("#res").html("");
                }
                if(data.test != 'nodata')
                {
                	$('#infosx').css('visibility', 'visible');
                	$('#infosx').css('display', 'contents');
                    $('#infos').css('visibility', 'visible');
                    $('#infos').css('display', 'contents');
                    switch (identifiant)
                    {
                        case "salle":
                            $("#resv").html('');
                            if(data.test == 'erreur')
                            {
                                $('#infos').children('input').attr("placeholder", "salle non connue");
                                $('#infos').children('input').val('');
                                $("#ville").prop( "required", true );
                                $("#res").html("Cette salle n'est pas dans notre base de donnée, vous pouvez (si vous le souhaitez) renseigner ses informations de Pays/Ville/CP, sinon un gentil administrateur s'en chargera :D ");
                            }
                            else if(data.test == 'succes')
                            {
                                $('#infos').children('input').val('');
                                $("#res").html("Salle reconnue et informations de localisation récupérées. Vous pouvez corriger ces informations ou les compléter, sinon ne rien modifier. ");
                            
                                if(data.departement != 'nodata')
                                {
                                    $("#departement").val(data.departement);
                                    if(data.region != 'nodata')
                                    {
                                        $("#region").val(data.region);
                                        $("#pays").val(data.pays);
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
                                $("#ville").val(data.ville);
                                if(data.cp != 'nodata')
                                {
                                    $("#cp").val(data.cp);
                                    $("#cp").prop( "disabled", true );
                                }
                                else
                                {
                                    $("#cp").prop( "disabled", false );
                                    $('#cp').val('');
                                    $("#cp").attr("placeholder", "code postal non renseigné");
                                }
                                if(data.adresse != 'nodata')
                                {
                                    $("#adresse").val(data.adresse);
                                }
                                else
                                {
                                    $('#adresse').val('');
                                    $('#adresse').attr("placeholder", "adresse non renseignée");
                                }
                            }
                            else
                            {
                                $("#res").html("erreur technique, merci de contacter l'administrateur du site");
                            }
                        break;
                        case "ville":
                            if(data.test == 'erreur')
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
                            else if(data.test == 'succes')
                            {
                                $("#resv").html("Ville reconnue et informations récupérées");
                                if(data.departement != 'nodata')
                                {
                                    $("#departement").val(data.departement);
                                    if(data.region != 'nodata')
                                    {
                                        $("#region").prop( "disabled", true );
                                        $("#region").val(data.region);
                                        $("#pays").val(data.pays);
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
                                if(data.cp != 'nodata')
                                {
                                    $("#cp").val(data.cp);
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
                            if(data.test == 'succes')
                            {
                                if(data.region != 'nodata')
                                {
                                    $("#resw").html("Département reconnu et informations récupérées");
                                    $("#region").prop( "disabled", true );
                                    $("#region").val(data.region);
                                    $("#pays").val(data.pays);
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
                            else if(data.test == 'erreur')
                            {
                                $("#resw").html("Département non reconnu");
                                $("#region").prop( "disabled", false );
                                $("#region").attr("placeholder", "departement inconnu");
                                $('#region').val('');
                                $('#pays').val('');
                                $("#pays").attr("placeholder", "departement inconnu");
                            }
                        break;
                        case "region":
                            if(data.test == 'succes')
                            {
                                $("#pays").prop( "disabled", true );
                                $('#pays').prop( "required", true );
                                $("#pays").val(data.pays);
                            }
                            else if(data.test == 'erreur')
                            {
                                $('#pays').val('');
                                $("#pays").prop( "disabled", false );
                                $("#pays").attr("placeholder", "région inconnue");
                            }
                        break;
                        case "pays":
                            if(data.test == 'erreur')
                            {
                                alert("pays non valide, merci de saisir un pays existant")
                                $("#pays").val('');
                            }
                        break;
                        default:
                            alert("erreur");
                        break;
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
				url: "action/getdata.php",
				type: 'post',
				dataType: "json",
				data: {
						search: request.term,
						this: identifiant
				  },
				success: function( data ) 
				{
                    if((request.term).length>2)
                    {
                        if (data[0].label == 'norep') 
                        {
                            $( '#'+identifiant+'' ).autocomplete( "close" );
                            getleave(identifiant);
                        }
                        else
                        {
                            response( data );
                            if(data.length == 1 && data[0].label == request.term)
                            {
                                $( '#'+identifiant+'' ).autocomplete( "close" );
                                getleave(identifiant);
                            }
                        }
                    }
                    
				}
			});
		},
		select: function (event, ui) {
			// Set selection
			$( this ).val(ui.item.label); // display the selected text in the field
            if(identifiant == 'salle' || identifiant == 'ville' || identifiant == 'departement' || identifiant == 'region')
            {
                getleave(this.id);
            }
			return false;
		}
	});
}     


//verification non nul
function popup(){
        bheight = $( 'body' ).height();
        bheight = bheight/8;
        $("html").scrollTop( bheight );  

        var close = 0;
        var strartiste = $(".artiste").val();
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
            $("#res").html('');
            $("#resv").html('');
            $("#resw").html('');
            $("#resx").html('');
            if( $('input[name=checkint]').is(':checked') ) //si le bouton interieur n'était pas déjà coché (on vient de le cocher) 
            {
                $('footer').css('position', 'static');
                $('form').css('margin-bottom', '50px');
                $('#sallediv').css('visibility', 'visible');
                $('#sallediv').css('display', 'contents');
                $('#extdiv').css('visibility', 'hidden');
                $('#extdiv').css('display', 'none');
                $('#infos').children('input').val('');
                $('#denom').val('');
                $('#infosx').css('visibility', 'visible');
                $('#infosx').css('display', 'contents');
                $('#infos').css('visibility', 'visible');
                $('#infos').css('display', 'contents');
                $('#adresse, #ville, #cp, #departement, #region, #pays').attr('placeholder', 'Veuillez renseigner la salle');
                if( $('input[name=checkext]').is(':checked') ) //si le bouton interieur n'était pas déjà coché (on vient de le cocher) et que le bouton ext est coché
                {
                    $('#salle').val('');
                    $("#ext").prop("checked", false);
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
            if ($( window ).height() == $( document ).height()) 
            {
                $('footer').css('position', 'absolute');
                $('footer').css('bottom', '0');
            }  
            
        break;
        case "ext":
            $("#res").html('');
            $("#resv").html('');
            $("#resw").html('');
            $("#resx").html('');
            if( $('input[name=checkext]').is(':checked') )
            {
                $('footer').css('position', 'static');
                $('form').css('margin-bottom', '50px');
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
                $('#infosx').css('visibility', 'visible');
                $('#infosx').css('display', 'contents');
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

            $("#adresse").attr("placeholder", "adresse du concert");
            $("#cp").attr("placeholder", "renseignez la ville");
            $("#ville").attr("placeholder", "renseignez la ville");
            $("#pays").attr("placeholder", "renseignez la ville");
            $("#region").attr("placeholder", "renseignez la ville");
            $("#departement").attr("placeholder", "renseignez la ville");
            if ($( window ).height() == $( document ).height()) 
            {
                $('footer').css('position', 'absolute');
                $('footer').css('bottom', '0');
            } 

        break;
    }
}

function checkboxmodif(identifiant)
{
    intextpost = $("#intextpost").val();
    switch (identifiant)
    {
        case "int":
                $("#ext").prop("checked", false);
                $("#int").prop("checked", true);
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
                if (intextpost == identifiant)
                {
                    $('#intext').val('');
                }
                else
                {
                    $('#intext').val("int");
                }
                $('#ext').prop( "required", false ); // ?
                $('#extval').prop( "required", false ); //désactive obligation rentrer dénomination
                $('#salle').prop( "required", true ); //salle obligée saisir
                $('#pays').prop( "required", false ); //pays plus obligé de saisir
        break;
        case "ext":
                $("#int").prop("checked", false);
                $("#ext").prop("checked", true);
                $("#ext").prop("disabled", true);
                $("#int").prop("disabled", false);
                $('#intdiv').css('visibility', 'hidden');
                $('#intdiv').css('display', 'none');
                $('#inthiddiv').css('visibility', 'hidden');
                $('#inthiddiv').css('display', 'none');
                $('#exthiddiv').css('visibility', 'visible');
                $('#exthiddiv').css('display', 'contents');
                $('#extdiv').css('visibility', 'visible');
                $('#extdiv').css('display', 'contents')
                if (intextpost == identifiant)
                {
                    $('#intext').val('');
                }
                else
                {
                    $('#intext').val("ext"); 
                }
                $('#extval').prop( "required", true );
                $('#salle').prop( "required", false );
                $('#pays').prop( "required", false );
        break;
    }
}


    /*$('#date').val('');
    $('#heure').val('');
    $('#salle').val('');
    $('#extval').val('');
    $('#ville').val('');
    $('#cp').val('');
    $('#cp').attr("placeholder", '');
    $('#departement').val('');
    $('#departement').attr("placeholder", '');
    $('#region').val('');
    $('#region').attr("placeholder", '');
    $('#pays').val('');
    $('#pays').attr("placeholder", '');
    $('#ticket').val('');
    $('#adresse').val('');
    $('#adresse').attr("placeholder", '');
    $('#fb').val('');*/


function redirect()
{
    window.location.href = "allconcerts.php";
}

function off() 
{
    $('#off').attr('src', 'image/offwhite.png');
}

function offleave() 
{
    $('#off').attr('src', 'image/off.png');
}

function recherche()
{
    $('#recherche').css('visibility', 'hidden');
    $('#bar').css('visibility', 'visible');
    $('.champ').focus();
}

function fermer()
{
    var scroll = $(window).scrollTop();
    $('#bar').css('visibility', 'hidden');
    $('#recherche').css('visibility', 'visible');
}

function motif(identifiant)
{
    switch (identifiant)
    {
        case "problemecheck":
            $("#contactcheck").prop("checked", false);
            $("#contactcheckother").prop("checked", false);
            $('#type').val('2');
        break;
        case "contactcheck":
            $("#problemecheck").prop("checked", false);
            $("#contactcheckother").prop("checked", false);
            $('#type').val('3');
        break;
        case "contactcheckother":
            $("#contactcheck").prop("checked", false);
            $("#problemecheck").prop("checked", false);
            $('#type').val('3');
        break;
    }
}

