<?php

$areaOptArray = [
  'SOUTHWEST', 
  'CENTRAL', 
  'NORTH HOLLYWOOD', 
  'MISSION',
  'DEVONSHIRE',
  'NORTHEAST',
  'HARBOR',
  'VAN NUYS',
  'WEST VALLEY',
  'WEST LOS ANGELES',
  'WILSHRE',
  'PACIFIC',
  'RAMPART',
  '77TH STREET',
  'HOLLENBECK',
  'SOUTHEAST' ,
  'HOLLYWOOD',
  'NEWTON',
  'FOOTHILL',
  'OLYMPIC',
  'TOPANGA'
];

$crimeOptArray = [
   'BATTERY',
   'SEX',
   'VANDALISM',
   'RAPE',
   'SHOPLIFTING',
   'OTHER',
   'THEFT-GRAND',
   'BURGLARY',
   'CRIMINAL',
   'ARSON',
   'INTIMATE',
   'THEFT',
   'ROBBERY',
   'ASSAULT',
   'VEHICLE',
   'BRANDISH',
   'BUNCO',
   'BIKE',
   'LETTERS',
   'VIOLATION',
   'TRESPASSING',
   'DISTURBING',
   'THROWING',
   'EXTORTION',
   'CHILD'
];

$timeOptArray = [
  '0000',
  '0100',
  '0200',
  '0300',
  '0400',
  '0500',
  '0600',
  '0700',
  '0800',
  '0900',
  '1000',
  '1100',
  '1200',
  '1300',
  '1400',
  '1500',
  '1600',
  '1700',
  '1800',
  '1900',
  '2000',
  '2100',
  '2200',
  '2300',
  '2400'
];



function optionator($argArray){
  foreach($argArray as $item){
    echo '


    <option value="'.$item.'">'.$item.'</option>

    ';
  };
}

function addLI(){
  
  $account = 'account';
  $app = 'app';
  $chart = 'chart';
  
  echo 
  '

  
  <li style="float: right;">
   <form action="php/logout.php" method="POST" id="logout-form" class="logoutSubmit">
   
        <button type="submit" class="btn btn-success" 
        style="margin-left: 10px; margin-top: 12px; margin-right:12px;background-color:#00CED1;" 
        name="logout-submit" 
        onclick="UI.logout()">Sign Out
        </button>
      </form>
  
  </li>
  
  <li style="float: right;">
    <form action="php/download_csv.php" method="POST" id="csv-form" class="csvSubmit">
        <button type="submit" 
          class="btn btn-success" 
          name="csv-submit" 
          style="margin-left: 10px; margin-top: 12px; margin-right:10px;background-color:#00CED1;"
          >CSV
        </button>
    </form>
  </li>
  <li style="float: right;"><a class="" id="account" onclick="UI.openNavRight(4);UI.moveMainLeft(4); UI.closeNav(2); UI.closeNav(3);UI.closeNav(5);UI.toggleActiveRight('.$account.')";>Account</a></li>
  <li style="float: right;"><a class="" id="chart" onclick="UI.openChartRight(5);UI.moveMainChart(5);UI.closeNav(2); UI.closeNav(3); UI.closeNav(4);UI.toggleActiveRight('.$chart.')";>Report</a></li>

  <li style="float: right; font-style: italic;"><a id="ulName">Welcome, '.$_SESSION['name'].'!</a></li>


  
  <div id="mySidebar4" class="leftsidebar" style="display: block;">
      <a href="javascript:void(0)" class="closebtn" onclick="UI.closeNav(4);UI.moveMainLeft(4);UI.toggleActiveRight(' . $app . ')">&times;</a>

      <a href="" id="accountHeader">Account Details</a>
      <form action="app.php" method="POST">
      <div class="form-group px-4">

      <label for="signup-fname" class="form-label pt-4">First Name</label>
      <input type="text" name="changedetails-fname" value='. $_SESSION['name'] .'>

      <label for="changedetails-lname" class="form-label pt-4">Last Name</label>
      <input type="text" id="change-details-lname" name="changedetails-lname" value='. $_SESSION['lname'] .'><br>

      <label for="changedetails-email" class="form-label pt-4">Email</label>
      <input type="email" name="changedetails-email" value='. $_SESSION['email'] .'>

      <label for="changedetails-password" class="form-label pt-4">Password</label>
      <input type="password" id="changedetails-password" name="changedetails-password" value='. $_SESSION['pass'] .'><br><br>


      <button class="btn btn-secondary my-2 my-sm-2 w-100" type="submit" name="changedetails-submit" id="changedetails-submit">Save</button>
  </div>

  <div id="mySidebar5" class="leftsidebar" style="display: block;">
    <a href="javascript:void(0)" class="closebtn" onclick="UI.closeNav(5);UI.moveMainLeft(5);UI.toggleActiveRight(' . $app . ')">&times;</a>

    <a href="" id="registerHeader">Report</a>

      <aside>
        <iframe style="height: 800px;width:600px;" src="popup.html"></iframe>
      </aside>

      

  </div> 

  

  
'
;
}


