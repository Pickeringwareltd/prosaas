$( function() {
    $(document.body).on('click', '.folder', function(){

        var id = $(this).attr('data-id');
        window.location.replace('http://localhost:8000/company/files/' + id);

    });

    $(document.body).on('click', '.linked_file', function(){

        var link = $(this).attr('data-link');
        window.location.replace(link);

    });
});
