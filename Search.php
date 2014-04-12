<?php

//capture search term and remove spaces at its both ends if the is any
$searchTerm = trim($_GET['keyname']);

//check whether the name parsed is empty
if($searchTerm == "")
{
        echo "Enter name you are searching for.";
        exit();
}

//database connection info
$host = "localhost"; //server
$db = "atozoo"; //database name
$user = "root"; //dabases user name
$pwd = "in4000"; //password

//connecting to server and creating link to database
$link = mysqli_connect($host, $user, $pwd, $db)
        or die("Unable to connect to MYSQL.");

//MYSQL search statement
$query = "SELECT * FROM STLZoo WHERE animal LIKE '%$searchTerm%'";

$results = mysqli_query($link, $query);

/*if(mysqli_num_rows($results) >= 1) {
	$gold = 1;
} else {
	$gold = 0;
}*/

/* check whethere there were matching records in the table
by counting the number of results returned */
if(mysqli_num_rows($results) >= 1)
{
        $output = "";
        while($row = mysqli_fetch_array($results))
        {
				
                $output .= "ID: " . $row['id'] . "<br />";
                $output .= "Animal: " . $row['Animal'] . "<br />";
        }
		echo $output;
}
else
        echo "There was no matching record for the name " . $searchTerm;
?> 

<?php if(mysqli_num_rows($results) >= 1): ?>
<!doctype html>
<html>
  <head>
    <title>A to Zoo</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/site.css">

    <!-- Map -->
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

    <style type="text/css">
      html { height: 80.8% }
      body { height: 80.8%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
	<script type="text/javascript" src="jquery-2.1.0.min.js">
	</script>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9aGBhOrPZgE82DKXfh5qE3ipGraldw6Q&sensor=false">
    </script>
    
    <script type="text/javascript">

    // Sets the coordinates of the zoos to a variable
    var zooStLouis = new google.maps.LatLng(38.63665,-90.29251);
    var zooChicago = new google.maps.LatLng(41.97340,-87.70078);

    // Sets the variable for the info window
    var infowindowstlouis = new google.maps.InfoWindow();
    var infowindowchicago = new google.maps.InfoWindow();

    // This function initializes the map
    function initialize() {
      var mapOptions = {
        center: new google.maps.LatLng(37.5, -100),
        zoom: 5
      };

      var map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);
         
      // Creates the St Louis zoo marker
      var markerStLouis = new google.maps.Marker({
        animation:google.maps.Animation.DROP,
        position:zooStLouis,
      });
      
      // Creates the Chicago zoo marker  
      var markerChicago = new google.maps.Marker({
        animation:google.maps.Animation.DROP,
        position:zooChicago,
      });

      // Assigning content to the contentString variables
      var contentStLouis = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<div id="bodyContent">'+
      '<p><b>St. Louis Zoo</b></p>'+
      '<p><a href="http://www.stlzoo.org">'+
      'Visit Site</a> '+
      '<p><a href="https://www.google.com/maps/place/Saint+Louis+Zoo/@38.636645,-90.292514,17z/data=!3m1!4b1!4m2!3m1!1s0x87d8b55ccc04062d:0x6075080197e8e830">'+
      'Directions</a> '
      '</div>'+
      '</div>';

      var contentChicago = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<div id="bodyContent">'+
      '<p><b>Chicago</b></p>'+
      '<p><a href="http://www.lpzoo.org">'+
      'Lincoln Park Zoo</a> '+
      '<p><a href="https://www.google.com/maps/place/Lincoln+Park+Zoo/@41.92089,-87.632917,17z/data=!3m1!4b1!4m2!3m1!1s0x880fd36b093a9a07:0x940cc06f90294db">'+
      'Directions</a> '
      '</div>'+
      '</div>';

      // Calling the function for the info window
      makeInfoWindowEvent(map, infowindowstlouis, contentStLouis, markerStLouis);
      makeInfoWindowEvent(map, infowindowchicago, contentChicago, markerChicago);

	  markerStLouis.setMap(map);
	  /*markerChicago.setMap(map);*/
    
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    // This function handles the clicks for the info windows
    function makeInfoWindowEvent(map, infowindow, contentString, marker) {
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString);
        infowindow.open(map, marker);
      });
    }

    function toggleBounce() {
      if (markerStLouis.getAnimation() != null) {
        markerStLouis.setAnimation(null);
      } else {
        markerStLouis.setAnimation(google.maps.Animation.BOUNCE);
      }
    }

    function toggleBounce() {
      if (markerChicago.getAnimation() != null) {
        markerChicago.setAnimation(null);
      } else {
        markerChicago.setAnimation(google.maps.Animation.BOUNCE);
      }
    }
	

    </script>

    

  </head>
  <meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />

  <!-- Search bar -->
  <body>
    <nav class="navbar navbar-default" role="navigation">
      <div class="navbar-header">
        <a href="index.html" class="navbar-brand">A to Zoo</a>
      </div>

      <ul class="nav navbar-nav">
        <li class="active"><a href="AtoZoo.html">Home</a></li>
        <li class=""><a href="about.html">About</a></li>
      </ul>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <div class="jumbotron">
            <div class="container">
              <h1 align="center">Let's Find an Animal!</h1>
            </div>
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
        </div>
      </div>
    </div>


  <div class="row">
    <div class="col-md-2 col-md-offset-5">
      <form action="search.php" method="get">
        <label>Name:
        <input type="text" name="keyname" />
        </label>
        <input type="submit" value="Search" />
      </form>
    </div>
  </div>

  <div id="map-canvas" style="height:100%"></div>
    
  <script type="text/javascript" src="js/bootstrap.js"></script>
  </body>
</html>
<?php endif; ?>
