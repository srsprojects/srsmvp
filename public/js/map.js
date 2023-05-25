function initMap() {
  const addressInput = document.getElementById('address');
  const latitudeInput = document.getElementById('latitude');
  const longitudeInput = document.getElementById('longitude');

  const map = new google.maps.Map(document.getElementById('gMap'), {
    zoom: 15
  });

  const autocomplete = new google.maps.places.Autocomplete(addressInput);
      autocomplete.bindTo('bounds', map);

      autocomplete.addListener('place_changed', function() {
        const marker = new google.maps.Marker({
          map: map,
          draggable: true
        });
  
        const place = autocomplete.getPlace();
        if (!place.geometry) {
          window.alert('No location found for the input address');
          return;
        }
        map.setCenter(place.geometry.location);
        map.setZoom(15);
        marker.setPosition(place.geometry.location);
        latitudeInput.value = place.geometry.location.lat();
        longitudeInput.value = place.geometry.location.lng();
      });
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function(position) {
        const userLatLng = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        map.setCenter(userLatLng);
        const marker = new google.maps.Marker({
          position: userLatLng,
          map: map,
          draggable: true
        });

        google.maps.event.addListener(marker, 'dragend', function() {
          const position = marker.getPosition();
          latitudeInput.value = position.lat();
          longitudeInput.value = position.lng();
        });

        google.maps.event.addListener(map, 'click', function(event) {
          marker.setPosition(event.latLng);
          latitudeInput.value = event.latLng.lat();
          longitudeInput.value = event.latLng.lng();
        });

        addressInput.value = "Fetching current location...";
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'location': userLatLng }, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              addressInput.value = results[0].formatted_address;
            } else {
              addressInput.value = "Address not found";
            }
          } else {
            addressInput.value = "Geocoding failed due to: " + status;
          }
        });
      },
      function() {
        handleLocationError(true, map.getCenter());
      },
    );
  } else {
    // Browser doesn't support geolocation
    handleLocationError(false, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, fallbackLatLng) {
  const addressInput = document.getElementById('address');
  addressInput.value = browserHasGeolocation ?
    'Error: The Geolocation service failed. Please enable Location Access' :
    'Error: Your browser doesn\'t support geolocation.';
  map.setCenter(fallbackLatLng);
}