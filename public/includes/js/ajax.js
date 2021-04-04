$(document).ready(function(){
    
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
				$('#searchResult').html(data);
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