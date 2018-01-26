var map;
var currentMarker;
var locationsLayer = new L.layerGroup();
window.onload = function() {
  /*
  if (navigator.geolocation) {
    var geo_options = {
      enableHighAccuracy: true,
      maximumAge        : 30000,
      timeout           : 27000
    };
    navigator.geolocation.getCurrentPosition(createMap, error, geo_options);
  } else {
    alert('No tienes servicio para poder saber tu ubicación');
  }
  */
}();

function error(error) {
  alert('ERROR('+error.code+'): '+error.message+'');
}

function createMap(position) {
  var currentLat = position.coords.latitude;
  var currentLng = position.coords.longitude;
  currentMarker = L.marker([currentLat, currentLng]);

  map = new L.Map('map-public');
  var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
  var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
  var osm = new L.TileLayer(osmUrl, {minZoom: 10, maxZoom: 18, attribution: osmAttrib});

  map.setView(new L.LatLng(currentLat, currentLng), 15);
  map.addLayer(osm);
  map.addLayer(locationsLayer);
  var currentPopup = L.popup({
    autoClose: false,
    closeOnClick: false,
    className: 'current-popup'
  }).setContent("Tú estás aquí");

  currentMarker.addTo(map).bindPopup(currentPopup).openPopup();
  loadLocations();
  map.on('zoomend', function() {
    loadLocations();
  });
  map.on('dragend', function () {
    loadLocations();
  });
}

function loadLocations() {
  jQuery.post(jQuery('#admin-url').val(), {
    'action': 'getEventsInBounds',
    'north': map.getBounds().getNorth(),
    'south': map.getBounds().getSouth(),
    'west': map.getBounds().getWest(),
    'east': map.getBounds().getEast()
  }, function(response) {
    locationsLayer.clearLayers();
    var data = JSON.parse(response);

    var markerLat, markerLng, markerTemp;
    for(var i = 0; i < data.locations.length; i++) {
      markerLat = data.locations[i].meta['nwm-wp-location-lat'][0];
      markerLng = data.locations[i].meta['nwm-wp-location-lng'][0];
      markerTemp = L.marker([markerLat, markerLng]);
      var tag = L.popup({
        closeOnClick: false,
        autoClose: false,
        closeButton: false
      }).setContent(data.locations[i].post_title);
      markerTemp.bindPopup(tag);
      locationsLayer.addLayer(markerTemp);
    }
    locationsLayer.eachLayer(function (layer) {
      layer.openPopup();
    });
  });
}


function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1);
  var a =
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ;
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
  var d = R * c; // Distance in km
  return d;
}

function deg2rad(deg) {
  return deg * (Math.PI/180);
}

jQuery(document).ready(function () {
  jQuery('.mv-carousel').slick({dots: true});
});