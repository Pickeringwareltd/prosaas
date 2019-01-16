$( function() {
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

    var $container = $('#items_grid');

    // initialize
    $container.masonry({
      itemSelector: '.grid-item',
      gutter: 20
    });
});

var copy_arr = [];

function showCopiedAnimation(text, copied){
    text.fadeOut( 250, function() {
        copied.fadeIn( 250, function() {
            setTimeout(function() {
                copied.fadeOut( 250, function() {
                    text.fadeIn( 250, function() {
                    // Animation complete.
                    });
                });
            }, 1000);
        });
    });
}

function copyToClipboard(element) {
    var $temp = $("<textarea>");
    var brRegex = /<br\s*[\/]?>/gi;
    $("body").append($temp);
    $temp.val(element.replace(brRegex, "\r\n")).select();
    document.execCommand("copy");
    $temp.remove();
}

$('#copy_btn').on('click', function(){

    var copy_string = '';

    for(var i = 0; i < copy_arr.length ; i++){

        var item_arr = copy_arr[i].split(':');

        var item_str = item_arr[1] + ': ' + item_arr[2];

        copy_string = copy_string + '<br>' + item_str;
    }

    copyToClipboard(copy_string);

    showCopiedAnimation($('#copy_btn'), $('#copied_btn'));
});

$('#group_btn').on('click', function(){
    $('.select_box').toggleClass('d-none');
});

$('#select_btn').on('click', function(){

    $('#selected_list').html('');

    for(var i = 0; i < copy_arr.length ; i++){
        var item_arr = copy_arr[i].split(':');
        var item_str = item_arr[1] + ': ' + item_arr[2];

        $('#selected_list').append('<li>' + item_str + '</li>');
    }

    $('#select_modal').toggleClass('is-active');
});

$(document.body).on('click', '.modal-background', function(){
    $(this).parent().removeClass('is-active');
});

$('#add_tag_btn').on('click', function(){

    $('#select_modal').removeClass('is-active');

    $('#selected_item_list').html('');

    for(var i = 0; i < copy_arr.length ; i++){
        var item_arr = copy_arr[i].split(':');
        var item_str = item_arr[1] + ': ' + item_arr[2];

        $('#selected_item_list').append('<li>' + item_str + '</li>');
    }

    $('#add_tags_modal').toggleClass('is-active');
});

 $(document.body).on('click', '.checkbox__input', function(){

    if($(this).prop('checked')){
        // add value to array
        // show copy button
        var value = $(this).attr('data-value');
        var name = $(this).attr('data-name');
        var id = $(this).attr('id');
        
        copy_arr.push(id + ': ' + name + ': ' + value);

        $('#copy_area').show();
    } else {

        // slice the value from array
        // if array length is 0, hide copy button
        var value = $(this).attr('data-value');
        var name = $(this).attr('data-name');
        var id = $(this).attr('id');
        
        var copy_val = id + ': ' + name + ': ' + value; 

        var index = copy_arr.indexOf(copy_val);

        if (index > -1) {
          copy_arr.splice(index, 1);
        }   

        // If the array is empty, hide the copy button
        if(copy_arr.length == 0){
            $('#copy_area').hide();
        }
    }

});

 $('#vault_copy').on('click', function(){
    var plainText = $('#answer').html();
    // add value to array
    // show copy button
    var value = plainText;
    var name = 'sometitle';
        
    copy_arr.push(name + ': ' + value);

    $('#copy_area').show();
 });

// ------------------------------  SEARCH BAR ---------------------------------

// On select of tag, add to selected list and send off as array of tags
// If no tags, return all data

var tags = [];

$(document.body).on('click', '.added-tag', function(){

    if(!$(this).hasClass('active')){
        $(this).removeClass('is-info');
        $(this).addClass('is-success');
        $(this).toggleClass('active');
        var delete_btn = $(this).find('.delete');
        delete_btn.show();
    } else {
        $(this).addClass('is-info');
        $(this).removeClass('is-success');
        $(this).toggleClass('active');
        var delete_btn = $(this).find('.delete');
        delete_btn.hide(); 
    }

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

});

$(document.body).on('click', '.search-tag' ,function(){
 
    var value = tags;
    var search_field = $('#search').val();
 
    $.ajax({
 
        type : 'get',
 
        url : '/search/company/items',
 
        data:{
            'search': value,
            'search_field': search_field,
            'selected_tags': copy_arr
        },
 
        success:function(data){

            dealWithResults(data);

        },

        error: function(err){

            console.log('err = ' + JSON.stringify(err));
        
        }
     
    });
 
});

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

$('#somethingrandom').on('keyup',function(){
 
    var value = tags;
    var search_field = $(this).val();
 
    $.ajax({
 
        type : 'get',
 
        url : '/search/company/items',
 
        data:{
            'search': value,
            'search_field': search_field,
            'selected_tags': copy_arr
        },
 
        success:function(data){

            dealWithResults(data);

        },

        error: function(err){

            console.log('err = ' + JSON.stringify(err));
        
        }
     
    });
 
});

$('#add_tags_submit').on('click',function(){
 
    var items = [];

    for(var i = 0; i < copy_arr.length ; i++){

        var item_arr = copy_arr[i].split(':');

        var item_id = item_arr[0];

        items.push(item_id);
    }

    var tags = [];

    $( ".add-tags" ).each(function( index ) {
      if($(this).hasClass('active')){
        tags.push($(this).attr('data-name'));
      }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
    $.ajax({
 
        type : 'post',
 
        url : '/company/items/add/tags',
 
        data:{
            'items': items,
            'tags': tags
        },
 
        success:function(data){

            console.log(data);
            $('#add_tags_modal').removeClass('is-active');

        },

        error: function(err){

            console.log('err = ' + JSON.stringify(err));
        
        }
     
    });
 
});
