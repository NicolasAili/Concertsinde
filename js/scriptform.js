	function getleave()
			{
					var namesalle = $('#salle').val();
					//window.alert("ok");
					if(namesalle)
			   		{
			   			//window.alert("ok1");
			    		$.ajax(
			    		{
				    		type: 'post',
				        	url: 'detectsalle.php',
				        	dataType: 'json', 

				        	//dataType: "html",
				      		data: {
				        		 namesalle:namesalle,
				      		},
				     		 success: function (data) 
				     		{
				     			console.log(data[0]); //renvoie l'array complet: 0: Object { adresse: "1 rue du sable", pays: "Espagne", ville: "Madrid", … }
				     			console.log(data); //même retour qu'avec data[0]
				     			console.log(data[1]); //undefined
				     			console.log(data.pays); //undefined

				     			const obj = JSON.parse(data);
				     			console.log(obj.pays); //Espagne si tout marche bien mais renvoie: "Uncaught SyntaxError: JSON.parse: unexpected character at line 1 column 2 of the JSON data"
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
    				success: function( data ) {
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