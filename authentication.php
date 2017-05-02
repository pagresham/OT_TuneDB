<?PHP
function isLoggedIn() {
	if (isset($_SESSION['user_name'])) {
		
	return true;
	}
	else {
		return false;
	} 	
}

function logOut(){
	if(isset($_SESSION['user_name'])) {
		unset($_SESSION['user_name']);  // clear the session var for user-name
		print "<p>You are currently logged out. Please use this link to <a href='login.php'>Login</a>.</p>";
	}	
}

function refresh() {
	unset($_POST);
	header("Location: login.php");
}

function set_session_vars() {
	if (isLoggedIn()) {
		$username = $_SESSION['user_name'];
		$memberId = $_SESSION['member_id'];
		//print $memberId;
	}
}
// need to build query, and pass to mysqli_query to get result obj, then use this function
/**
 * draws table of tune results
 * @param  result 0bject $result  This is the result object
 * @param  DB Hook $db_hook object representing the hook in to the DB
 * @return none
 */
function display_results($result, $db_hook) {
	$vId =$mId ="";
    if(!$result){
      print "Problem with the SELECT statement."; 
      echo mysqli_error($db_hook);
    }
    else {
      //print "result one is TRUE";
      $rownum = mysqli_num_rows($result);

      print "<table class='result-table'>";

      $row = mysqli_fetch_assoc($result);
      if(!$row) {
      	print "Sorry, no tunes meet the sort requirements."; 
      	echo mysqli_error($db_hook);
      }
      else {

      	print "<tr>";
	      foreach ($row as $col => $value) {
	        print "<th>".$col."</th>";
	      }
	      print "</tr>";
	      // Rewind array pointer
	      mysqli_data_seek($result, 0);

	      while($row = mysqli_fetch_assoc($result)) {
	      	print "<tr class='tableRow'>";
	      	foreach($row as $col => $value) {
	      		print "<td>".$value."</td>";
	      	}
	      	print "</tr>";

	      }
      }
      print "</table>";
    }
    mysqli_free_result($result);
  } // end display_concert function 


  function display_myTunes($result, $db_hook, $page) {
  	$versionId = "";
    if(!$result){
      print "Problem with the SELECT statement."; 
      echo mysqli_error($db_hook);
    }
    else {
      //print "result one is TRUE";
      $rownum = mysqli_num_rows($result);

      print "<table class='result-table'>";

      $row = mysqli_fetch_assoc($result);
      if(!$row) {
      	print "Sorry, no tunes meet the sort requirements."; 
      	echo mysqli_error($db_hook);
      }
      else {

      	print "<tr>";
	      foreach ($row as $col => $value) {
	        print "<th>".$col."</th>";
	      }
	      print "</tr>";
	      // Rewind array pointer
	      mysqli_data_seek($result, 0);

	      while($row = mysqli_fetch_assoc($result)) {
	      	print "<tr>";
	      	foreach($row as $col => $value) {
	      		// will not print the vId, but I still have it to use in the get array. 
	      		if ($col == "VERSION_ID"){
	      			$versionId = $value;
	      		}
	      		else {
	      			print "<td>".$value."</td>";	
	      		}
	      	}
	      	
	      	if(strpos($_SERVER['PHP_SELF'], '/myTunes.php')) {
	      		print "<td><a href='details.php?versionId_=".$versionId."'>Details</a></td>";	
	      	}
	      	print "</tr>";

	      }
      }
      print "</table>";
    }
    mysqli_free_result($result);
  } // end display_concert function 

?>