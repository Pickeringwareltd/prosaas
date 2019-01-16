$( function() {
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
});

var copy_arr = [];
var tags = [];

$('#search').on('keyup',function(){
 
    searchResults();
 
});

$(document.body).on('click', '.search-tag', function(){

    if(!$(this).hasClass('active')){
        $(this).removeClass('is-info');
        $(this).addClass('is-success');
        $(this).toggleClass('active');
        var delete_btn = $(this).find('.delete');
        delete_btn.show();
        tags.push($(this).attr('data-name')); 
    } else {
        $(this).addClass('is-info');
        $(this).removeClass('is-success');
        $(this).toggleClass('active');
        var delete_btn = $(this).find('.delete');
        delete_btn.hide(); 

        var index = tags.indexOf($(this).attr('data-name'));
        if (index > -1) {
          tags.splice(index, 1);
        }
    }

    searchResults();

});

function searchResults(){
    var value = tags;
    var search_field = $('#search').val();

    $.ajax({
 
        type : 'get',
 
        url : '/search/client',
 
        data:{
            'tags': value,
            'search_field': search_field
        },
 
        success:function(data){

            dealWithResults(data);

        },

        error: function(err){

            console.log('err = ' + JSON.stringify(err));
        
        }
     
    });
}

function dealWithResults(data){
    $('#search_results').html(data);

    // Destory search results in order to re-build
    $('#items_grid').masonry('destroy');
    $('#items_grid').removeData('masonry'); 

    // Re-init masonry again. =
    $('#items_grid').masonry({
        itemSelector: '.grid-item',
        gutter: 20
    });  

    var length = copy_arr.length;

    for(var i = 0; i < length ; i++){
        var item_arr = copy_arr[i].split(':');
        var item_id = item_arr[0];

        $('#' + item_id).prop('checked', true);
    }

    if(length > 0){
        $('#group_btn').trigger( "click" );
    }
}