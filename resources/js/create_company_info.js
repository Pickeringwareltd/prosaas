var SimpleCrypto = require("simple-crypto-js").default; 
var selected_tags = [];

$( function() {

    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

    var locked = getUrlVars()["locked"];

    if(locked == 'true'){
        $('#encrypted').prop('checked', true);
    }

    $('#item_select').change(function() {
        var data = $('#item_select option:selected').text();
        
        if(data == 'Image'){
            $('#text_field').hide();
            $('#image_field').show();
            $('#doc_field').hide();
        } else if(data == 'Text') {
            $('#text_field').show();
            $('#image_field').hide();
            $('#doc_field').hide();
        } else {
            $('#text_field').hide();
            $('#image_field').hide();
            $('#doc_field').show();
        }
    });

    $('.modal-background').on('click', function () {
        $('#text_modal').toggleClass('is-active');
    });

});

$('#create_item_form').submit(function(event){
    event.preventDefault();

    selected_tags = findSelectedTags();

    var form = $('#create_item_form');
    var data = form.serializeArray();

    if($('#encrypted').prop('checked')){
        $('#text_modal').toggleClass('is-active');
    } else {
        submit(data, false);
    }

    // disabled the submit button
    $("#btnSubmit").prop("disabled", true);
});

$('#vault_unlock_btn').on('click', function(){
    var encrypted = encryptItem($('#vault_password').val());
    var data = addToForm(encrypted);

    submit(data, true);
});

function findSelectedTags(){
    var tags = [];

    $('#tag_list').children('.tag').each(function() {
        if($(this).hasClass('active')){
            tags.push($(this).attr('data-name'));
        }
    });

    console.log(tags);

    return tags;
}

function addToForm(encrypted){
    var form = $('#create_item_form');
    var data = form.serializeArray();
    var itemType = data[2];
    var itemValue = data[3];

    if(itemType.value == 'Text'){
        data[3]['value'] = encrypted;
    }

    return data;
}

function objectifyForm(formArray) {

  var returnArray = {};

  for (var i = 0; i < formArray.length; i++){
    returnArray[formArray[i]['name']] = formArray[i]['value'];
  }

  return returnArray;

}

function submit(_data, encrypted){
    var url = window.location.origin;

    $.ajax({

       dataType: 'text',
       data: { 
        itemName: _data[1]['value'],
        itemType: _data[2]['value'],
        itemText: _data[3]['value'],
        encrypted: encrypted,
        tags: selected_tags
       },
       url: url + '/company/item/create',
       type: 'POST',
       beforeSend: function beforeSend(request) {
           return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
       },
       success: function success(response) {

            url = url + '/staff/1';
            $(location).attr("href", url);

       },
        error: function(err){

            console.log('err = ' + JSON.stringify(err));
        
        }
   });
}

function validateItem(data){
    // NEED TO CHECK IF ALL DATA IS THERE
    // NEED TO RETURN ERROR MESSAGES
}

function encryptItem(data){
    var password = $('#vault_password').val();
    var simpleCrypto = new SimpleCrypto(password);

    var cipherText = $('#text_holder').val();
    var cipherText = simpleCrypto.encrypt(cipherText);

    return cipherText;
}

// Read a page's GET URL variables and return them as an associative array.
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

var tags = [];

$('#new_tag_icon').on('click', function(){
    var tag_name = $('#new_tag_input').val();
    var tag_string = '<span class="tag is-medium is-success active" data-name="' + tag_name + '">' + tag_name + '<a class="delete is-small"></a></span>';

    $('#tag_list').append(tag_string);
    $('#new_tag_input').val('');
});

$(document.body).on('click', '.tag', function(){

    if($(this).attr('id') != 'new_tag_form'){
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
    }

});
