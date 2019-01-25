$(function(){
	$(document.body).on('click', '.company_card', function(){
		var id = $(this).attr('data-link');
		window.location.replace('http://localhost:8000/company');
	});
});