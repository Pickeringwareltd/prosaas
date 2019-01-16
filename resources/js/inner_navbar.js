$(function(){
	$('.nav_item').on('click', function(){
		console.log($(this).attr('data-link'));
		var link = $(this).attr('data-link');
		window.location.replace('http://localhost:8000/company' + link);
	});
});