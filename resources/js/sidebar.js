$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    $('#new_tag_icon').on('click', function(){
	    var tag_name = $('#new_tag_input').val();

	    sendNewTag(tag_name);
 	});

     $('#modal_new_tag_icon').on('click', function(){
	    var tag_name = $('#modal_new_tag_input').val();

	    sendNewTag(tag_name);
 	});

});

function sendNewTag(tag_name){
	if(tag_name != ''){
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	 
	    $.ajax({
	 
	        type : 'post',
	 
	        url : '/tags/create',
	 
	        data:{
	            'tag': tag_name
	        },
	 
	        success:function(data){

	           	var tag_string = '<span class="tag add-tags added-tag is-medium is-info" data-name="' + tag_name + '">' + tag_name + '<button class="delete is-small" style="display:none;"></button></span>';
	    		$('#modal_tag_list').append(tag_string);
	           	
	           	tag_string = '<span class="tag search-tag is-medium is-info" data-name="' + tag_name + '">' + tag_name + '<button class="delete is-small" style="display:none;"></button></span>';
	    		$('#tag_list').append(tag_string);
	            $('#new_tag_input').val('');

	        },

	        error: function(err){

	        	showErrorMessage('Error adding tag');

	            console.log('err = ' + JSON.stringify(err));
	        	
	        }
	     
	    });
	}
}

function showErrorMessage(err){
	
	$('#error_message').html(err);
	$('#error_box').toggleClass('d-none', 1000);
	setTimeout(
	 	function() 
	  	{
			$('#error_box').toggleClass('d-none', 1000);
	  	}, 3000);

}