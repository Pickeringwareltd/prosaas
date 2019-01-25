$(function(){
	$('.nav_item').on('click', function(){
		var link = $(this).attr('data-link');
		window.location.replace('http://localhost:8000' + link);
	});
});