$hostname="localhost";
$username="jeff";
$password="pisforpotato";
$dbname="CRIME";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
  //echo '<div class="success" id="dbase" onclick="removeDbaseHeader()">Dbase connection good!</div>';
}


if(isset($_POST['signin-submit'])){

  $username = mysqli_real_escape_string($conn, $_POST['signin-email']);
  $user_password = mysqli_real_escape_string($conn, $_POST['signin-password']);

  


    $sql= "SELECT * FROM `User_Info` WHERE `username` ='$username' AND `user_password` = '$user_password'";
    $result = mysqli_query($conn,$sql);

    $check = mysqli_fetch_array($result);

    $name = $check[3];
    $lname = $check[4];
    $email = $check[1];
    $pass = $check[2];
    $id = $check[0];

    $_SESSION['name'] = $name;
    $_SESSION['lname'] = $lname;
    $_SESSION['email'] = $email;
    $_SESSION['pass'] = $pass;
    $_SESSION['id'] = $id;
    
    
    
    if (isset($username) && isset($user_password)) {
      if (isset($check)) {
        $_SESSION['check'] = 1;
        echo '<div class="success" id="statusHeader" onclick="removeElement();">Sign-In Success</div>';
        //addLI();
      } else {
        echo '<div class="failure" id="statusHeader" onclick="removeElement();">Sign-In Failure</div>';
      }
    } else {
      echo '<div class="failure" id="statusHeader" onclick="removeElement();">Sign-In Failure</div>';
    }

    mysqli_select_db ($conn, $dbname);
   
}



if(isset($_POST['signup-submit'])){

  $userfname = mysqli_real_escape_string($conn, $_POST['signup-fname']);
  $userlname = mysqli_real_escape_string($conn, $_POST['signup-lname']);
  $useremail = mysqli_real_escape_string($conn, $_POST['signup-email']);
  $user_password = mysqli_real_escape_string($conn, $_POST['signup-password']);


  // $query = "INSERT INTO User_Info(username, user_password, fname, lname)
  // VALUES('$useremail', '$user_password', '$userfname', '$userlname')";


  // if(isset($query)){
  //   echo '<div class="success" id="statusHeader" onclick="removeElement();">Sign-Up Success!</div>';


  // }else{

  //   echo '<div class="failure" id="statusHeader" onclick="removeElement();">Sign-Up Failure!</div>';
  // }

//   if(!empty($userfname) && !empty($userlname) && !empty($useremail) && !empty($user_password)){
//     if (isset($query)) {
//       echo '<div class="success" id="statusHeader" onclick="removeElement();">Sign-Up Success</div>';
//       //addLI();
//     } else {
//       echo '<div class="failure" id="statusHeader" onclick="removeElement();">Sign-Up Failure</div>';
//     }
//   } else {
//     echo '<div class="failure" id="statusHeader" onclick="removeElement();">Sign-Up Failure</div>';
//   }


//   mysqli_select_db($conn, $dbname);
//   mysqli_query($conn, $query);
 
   
// }

if (isset($_POST['signup-submit'])) {
  $userfname = mysqli_real_escape_string($conn, $_POST['signup-fname']);
  $userlname = mysqli_real_escape_string($conn, $_POST['signup-lname']);
  $useremail = mysqli_real_escape_string($conn, $_POST['signup-email']);
  $user_password = mysqli_real_escape_string($conn, $_POST['signup-password']);

  $query = "INSERT INTO User_Info(username, user_password, fname, lname)
      VALUES('$useremail', '$user_password', '$userfname', '$userlname')";

  if (!empty($userfname) && !empty($userlname) && !empty($useremail) && !empty($user_password)) {
      if (mysqli_query($conn, $query)) {
          echo '<div class="success" id="statusHeader" onclick="removeElement();">Sign-Up Success</div>';
      } else {
          echo '<div class="failure" id="statusHeader" onclick="removeElement();">Sign-Up Failure</div>';
      }
  } else {
      echo '<div class="failure" id="statusHeader" onclick="removeElement();">Sign-Up Failure</div>';
  }
}

}

