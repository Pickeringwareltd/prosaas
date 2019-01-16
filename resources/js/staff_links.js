$(function(){
	$(document.body).on('click', '.staff_member', function(){
		var id = $(this).attr('data-id');
		window.location.replace('http://localhost:8000/company/staff/' + id);
	});
});