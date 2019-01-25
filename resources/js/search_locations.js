$( function() {
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    mapboxgl.accessToken = 'pk.eyJ1IjoiamFja3BpY2tlcmluZyIsImEiOiJjanFxZzExamwwYjJ6NDJuMmV4bHFxY2ZoIn0.JF0uWDZRviXZ6kkM_9jCfQ';

    loopMaps();
});

var copy_arr = [];
var tags = [];

$('#search').on('keyup',function(){
 
    searchResults();
 
});

$(document.body).on('click', '.search-tag', function(){

    if(!$(this).hasClass('active')){
        $(this).removeClass('is-info');
        $(this).addClass('is-success');
        $(this).toggleClass('active');
        var delete_btn = $(this).find('.delete');
        delete_btn.show();
        tags.push($(this).attr('data-name')); 
    } else {
        $(this).addClass('is-info');
        $(this).removeClass('is-success');
        $(this).toggleClass('active');
        var delete_btn = $(this).find('.delete');
        delete_btn.hide(); 

        var index = tags.indexOf($(this).attr('data-name'));
        if (index > -1) {
          tags.splice(index, 1);
        }
    }

    searchResults();

});

function searchResults(){
    var value = tags;
    var search_field = $('#search').val();

    $.ajax({
 
        type : 'get',
 
        url : '/search/locations',
 
        data:{
            'tags': value,
            'search_field': search_field
        },
 
        success:function(data){

            dealWithResults(data);

        },

        error: function(err){

            console.log('err = ' + JSON.stringify(err));
        
        }
     
    });
}

function dealWithResults(data){

    var search_empty = false;

    if($('#search').val() == '' && tags.length == 0){
        search_empty = true;
    }

    if(data != ''){
        $('#all_results').hide();

        $('#search_results').html(data);

        // Destory search results in order to re-build
        $('#items_grid').masonry('destroy');
        $('#items_grid').removeData('masonry'); 

        // Re-init masonry again. =
        $('#items_grid').masonry({
            itemSelector: '.grid-item',
            gutter: 20
        });  

        var length = copy_arr.length;

        for(var i = 0; i < length ; i++){
            var item_arr = copy_arr[i].split(':');
            var item_id = item_arr[0];

            $('#' + item_id).prop('checked', true);
        }

        if(length > 0){
            $('#group_btn').trigger( "click" );
        }

        loopMaps();        
    } else if(data == '' && search_empty) {
        $('#search_results').html('');
        $('#all_results').show();
    } else {
        $('#search_results').html('');
        $('#all_results').hide();
    }

}

function loopMaps(){
    $('.new_map').each(function() {

        var name = $(this).attr('data-name');
        var long = $(this).attr('data-long');
        var lat = $(this).attr('data-lat');

        loadMap(name, long, lat);

    }); 
}

function loadMap(this_map, long, lat){
    var map = new mapboxgl.Map({
        container: this_map,
        style: 'mapbox://styles/mapbox/streets-v9',
        center: [long, lat],
        zoom: 12
    });

    map.on('load', function () {
        map.loadImage('http://localhost:8000/images/location_pin.png', function(error, image) {
            if (error) throw error;
            map.addImage('cat', image);
            map.addLayer({
                "id": "points",
                "type": "symbol",
                "source": {
                    "type": "geojson",
                    "data": {
                        "type": "FeatureCollection",
                        "features": [{
                            "type": "Feature",
                            "geometry": {
                                "type": "Point",
                                "coordinates": [long, lat]
                            }
                        }]
                    }
                },
                "layout": {
                    "icon-image": "cat",
                    "icon-size": 0.35
                }
            });
        });

    });

}