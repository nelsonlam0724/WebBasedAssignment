//map-----------------------------------------------------------------------------------------------
var map = L.map('map');

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

var marker = L.marker([0, 0], { draggable: true }).addTo(map);

function updateInputValue(latlng) {
    fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latlng.lat}&lon=${latlng.lng}&format=json`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('locationInput').value = data.display_name;
        });
}

function centerMapOnUserLocation() {
    if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLatLng = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setView(userLatLng, 13);
            marker.setLatLng(userLatLng);
            updateInputValue(userLatLng);
        });
    } else {
        console.log('Geolocation is not supported by this browser.');
    }
}

window.onload = centerMapOnUserLocation;

marker.on('dragend', function (event) {
    var latlng = marker.getLatLng();
    updateInputValue(latlng);
});

map.on('click', function (event) {
    var latlng = event.latlng;
    marker.setLatLng(latlng);
    updateInputValue(latlng);
});
