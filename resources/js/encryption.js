var SimpleCrypto = require("simple-crypto-js").default; 

var to_decrypt;
var item_id;

$(document).ready(function () {

    $(document.body).on('click', '.vault_item', function () {
    	to_decrypt = $(this).attr('data-value');
    	item_id = $(this).attr('data-id');

        $('#text_modal').toggleClass('is-active');
    });

    $('#text_modal > .modal-background').on('click', function () {
        $('#text_modal').toggleClass('is-active');
        $('#decrypted_answer').hide();
        $('#encrypted_area').show();
    });

});

$('#vault_submit').on('click', function(){
	var password = $('#vault_password').val();
	var simpleCrypto = new SimpleCrypto(password);

	var cipherText = to_decrypt;
	var decipherText = simpleCrypto.decrypt(cipherText);

	if(decipherText != ''){
		$('#answer').html(decipherText);
		$('.wrong_password').hide();
		$('.correct_password').show();
		$('#wrong_password_message').addClass('d-none');
	} else {
		$('#wrong_password_message').removeClass('d-none');
		$('.correct_password').hide();
		$('.wrong_password').show();
	}

	$('#decrypted_answer').show();
	$('#encrypted_area').hide();
});

$('#vault_submit_again').on('click', function(){
	var password = $('#vault_password_again').val();
	var simpleCrypto = new SimpleCrypto(password);

	var cipherText = to_decrypt;
	var decipherText = simpleCrypto.decrypt(cipherText);

	if(decipherText != ''){
		$('#answer').html(decipherText);
		$('.wrong_password').hide();
		$('.correct_password').show();
		$('#wrong_password_message').addClass('d-none');
	} else {
		$('#wrong_password_message').removeClass('d-none');
		$('.correct_password').hide();
		$('.wrong_password').show();
	}

	$('#decrypted_answer').show();
	$('#encrypted_area').hide();
});

$('#vault_new_submit').on('click', function(){
	var plainText = $('#answer').html();
	var password = $('#vault_new_password').val();
	var simpleCrypto = new SimpleCrypto(password);

	var cipherText = simpleCrypto.encrypt(plainText);

	var plainText = simpleCrypto.decrypt(cipherText);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
 	// THIS ROUTE MUST AUTHENTICATE USER AND CHECK THEY ARE THE OWNER OF THE ITEM 
    $.ajax({
 
        type : 'post',
 
        url : '/company/items/change-password',
 
        data:{
            'item': item_id,
            'cipher_text': cipherText
        },
 
        success:function(data){

            console.log('data: ' + JSON.stringify(data));

            var id = data.item.id;
            var item = $("div").find(`[data-id='` + id + `']`);
            item.attr('data-value', data.item.text_value);

            $('#' + id).attr('data-value', data.item.text_value);

        },

        error: function(err){

            console.log('err = ' + JSON.stringify(err));
        
        }
 
	});

});

$('#vault_password_btn').on('click', function(){
	$('#new_password_box').show();

});