$conn->close();

// Connect to the database
$servername2 = "localhost";
$username2 = "jeff";
$password2 = "pisforpotato";
$dbname2 = "CRIME";

$crime_conn= new mysqli($servername2, $username2, $password2, $dbname2);

// Check connection
if ($crime_conn->connect_error) {
    die("Connection failed: " . $crime_conn->connect_error);
}

// Query the database for latitude and longitude values
if(isset($_POST['search-submit'])){

    $varArea = htmlspecialchars($_POST['areaSelect']);
    $varCrime = htmlspecialchars($_POST['crimeSelect']);
    $varTime = htmlspecialchars($_POST['timeSelect']);

    $search_sql = "SELECT area_name, lat, lon, crm_cd_desc, time_occ 
                   FROM crime_info 
                   WHERE((area_name = '$varArea' OR area_name LIKE '$varArea')
                   AND (crm_cd_desc = '$varCrime' OR crm_cd_desc LIKE '$varCrime')
                   AND (time_occ = '$varTime' OR time_occ LIKE '$varTime'))";

    $search_result = $crime_conn->query($search_sql);

    $check2 = mysqli_fetch_array($search_result);

    // Create an array to hold the location data
    $locations = array();
    $locations2 = array();

    if ($search_result->num_rows > 0) {
        // Loop through the result set and add each location to the array
        while($row = $search_result->fetch_assoc()) {
            $locations[] = array('lat' => $row['lat'], 'lng' => $row['lon'], 'crime' => $row['crm_cd_desc'], 'time' => $row['time_occ']);
            $locations2[] = array('area_name'=>$row['area_name'],'lat' => $row['lat'], 'lng' => $row['lon'], 'crime' => $row['crm_cd_desc'], 'time' => $row['time_occ']);

        }
    } else {
        echo "0 results";
    }

    $_SESSION['locations'] = $locations2;


    
    
  } else {
    $crime_sql = "SELECT lat, lon,crm_cd_desc,time_occ FROM crime_info";
    $crime_result = $crime_conn->query($crime_sql);

    // Create an array to hold the location data
    $locations = array();

    if ($crime_result->num_rows > 0) {
        // Loop through the result set and add each location to the array
        while($row = $crime_result->fetch_assoc()) {
            $locations[] = array('lat' => $row['lat'], 'lng' => $row['lon'], 'crime' => $row['crm_cd_desc'],'time' => $row['time_occ']);
        }
    } else {
        echo "0 results";
    }

    $_SESSION['locations'] = $locations;
}

// Close the database connection
$crime_conn->close();







if(isset($_POST['changedetails-submit'])){

  $hostname="localhost";
  $username="jeff";
  $password="pisforpotato";
  $dbname="CRIME";

  // Create connection
  $conn = mysqli_connect($hostname, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Query to select idno from User_Info table
  $select_sql = "SELECT idno FROM User_Info";

  // Execute the query and fetch the result
  $result = mysqli_query($conn, $select_sql);
  $row = mysqli_fetch_assoc($result);
  

  $idno = $row['idno'];
  

  // Get the new user data from the form inputs
  $userfname = mysqli_real_escape_string($conn, $_POST['changedetails-fname']);
  $userlname = mysqli_real_escape_string($conn, $_POST['changedetails-lname']);
  $useremail = mysqli_real_escape_string($conn, $_POST['changedetails-email']);
  $user_password = mysqli_real_escape_string($conn, $_POST['changedetails-password']);

  // Query to update the user data in the User_Info table using the idno obtained from the first query
  $update_sql = "UPDATE User_Info SET username = '$useremail', fname = '$userfname', lname = '$userlname', user_password = '$user_password' WHERE idno = $idno";

  // Execute the update query
  if (mysqli_query($conn, $update_sql)) {
    echo '<div class="success" id="statusHeader" onclick="removeElement()">Update good!</div>';
    $_SESSION['name'] = $userfname;
    
    $_SESSION['lname'] = $userlname;
    $_SESSION['email'] = $useremail;
    $_SESSION['pass'] = $user_password;
  
  } else {
    echo '<div class="failure" id="statusHeader" onclick="removeElement()">Update bad!</div>';

  }

  // Close the database connection
  mysqli_close($conn);
}


if(isset($_POST['logout-submit'])){
  
  session_unset();

  session_destroy();
  
}





?>