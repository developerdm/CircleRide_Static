
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=es"></script>
<script type="text/javascript">
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  var oldDirections = [];
  var currentDirections = null;

  function initialize() {
    var myOptions = {
      zoom: 16,
      /* center: new google.maps.LatLng(-33.879,151.235), */
	  center: new google.maps.LatLng(20.530, -97.465), 
	  scrollwheel: true,
	  keyboardShortcuts: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    directionsDisplay = new google.maps.DirectionsRenderer({
        'map': map,
        'preserveViewport': true,
        'draggable': true
    });
    directionsDisplay.setPanel(document.getElementById("directions_panel"));

    google.maps.event.addListener(directionsDisplay, 'directions_changed',
      function() {
        if (currentDirections) {
          oldDirections.push(currentDirections);
          setUndoDisabled(false);
        }
        currentDirections = directionsDisplay.getDirections();
      });

    setUndoDisabled(true);

    calcRoute();
  }

  function calcRoute() {
    /*
	var start = 'Flores Magón 216, Tajín, Poza Rica, VER, México';
	*/
    var start = new google.maps.LatLng(20.530716257843117, -97.4659921595246);
    /*
	var end = 'Flores Magón, Tajín, Poza Rica, VER, México';
	*/
    var end = new google.maps.LatLng(20.528736909875942, -97.46384639231269);
	
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      }
    });
  }

  function undo() {
    currentDirections = null;
    directionsDisplay.setDirections(oldDirections.pop());
    if (!oldDirections.length) {
      setUndoDisabled(true);
    }
  }

  function setUndoDisabled(value) {
    document.getElementById("undo").disabled = value;
  }
</script>
</head>
<body onload="initialize()">
<div id="map_canvas" style="float:left;width:70%;height:100%"></div>
<div style="float:right;width:30%;height:100%;overflow:auto">
  <button id="undo" style="display:block;margin:auto" onclick="undo()">Deshacer
  </button>
  <div id="directions_panel" style="width:100%"></div>
</div>
</body>
</html>
