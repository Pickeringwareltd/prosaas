$(function(){
	$(document.body).on('click', '.contact', function(){
		var id = $(this).attr('data-id');
		window.location.replace('http://localhost:8000/company/contact/' + id);
	});
});