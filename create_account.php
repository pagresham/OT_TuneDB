<?PHP
// users
// phoebebird
// PhoebeGresham1!
// Ceasar187
// Ceasar187!
// piercegresham
// 1Banjoh0!
include "header.php";

// Already have username from header.php
$fname =$lname =$email =$password1 =$slashed_password1 =$hashed_password1 =$password2 =$zipcode =$errorCount = "";
$errors = array();

// Clear post array if reset is pressed
if(isset($_POST['reg_reset'])) {
	unset($_POST);
}

if (isset($_POST['register'])) {
	// Validate username
	if (!empty($_POST['username'])) {
		$username = trim($_POST['username']);
		if(strlen(trim($username)) === 0) {
			$errors['username'] = "Invalid Username1";
		}
		else {
			if(!preg_match("/^[a-zA-Z0-9'-.@_]{8,}$/", $username)) {
				$errors['username'] = "Invalid username2";
			}
			else if (strlen($username) > 45) {
				$error['username'] = "Invalid Username3";
			}
		}
	}
	else {
		$error['username'] = "Please enter a username";
	}
	// Validate First Name 
	if(!empty($_POST['fname'])) {
		$fname = trim($_POST['fname']);
		if(strlen(trim($fname)) === 0 || (strlen($fname) > 45)) {
			$errors['fname'] = "Please enter your first name";
		}
		else if (!preg_match("/^[a-zA-Z0-9]/", $fname)) {
			$errors['fname'] = "Names can only include standard letters and number.";
		}
	}
	else {
		//$errors['fname'] = "Please enter your first name";
	}
	// Validate last name
	if (!empty($_POST['lname'])) {
		$lname = trim($_POST['lname']);
		if (strlen(trim($lname)) === 0) {
			$errors['lname'] = "No empty strings please";
		}
		else if (strlen($lname) > 45) {
			$errors['lname'] = "Password is too long";
		}
		else if (!preg_match("/^[a-zA-Z0-9]/", $lname)) {
			$errors['lname'] = "Names can only include standard letters and number.";
		}
	}
	else {
		$errors['lname'] = "Please enter your last name";
	}
	// VAlidate zipcode 
	if(!empty($_POST['zipcode'])) {
		$zipcode = $_POST['zipcode'];
		if(strlen(trim($_POST['zipcode'])) === 0 || strlen($zipcode) > 10) {
			$errors['zipcode'] = "Please enter a 6 or 10 digit zipcode";
		}
		// matches 
		else if(!preg_match("/^\d{5}-?(\d{4})?$/", $zipcode)) {
			$errors['zipcode'] = "Use ##### or #####-####";
		}
		else {
			$zipcode = str_replace("-", "", $zipcode);
			//print $zipcode;
		}
	}
	else
		$errors['zipcode'] = "Please enter a 6 or 10 digit zipcode"; 

	// Validate email
	if(!empty($_POST['email'])) {
    	$email = $_POST['email'];
    		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      			$errors['email'] = "Please enter a valid Email address";
    		}
    		else $email = addslashes($email);
  		}
  		else {
    		$errors['email'] = "Please enter a valid Email address";
  		}

  		 

  	// Validate 1st PW
  	if (!empty($_POST['password1'])) {
    	$password1 = $_POST['password1'];
    	if (strlen(trim($password1)) === 0) {
      		$errors['password1'] = "Please enter a valid password";
    	}
    	else  if (!preg_match ("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $password1))  {
      		//print $password1;
      		$errors['password1'] = "Password must contain at least 8 characters and include 1 lower case, 1 upper case, 1 number, and 1 special character";
    	}
  	}
  	else {
      $errors['password1'] = "Password is a required field";
  	}
  	// Password 2
  	if (isset($_POST['password2'])) {
    	$password2 = $_POST['password2'];
    	if($password1 != $password2) {
      		$errors['password2'] = "Passwords do not match";
    	}
  	}
  	else {
    	$errors['password2'] = "Plese re-enter you password";
  	}
  	// Check errors
  	$errorCount = count($errors);
  		if ($errorCount > 0) {
   	 	//print "<small class='errorText'>There are errors. Please make corrections and try again</small>";
    		$validImputs = false;
 		}
 		else {
 			// No Errors //  
 			// Start with checking if user name exists already //
 			$check_uname_query = "SELECT USERNAME
 									FROM MEMBERS
 									WHERE USERNAME = '$username'";

 			$result = mysqli_query($db, $check_uname_query);
 			if(!$result) {
      			// results is an object that is the return val from the db call.
      			die("Terminated DB connection:  ".mysqli_error());
    		}
    		else { // $result is true
      			$numRows = mysqli_num_rows($result);
      			if ($numRows > 0) {
        		// the username is already in use
        		$errors['username'] = "Username already taken.";
      			}
      			else {
      				
    				$hashedPassword1 = password_hash($password1, 1);
    				//print $hashedPassword1;
        			// passwords matched, input passed validation, and username is free
        			$query = "INSERT INTO MEMBERS
                    	(USERNAME, F_NAME, L_NAME, EMAIL, PASSWORD, ZIP_CODE)
                    	VALUES ('$username', '$fname', '$lname', '$email', '$hashedPassword1', '$zipcode')";

        			$result = mysqli_query($db, $query);

        			if (!$result) {
          				echo "INSERT error:" . mysqli_error($db);
          				die("Connection Terminated:  ". mysql_error());
        			}
        			else {
          			// User gets link to go to login page.
          				$loginMessage = "<p class='successText'><a href='login.php'><button type='button' class='btn btn-success'>Login</button></a>
             				Thank you for registering!</p>";

          				// echo "<p>Thank you for registering. Please <a href=\"login.php?username=$username\">login.</a></p>";  
            			unset($_POST);
            			header("Location: index.php");

       		 		}
     			}
   			}
 		} // End $has no errors
	} // End of ifPost Submit is set

