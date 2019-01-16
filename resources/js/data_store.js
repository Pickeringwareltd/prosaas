var copy_arr = [];

$(function(){

  	var $container = $('#items_grid');
	// initialize
	$container.masonry({
	  itemSelector: '.grid-item',
	  gutter: 20
	});

});

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
		copy_string = copy_string + '<br>' + copy_arr[i];
	}

	copyToClipboard(copy_string);

	showCopiedAnimation($('#copy_btn'), $('#copied_btn'));
});

$('#group_btn').on('click', function(){
	$('.select_group').toggleClass('d-none');
});

$('#select_modal > .modal-background').on('click', function(){
	$('#select_modal').toggleClass('is-active');
});

 $(document.body).on('click', '.checkbox__input', function(){

	if($(this).prop('checked')){
		// add value to array
		// show copy button

		var value = $(this).attr('data-value');
		var name = $(this).attr('data-name');
		var id = $(this).attr('id');
		
		copy_arr.push(name + ': ' + value);

		$('#copy_area').show();

	} else {
		// slice the value from array
		// if array length is 0, hide copy button
		var value = $(this).attr('data-value');
		var name = $(this).attr('data-name');
		
		var copy_val = name + ': ' + value;	

		var index = copy_arr.indexOf(copy_val);
        if (index > -1) {
          copy_arr.splice(index, 1);
        }	

        if(copy_arr.length == 0){
        	$('#copy_area').hide();
        }
	}

});