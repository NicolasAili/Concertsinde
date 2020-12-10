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
				        	data: 
				      		{
				        		 namesalle:namesalle,
				      		},
				      		dataType: 'html',
				     		 success: function rep(data) 
				     		{
				         		$('#res').html(data);
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