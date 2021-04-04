$(document).ready(function(){

    //----------------Change Order of Category, Folder and Post Section Starts----------------//
        $('#sortable').sortable({
            
            axis: "y",
            update: function (event, ui) {
                
                $(this).children().each(function(index){
                    //Here we are checking that update the position column in the database if the data-position attribute is different then in the database.
                    //+1 is used since the data-position indexing starts from 0
                    if($(this).attr('data-position') != (index + 1)){
                        $(this).attr('data-position', (index +1)).addClass('position-updated');
                    }
                });

                //Calling the saveNewPositions function
                saveNewPositions($(this).attr('data-action'));
                

            }
        });
        //This function sends the position of each of the updated element to the controller file so that database can be updated
        //Also this function removes the position-updated class from the element whose position is updated in database
        function saveNewPositions(url){
            var positions = [];
            $('.position-updated').each(function(){
                //Sending data-index and data-position attribute value to controller
                positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
            });

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'text',
                data: {
                    //update is used just to check in controller file that weather data is send by post method or not
                    update: 1,
                    positions: positions
                },
                success: function(response){
                    console.log(response);
                }
            });
        }
    //----------------Change Order of Caegory, Folder and Post Section Ends----------------//

    

    // Add Category Section Starts
    $('#addCategory').click(function(){

        $.ajax({

            url: $('#addCategoryForm').attr('action'),
            type: 'POST',
            data: $("#addCategoryForm input").serialize()

        });

    });
    // Add Category Section Ends

    // Add Folder Section Starts
    $('#addFolder').click(function(){

        $.ajax({

            url: $('#addFolderForm').attr('action'),
            type: 'POST',
            data: $("#addFolderForm input, #addFolderForm select").serialize()

        });

    });
    // Add Folder Section Ends


    //Search Post Section Starts
        searchPost();
        function searchPost(query)
        {
            $.ajax({
                url:"../controller/ajax/searchPost.php",
                method:"post",
                data:{query:query},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }
        
        $('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			searchPost(search);
		}
		else
		{
			searchPost();			
		}
    });
    //Search Post Section Ends

});