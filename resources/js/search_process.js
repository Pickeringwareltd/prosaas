$( function() {
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
});

$('#search').on('keyup',function(){
 
    $value = $(this).val();
 
    $.ajax({
 
        type : 'get',
 
        url : '/search/process',
 
        data:{'search':$value},
 
        success:function(data){

			$('#search_results').html(data);
 
        },

        error: function(err){

        	console.log('err = ' + JSON.stringify(err));
        
        }
     
    });
 
})