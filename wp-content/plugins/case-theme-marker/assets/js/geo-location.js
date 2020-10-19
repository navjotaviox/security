(function( $ ) {
    "use strict";

    $.each($(".marker_geo_location"), function (index, el) {
        el = $(el);
        /* marker selected. */
        var rc_lat     = el.find('.marker_lat').val();
        var rc_lng     = el.find('.marker_lng').val();
        var rc_zoom    = 4;
        var rc_market  = false;

        var rc_center  = {lat: 44.4738677, lng: 20.2606416};

        if(rc_lat && rc_lng){
            rc_center  = {lat: parseFloat(rc_lat), lng: parseFloat(rc_lng)};
            rc_zoom    = parseInt(el.find('.marker_zoom').val());
            rc_market  = true;
        }

        /* default map. */
        var map = new google.maps.Map(el.find('.marker_content').get(0), {
            center: rc_center,
            zoom: rc_zoom,
            mapTypeId: 'roadmap',
            mapTypeControl: false
        });

        // Try HTML5 geolocation.
        if (rc_market == false && navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(pos);
                map.setZoom(12);
            });
        }

        // Create the search box and link it to the UI element.
        var input = el.find('.marker_search').get(0);
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        // Create a marker.
        var marker_options = {map: map, draggable: true};
        if(rc_market == true){
            marker_options.position = rc_center;
        }

        var marker = new google.maps.Marker(marker_options);

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                marker.setPosition(null);
                return;
            }

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();

            places.forEach(function(place, index) {

                if (!place.geometry || index > 0) {
                    return;
                }

                // marker set position.
                marker.setPosition(place.geometry.location);
                set_values();

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });

            map.fitBounds(bounds);
        });

        /* map events. */
        map.addListener('rightclick', function(event) {
            // marker set position.
            marker.setPosition(event.latLng);
            set_values();
        });

        map.addListener('zoom_changed', function(event) {
            el.find('.marker_zoom').val(map.getZoom());
        });

        marker.addListener('dragend', function () {
            set_values();
        });

        marker.addListener('rightclick', function () {
            marker.setPosition(null);
            remove_values();
        });

        /* fixed firefox. */
        el.on('mouseleave', function () {
            set_values();
        });

        function set_values() {
            if(marker.position) {
                el.find('.marker_lat').val(marker.position.lat());
                el.find('.marker_lng').val(marker.position.lng());
            }
        }
        
        function remove_values() {
            el.find('.marker_lat').val('');
            el.find('.marker_lng').val('');
        }
    });
})( jQuery );