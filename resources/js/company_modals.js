$(document).ready(function () {


    $('.copy_btn').on('click', function () {
        $('#text_modal').toggleClass('is-active');

        var copyText = $(this).attr('data-value');
		
		// Create a dummy input to copy the string array inside it
		var dummy = document.createElement("input");

		// Add it to the document
		document.body.appendChild(dummy);

		// Set its ID
		dummy.setAttribute("id", "dummy_id");

		// Output the array into it
		document.getElementById("dummy_id").value = copyText;

		// Select it
		dummy.select();

		// Copy its contents
		document.execCommand("copy");

		// Remove it as its not needed anymore
		document.body.removeChild(dummy);

		alert(copyText + ' copied to clipboard');
    });

    $('.message').on('click', function () {
        $('#text_modal').toggleClass('is-active');
    });

    $('.modal-background').on('click', function () {
        $('#text_modal').toggleClass('is-active');
    });

    $('.delete').on('click', function () {
        $('#text_modal').toggleClass('is-active');
    });

});