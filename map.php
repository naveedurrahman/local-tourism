<?php

$location = $_GET['location'];
?>
<html>

<head>
  <title>LT | Places Search Box</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <!-- playground-hide -->
  <script>
    const process = {
      env: {}
    };
    process.env.GOOGLE_MAPS_API_KEY =
      "AIzaSyBYRMXMAW7MK7_snwG8lSJEQCRetS5WzLM";
  </script>
  <!-- playground-hide-end -->

  <link rel="stylesheet" type="text/css" href="./style.css" />
  <!-- <script type="module" src="index.js"></script> -->
  <style>
    /* 
 * Always set the map height explicitly to define the size of the div element
 * that contains the map. 
 */
 *{
  margin : 0;
  padding: 0;
  box-sizing:border-box;
}
    #map {
      height: 100vh;
    }

    /* 
 * Optional: Makes the sample page fill the window. 
 */


    #description {
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
    }

    #infowindow-content .title {
      font-weight: bold;
    }

    #infowindow-content {
      display: none;
    }

    #map #infowindow-content {
      display: inline;
    }

    .pac-card {
      background-color: #fff;
      border: 0;
      border-radius: 2px;
      box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
      margin: 10px;
      padding: 0 0.5em;
      font: 400 18px Roboto, Arial, sans-serif;
      overflow: hidden;
      font-family: Roboto;
      padding: 0;
    }

    #pac-container {
      padding-bottom: 12px;
      margin-right: 12px;
    }

    .pac-controls {
      display: inline-block;
      padding: 5px 11px;
    }

    .pac-controls label {
      font-family: Roboto;
      font-size: 13px;
      font-weight: 300;
    }

    #pac-input {
      background-color: #fff;
      font-family: Roboto;
      font-size: 20px;
      font-weight: 400;
      margin-left: 12px;
      padding: 10px 20px;
      text-overflow: ellipsis;
      width: 400px;
    }

    #pac-input:focus {
      border-color: #4d90fe;
    }

    #title {
      color: #fff;
      background-color: #4d90fe;
      font-size: 25px;
      font-weight: 500;
      padding: 6px 12px;
    }

    #target {
      width: 345px;
    }
  </style>
</head>

<body>
  <input id="pac-input" class="controls" type="text" placeholder="Search Box" value="<?php echo $location; ?>" />
  <div id="map"></div>

  <!-- 
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYRMXMAW7MK7_snwG8lSJEQCRetS5WzLM&callback=initAutocomplete&libraries=places&v=weekly" defer></script>




  <script>
    function initAutocomplete() {
      const map = new google.maps.Map(
        document.getElementById("map"), {
          center: {
            lat: 30.3753,
            lng: 69.3451
          },
          zoom: 5,
          mapTypeId: "roadmap",
        }
      );

      // Create the search box and link it to the UI element.
      const input = document.getElementById("pac-input");
      const searchBox = new google.maps.places.SearchBox(input);

      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      // Bias the SearchBox results towards current map's viewport.
      map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
      });

      let markers = [];

      // Listen for the event fired when the user selects a prediction and retrieve
      // more details for that place.
      searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();

        if (places.length == 0) {
          return;
        }

        // Clear out the old markers.
        markers.forEach((marker) => {
          marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        const bounds = new google.maps.LatLngBounds();

        places.forEach((place) => {
          if (!place.geometry || !place.geometry.location) {
            console.log("Returned place contains no geometry");
            return;
          }

          const icon = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25),
          };

          // Create a marker for each place.
          markers.push(
            new google.maps.Marker({
              map,
              icon,
              title: place.name,
              position: place.geometry.location,
            })
          );

          if (place.geometry.viewport) {
            // Only geocodes have viewport.
            bounds.union(place.geometry.viewport);
          } else {
            bounds.extend(place.geometry.location);
          }
        });
        map.fitBounds(bounds);
      });
    }
  </script>
  <!-- <script src="js/jquery-1.12.0.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    // document.getElementById('pac-input').focus();
    $(document).ready(function() {
      setTimeout(() => {
        alert('Press enter to load the map')
        $('#pac-input').focus();
        

        // var e = jQuery.Event("keydown");
        // e.which = 13; //choose the one you want
        // e.keyCode = 13;
        // $("#pac-input").click();
      }, 1000);


    })
  </script>
</body>

</html>