?>



<div class="container-fluid create_account_container">
	<div class="row">
		<div class="col-sm-12">
			<form  id="create_account_form" class="form-horizontal" role="form" method="post" action="create_account.php" style="padding: 3em;">
			<fieldset>
				<legend><h3>Create a New Member</h3></legend>

				<div class="form-group">
	              <label class="control-label col-sm-2" for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
					<div class="col-sm-10">
	      				<input type="text" class="form-control" name="username" id="usrname"  value="<?PHP echo (isset($_POST['username']) ? $_POST['username'] : "") ?>" maxlength="45" required >
	      				<small class="errorText"><?PHP echo array_key_exists('username', $errors) ? $errors['username'] : '' ?></small>		
	    			</div>					
            	</div>


            	<div class="form-group">
	              <label class="control-label col-sm-2" for="fname"><span class="glyphicon glyphicon-user"></span> First Name</label>
					<div class="col-sm-10">
	      				<input type="text" class="form-control" name="fname" id="fname"  value="<?PHP echo (isset($_POST['fname']) ? $_POST['fname'] : "") ?>" maxlength="45" required >
	      				<small class="errorText"><?PHP echo array_key_exists('fname', $errors) ? $errors['fname'] : '' ?></small>		
	    			</div>					
            	</div>

				<div class="form-group">
	              <label class="control-label col-sm-2" for="lname"><span class="glyphicon glyphicon-user"></span> Last Name</label>
					<div class="col-sm-10">
	      				<input type="text" class="form-control" name="lname" id="lname" value="<?PHP echo (isset($_POST['lname']) ? $_POST['lname'] : "") ?>" maxlength="45" required >
	      				<small class="errorText"><?PHP echo array_key_exists('lname', $errors) ? $errors['lname'] : '' ?></small>		
	    			</div>					
            	</div>

            	<div class="form-group">
	              <label class="control-label col-sm-2" for="zipcode"><span class="glyphicon glyphicon-envelope"></span> Zip Code</label>
					<div class="col-sm-10">
	      				<input type="text" class="form-control" name="zipcode" id="zipcode"  value="<?PHP echo (isset($_POST['zipcode']) ? $_POST['zipcode'] : "") ?>" maxlength="11">
	      				<small class="errorText"><?PHP echo array_key_exists('zipcode', $errors) ? $errors['zipcode'] : '' ?></small>		
	    			</div>					
            	</div>
            
	            <div class="form-group">
	              	<label class="control-label col-sm-2" for="email"><span class="glyphicon glyphicon-send"></span> Email</label>	              
					<div class="col-sm-10">
	      				<input type="email" class="form-control" name="email" id="email"  value="<?PHP echo (isset($_POST['email']) ? $_POST['email'] : '') ?>" maxlength="60" required>
	      				<small class="errorText"><?PHP echo array_key_exists('email', $errors) ? $errors['email'] : '' ?></small>
	    			</div>
	            </div>
	            
	            <div class="form-group">
	                <label class="control-label col-sm-2" for="psw1"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
					<div class="col-sm-10">
	      				<input type="password" class="form-control" name="password1" id="psw1"  maxlength="45" required>
	      				<small class="errorText"><?PHP echo array_key_exists('password1', $errors) ? $errors['password1'] : '' ?></small>
	    			</div>
	            </div>
	            
	            <div class="form-group">
	              <label class="control-label col-sm-2" for="psw2"><span class="glyphicon glyphicon-eye-open"></span> Repeat Password</label>
					<div class="col-sm-10">
	      				<input type="password" class="form-control" name="password2" id="psw2" required>
	      				<small class="errorText"><?PHP echo array_key_exists('password2', $errors) ? $errors['password2'] : '' ?></small>
	    			</div> 
	            </div>
	            	
				<!-- <div class="form-group">
					<label class="control-label col-sm-2"></label>
					<div class="checkbox col-sm-10">
	              		<label><input type="checkbox" value="" checked>Remember me</label>
	            	</div>
				</div> -->

				<div class="form-group">
					<label class="control-label col-sm-2" for="create_account"></label>
					<div class="col-sm-10">
						<button type="submit" name="register" class="btn btn-success" id="create_account"><span class="glyphicon glyphicon-off"></span> Create Account</button>	
						<button type='submit' name="reg_reset" class=" pull-right btn btn-success" id="reg_reset" formnovalidate><span>Reset</span></button>
						<p><?PHP echo (!empty($loginMessage)) ? $loginMessage : '' ?></p>
					</div>
					
				</div>
	            <p class="errorText">
	                 <!-- <?PHP echo $connect_message ?> -->
	            </p>		
			</fieldset>
        </form>
		</div>
	</div>
</div>


<?PHP
include "footer.php";
?>