$(document).ready(function () {

	// Initialize all input of date type.
	var calendars = bulmaCalendar.attach('[type="date"]');

	// Loop on each calendar initialized
	for(var i = 0; i < calendars.length; i++) {
		// Add listener to date:selected event
		calendars[i].on('date:selected', date => {
			console.log(date);
		});
	}

	$('#data_store_link').on('click', function () {
        $('#data_store').show();
        $('#calendar').hide();
    });

	$('#calendar_link').on('click', function () {
        $('#data_store').hide();
        $('#calendar').show();
    });

});