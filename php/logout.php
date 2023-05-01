<?php
session_start();

if(isset($_POST['logout-submit'])){
  
    session_unset();
  
    session_destroy();
    
    header("Location: https://jeffhorgan.info/GoDaddy2/capstone3/app.php");
  }
  
?>