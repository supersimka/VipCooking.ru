$(document).ready(function() {

 $(".category").change(function(){

	var id = $(this).find('option:selected').val();
  
  $.ajax({
		  url: '/getSection/', dataType: 'html', type: 'get', data: {id: id},
		  success: function(result){
        $('.childCategory').html(result);
	    }
		});
    return false;
  });

});
