var flkty = new Flickity('.main-carousel');

$(function() {
	percent = 0;

	changeProgressBar(parseInt(percent));
});

$( ".done_btn" ).click(function() {
	var index = flkty.selectedIndex;

	// We do + 1 for 0-index array
	index++;

	var count = $('#progress_bar_progress').attr('data-count');

	var percent = index / count;

	percent = percent * 100;

	changeProgressBar(parseInt(percent));

	if(percent == 100){
		changeProgressBarToDone();
	}

  	flkty.next();
});

function changeProgressBar(_percent) {
	$('#progress_bar_progress').css('width', _percent + '%');
	$('#progress_bar_progress').html(_percent + '%');
}

function changeProgressBarToDone(){
	$('#progress_bar_progress').css('background-color', 'green');
	$('#progress_bar_progress').html('Complete!');
}