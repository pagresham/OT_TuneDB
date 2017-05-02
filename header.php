<?PHP
session_start();
// init vars here
$username = "";
$memberId = "";

include "authentication.php";
require("includes/config.php");
require("includes/connect.php");


if (isLoggedIn()) {
    //print "setting session vars";
    $username = $_SESSION['user_name'];
    $memberId = $_SESSION['member_id'];
    //print $memberId;
  } 

// $username = $_SESSION['user_name'];
// $memberId = $_SESSION['member_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>TuneDb</title>
  <!-- Add some SEO -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="Author" content="Pierce Gresham">
  <meta name="Keywords" content="music fiddle tunes links style database friends style link video">
  <meta name="Description" content="Track tunes in a database, Follow friends, remember tunes and more">
  
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="dls/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> -->
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJl1s_ElOQABn5g9toMSrBQoKtBPv6NFs"></script>
  <script src="dls/jquery-3.2.1.js"></script>
  <script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"
  integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="
  crossorigin="anonymous"></script>
  
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <script src="dls/bootstrap.js"></script>
  <script type="text/javascript" src="js/app.js"></script>
  
</head>
<body>
<div id="container">
<div id="header">

  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" >OT_Database</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li <?PHP print (strpos($_SERVER['PHP_SELF'], '/index.php')) ? "class='active'" : ""; ?>><a href="index.php">Home</a></li>
        <?PHP 
        if (isLoggedIn()) {
        ?>
          <li <?PHP print (strpos($_SERVER['PHP_SELF'], '/explore_more.php')) ? "class='active'" : ""; ?>><a href='explore_more.php'>Explore More</a></li>
          
          <li <?PHP print (strpos($_SERVER['PHP_SELF'], '/add_tune.php')) ? "class='active'" : ""; ?>><a href='add_tune.php'>Add Tune</a></li>
         
          <li <?PHP print (strpos($_SERVER['PHP_SELF'], '/myTunes.php')) ? "class='active'" : ""; ?>><a href='myTunes.php'>myTunes</a></li>

          <li <?PHP print (strpos($_SERVER['PHP_SELF'], '/map.php')) ? "class='active'" : ""; ?>><a href='map.php'>User Map</a></li>
        <?PHP  
       }
       else {
        ?>
        <li <?PHP print (strpos($_SERVER['PHP_SELF'], '/explore.php')) ? "class='active'" : ""; ?>><a href="explore.php">Explore</a></li>
        <?PHP 
       }
       ?>
        <li <?PHP print (strpos($_SERVER['PHP_SELF'], '/tune_links.php')) ? "class='active'" : ""; ?>><a href="tune_links.php">Video Links</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        
        
      <?PHP
      if (isLoggedIn()) {
        print "<li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
         print "<p class='navbar-text'>Welcome ".$username."</p>";
      }
      else {
      ?>
        <li <?PHP print (strpos($_SERVER['PHP_SELF'], '/login.php')) ? "class='active'" : ""; ?>><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Sign In</a></li>

        <li <?PHP print (strpos($_SERVER['PHP_SELF'], '/create_account.php')) ? "class='active'" : ""; ?>><a href="create_account.php"><span class="glyphicon glyphicon-user"></span> Create User</a></li>
      <?PHP
      }
      ?>
      </ul>
    </div>
  </div>
</nav>

</div>  
<!-- End Header div -->
<div id="body">