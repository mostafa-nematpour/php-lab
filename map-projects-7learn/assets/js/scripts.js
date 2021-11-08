const defaultLocation = [36.5383108, 52.6722651];
const defaultZoom = 15;

var current_position, current_accuray;


var map = L.map('map').setView(defaultLocation, defaultZoom);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 25,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1
}).addTo(map);


var markerGroup = L.layerGroup().addTo(map);

// show and pin markers

// L.marker(defaultLocation).addTo(map).bindPopup("mostafa home").openPopup();


map.on('dblclick', function (event) {
    // alert(event.latlng.lat+" "+event.latlng.lng);
    // 1 : add marker in clicked position
    L.marker(event.latlng).addTo(map);
    // 2 : open modal (form) for save the click location
    $('.modal-overlay').fadeIn(500);
    $('#lat-display').val(event.latlng.lat);
    $('#lng-display').val(event.latlng.lng);
    $('#l-type').val(0);
    $('#l-title').val('');
    $('.ajax-result').html('');
    // 3  done: fill the form and locationdata to server
    // 4 done: save location in database (status : pending review) 

    // 5 : review locaction and verify if ok
});


map.on('locationfound', function (e) {
    if (current_position) {
        map.removeLayer(current_position);
        map.removeLayer(current_accuray);
    }
    var radius = e.accuracy / 2;
    current_position = L.marker(e.latlng).addTo(map)
        .bindPopup(" دقت تقریبی " + radius + " متر ").openPopup();
    current_accuray = L.circle(e.latlng, radius).addTo(map);
});

map.on('locationerror', function (e) {
    console.log(e.message);
});

function locate() {
    map.locate({ setView: true, maxZoom: defaultZoom })
}

// setInterval(locate, 5000);


// map.on('zoomend',function(){
//     // alert(map.getBounds().getCenter());

//     // 1 : get bounds lines
//     // 2 : send bounds lines to server
//     // 3 : search location in map window
//     // 4 : show location markers in map window
// });



function showLocations(locations) {

    markerGroup.clearLayers();
    const Jlocations = JSON.parse(locations);

    Jlocations.forEach(function (loc) {
        L.marker([loc.lat, loc.lng]).bindPopup(loc.title).addTo(markerGroup);
    });

}


$(document).ready(function () {

    $('form#addLocationForm').submit(function (e) {
        e.preventDefault(); // prevent form submission
        // alert($(this).serialize());
        var form = $(this);
        var resultTag = form.find('.ajax-result');
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function (response) {
                resultTag.html(response);
            }
        });
    });

    $('.modal-overlay .close').click(function () {
        $('.modal-overlay').fadeOut();
    });
});
