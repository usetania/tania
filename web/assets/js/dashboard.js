(function() {
    $(document).ready(function() {
        var fieldMap = L.map('map');
        var locations = $('#map').data('locations');
        var markers = [];

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
            id: 'mapbox.streets'
        }).addTo(fieldMap);

        locations.forEach(function(latLng) {
            if(latLng[0] !== null || latLng[1] !== null) {
                // create the marker
                var marker = L.marker(latLng);
                markers.push(marker);
            }    
        });

        var group = new L.featureGroup(markers);
        fieldMap.fitBounds(group.getBounds());
        group.addTo(fieldMap);
    });
})();