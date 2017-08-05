(function() {
    $(document).ready(function() {
        var fieldMap, markerLayer;
        var currentLatLng = [$('#map').data('lat'), $('#map').data('lng')];
        var defaultLatLng = [-8.4960936, 115.2485298];
        
        /* Initialize the map and tile layer */
        function mapInit(latLng) {
            fieldMap = L.map('map').setView(latLng, 13);
            markerLayer = L.marker(latLng).addTo(fieldMap);

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                    '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                id: 'mapbox.streets'
            }).addTo(fieldMap);
        }

        /* Get current lat and lng from the click on top of map */
        function onMapClick(e) {
            fieldMap.removeLayer(markerLayer);

            $('#field_lat').val(e.latlng.lat);
            $('#field_lng').val(e.latlng.lng);

            markerLayer = L.marker([e.latlng.lat, e.latlng.lng]).addTo(fieldMap);
        }

        if(currentLatLng[0] === "" || currentLatLng[1] === "") {
            if("geolocation" in navigator){
                navigator.geolocation.getCurrentPosition(function(position){
                    mapInit([position.coords.latitude, position.coords.longitude]);
                    fieldMap.on('click', onMapClick);
                }, function(error) {
                    // if error it will use default lat lng
                    mapInit(defaultLatLng);
                    fieldMap.on('click', onMapClick);
                });
            } else {
                mapInit(defaultLatLng);
                fieldMap.on('click', onMapClick);
            }
        } else {
            mapInit(currentLatLng);
            fieldMap.on('click', onMapClick);
        }

        /* form validation here */
        $('#field_name').keyup(function(e) {
            var maxLength = 50;
            var textlen = $(this).val().length;

            if(textlen <= maxLength) {
                var spanText = "Name ("+textlen+"/"+maxLength+" chars)";
                $('#label_field_name').text(spanText);
            }
        });
    });
})();