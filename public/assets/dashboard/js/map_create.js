var geocoder;
var googleMap;
var marker;
var autocomplete;

function myMap() {
    var myLatlng = { lat: lat, lng: lng };

    var mapProp = {
        center: myLatlng,
        zoom: 12,
    };

    googleMap = new google.maps.Map(
        document.getElementById("googleMap"),
        mapProp
    );

    marker = new google.maps.Marker({
        position: mapProp.center,
        map: googleMap,
        animation: google.maps.Animation.DROP,
        draggable: true,
    });

    geocoder = new google.maps.Geocoder();

    // Initialize Google Places Autocomplete
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById("location_inp")
    );
    autocomplete.addListener("place_changed", function () {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            console.log("No details available for input: '" + place.name + "'");
            return;
        }

        // Move marker & update map
        googleMap.setCenter(place.geometry.location);
        googleMap.setZoom(14);
        marker.setPosition(place.geometry.location);

        // Update lat/lng hidden fields
        document.getElementById("lat_inp").value =
            place.geometry.location.lat();
        document.getElementById("lng_inp").value =
            place.geometry.location.lng();
    });

    // Click event to update marker & get address
    googleMap.addListener("click", function (mapsMouseEvent) {
        let clickLocation = mapsMouseEvent.latLng;
        marker.setPosition(clickLocation);

        geocoder.geocode(
            { location: clickLocation },
            function (results, status) {
                if (status === "OK" && results[0]) {
                    document.getElementById("location_inp").value =
                        results[0].formatted_address;
                    document.getElementById("lat_inp").value =
                        clickLocation.lat();
                    document.getElementById("lng_inp").value =
                        clickLocation.lng();
                } else {
                    console.log("Geocode error: " + status);
                }
            }
        );
    });

    // Drag marker to update address
    marker.addListener("dragend", function () {
        var position = marker.getPosition();
        geocoder.geocode({ location: position }, function (results, status) {
            if (status === "OK" && results[0]) {
                document.getElementById("location_inp").value =
                    results[0].formatted_address;
                document.getElementById("lat_inp").value = position.lat();
                document.getElementById("lng_inp").value = position.lng();
            }
        });
    });
}

// Get current location
function getCurrentPos() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };
            marker.setPosition(pos);
            googleMap.setCenter(pos);
            googleMap.setZoom(14);

            geocoder.geocode({ location: pos }, function (results, status) {
                if (status === "OK" && results[0]) {
                    document.getElementById("location_inp").value =
                        results[0].formatted_address;
                    document.getElementById("lat_inp").value = pos.lat;
                    document.getElementById("lng_inp").value = pos.lng;
                }
            });
        });
    } else {
        console.log("Geolocation is not supported.");
    }
}
