<?php
session_start();

require 'php/forms.php';

?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrimeAgg - App</title>


  
    <link rel="stylesheet" href="https://bootswatch.com/5/darkly/bootstrap.min.css">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>



    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
    crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
	  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
	  <link rel="stylesheet" href="css/leaflet.css">

    <link rel="stylesheet" href="css/app.css">


    <script src="data/LAPD_Divisions.js"></script>

 
</head>

<body>



<div id="main">

  <ul>

    <li><a class="active" id="app" onclick="UI.toggleActive('app')">App</a></li>
    <li><a href="index.html">Home</a></li>
    <li ><a  class="none" id="search" onclick="UI.openNav(1); UI.closeNav(2); UI.closeNav(3); UI.toggleActive('search');UI.moveMain(1);" >Search</a></li>
    <li><a class="none" id="register" onclick="UI.openNav(2); UI.closeNav(1); UI.closeNav(3); UI.toggleActive('register');UI.moveMain(2);">Sign In</a></li>
    
   
<?php

  if($_SESSION['check'] == 1){ 
    addLI();
    }

?>
          
  </ul>
  
</div>



<div id="mySidebar1" class="sidebar" style="display: block;">
  <a href="javascript:void(0)" class="closebtn" onclick="UI.closeNav(1);UI.moveMain(1);UI.toggleActive('app')">&times;</a>

  <a href="" id="searchHeader">Search</a>
  <form action="app.php" method="POST">
  <div class="form-group px-4">
  
    <label for="areaSelect" class="form-label mt-4">Area Name</label>
        <select class="form-select" name="areaSelect" id="areaSelect">
          <option value="%">All</option>
          <?php optionator($areaOptArray);?>
        </select>

      <label for="crimeSelect" class="form-label mt-4">Crime</label>
      <select class="form-select" name="crimeSelect" id="crimeSelect">
        <option value="%">All</option>
        <?php optionator($crimeOptArray);?>
      </select>

      <label for="timeSelect" class="form-label mt-4">Time</label>
      <select class="form-select" name="timeSelect" id="timeSelect">
        <option value="%">All</option>
        <?php optionator($timeOptArray);?>
      </select><br>

   
    <button class="btn btn-secondary my-2 my-sm-2 w-100" type="submit" name="search-submit"id="searchSubmit">Search</button>

  </div> <!--   End of form group div -->
  </form>
</div> <!--   End of sidebar div -->



<div id="mySidebar2" class="sidebar" style="display: block;">
  <a href="javascript:void(0)" class="closebtn" onclick="UI.closeNav(2);UI.moveMain(2);UI.toggleActive('app')">&times;</a>

  <a href="" id="registerHeader">Sign In</a>

  <div class="form-group px-4">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <label for="signin-email" class="form-label pt-4">Email</label>
    <input type="email" name="signin-email">

    <label for="signin-password" class="form-label pt-4">Password</label>
    <input type="password" id="password" name="signin-password"><br><br>
    

    <button class="btn btn-secondary my-2 my-sm-2 w-100" type="submit" name="signin-submit" id="siginSubmit">Login</button>



  <br><br><p>Don't have an account?<br><span id="signup" style="text-decoration:underline" onclick="UI.openNav(3);UI.closeNav(2);">Sign Up</span></p>
  </div> <!--   End of form group div -->
</form>
</div> <!--   End of sidebar div -->

<div id="mySidebar3" class="sidebar" style="display: block;">
  <a href="javascript:void(0)" class="closebtn" onclick="UI.closeNav(3);UI.moveMain(3);UI.toggleActive('app')">&times;</a>

  <a href="" id="registerHeader">Sign Up</a>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group px-4">
    
    <label for="signup-fname" class="form-label pt-4">First Name</label>
    <input type="text" name="signup-fname">

    <label for="signup-lname" class="form-label pt-4">Last Name</label>
    <input type="text" id="lname" name="signup-lname"><br>
    
    <label for="signup-email" class="form-label pt-4">Email</label>
    <input type="email" name="signup-email">

    <label for="signup-password" class="form-label pt-4">Password</label>
    <input type="password" id="signup-password" name="signup-password"><br><br>
    

    <button class="btn btn-secondary my-2 my-sm-2 w-100" type="submit" name="signup-submit" id="signupSubmit">Submit</button>



  <br><br><p>Have an account?<br><span id="signin" style="text-decoration:underline" onclick="UI.openNav(2); UI.closeNav(3)">Sign In</span></p>
  </div> <!--   End of form group div -->
  </form>
</div> <!--   End of sidebar div -->



  

<div id="map"></div> 



<script src="js/app.js"></script>

<script>


 let getCrimeColor = (d) => {
    return d == 'BATTERY' ? 'Yellow' :
           d == 'SEX'? 'Blue' :
           d == 'VANDALISM'? 'Green' :
           d == 'RAPE' ? 'Red' :
           d == 'SHOPLIFTING' ? 'Orange' :
           d == 'OTHER' ? 'Purple' :
           d == 'THEFT-GRAND'? 'Teal' :
           d == 'BURGLARY'? 'Gray' :
           d == 'CRIMINAL'? 'Black' :
           d == 'ARSON'? 'White' :
           d == 'INTIMATE'? 'lawngreen' :
           d == 'THEFT'? 'lightskyblue' :
           d == 'ROBBERY'? 'Brown' :
           d == 'ASSAULT'? 'Goldenrod' :
           d == 'VEHICLE'? 'Pink' :
           d == 'BRANDISH' ? 'Olive' :
           d == 'BUNCO'? 'Tan' :
           d == 'BIKE'? 'Lime' :
           d == 'LETTERS'? 'MediumSpringGreen' :
           d == 'VIOLATION'? 'Silver' :
           d == 'TRESPASSING'? 'Plum' :
           d == 'DISTURBING'? 'Purple' :
           d == 'THROWING'? 'Gold' :
           d == 'EXTORATION'? 'Teal' :
           d == 'CHILD'? 'FireBrick' :
                         '#BD0026'
    
    }
  





    // Add the markers to the map
<?php foreach ($locations as $location): ?>
  L.circleMarker([<?php echo $location['lat']; ?>, <?php echo $location['lng']; ?>], {
              radius: 4,
              fillColor: getCrimeColor('<?php echo $location['crime']; ?>'),
              color: "#000",
              weight: 1,
              opacity: 1,
              fillOpacity: 0.8
            })
            .addTo(map)
            .bindPopup('<strong><?php echo $location['crime']; ?></strong><p>Time: <?php echo $location['time']; ?></p>');

<?php endforeach; ?>


</script>



</body>
</html>


