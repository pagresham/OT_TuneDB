<?PHP
include "header.php";
// print_r($_SESSION);

$password = $successMessage = $logOutMessage = "";
$errors = array();
$validation = false;

// Processing for logout button
if(isset($_POST['logOut'])){
	logOut();
}
// process reset button
if(isset($_POST['reset'])){
	unset($_POST);
	header("Location: login.php");
}

// Processing for login button
if(isset($_POST['login'])) {
	
	// Start username processing
	if(!empty($_POST['username'])) {
		$username = addslashes(trim($_POST['username']));

		if(!strlen(trim($username)) == 0) {
			
			
			print "uname and post_uname:</br>".$username ." and ". $_POST['username']."</br>";
			
			if(!preg_match("/^[a-zA-Z-.@_]{8,}$/", $username) || (strlen($username) > 45)) {
				$errors['username'] = "Invalid username";
			}
		}
		else{
			$errors['username'] = "Username cannot be blank";
			print 'strlen is 0';
		} 
	}
	else {
		$errors['username'] = "Username is a required field";
	}
	// End username processing


	// Start password processing
	if(!empty($_POST['password'])) {
		$password = $_POST['password'];

		if(!strlen(trim($password)) === 0 || (strlen($password) > 45)) {
			$errors['password'] = "Please enter a valid password";
		}
	}
	else {
		$errors['password'] = "Please enter a valid password";
	}
	// end password processing
	
	// Check for errors
	$errorCount = count($errors);
	if ($errorCount == 0){
		
		// print "no errors : going to the db to check the un.";
		
		$login_query = "SELECT MEMBER_ID, USERNAME, PASSWORD, F_NAME
					FROM MEMBERS
					WHERE USERNAME = '$username'";

		$login_result = mysqli_query($db, $login_query);
		
		if (!$login_result) {
			die("Problem with the SELECT statement:  ".mysqli_connect_error());
			$errors['login_SELECT'] = "Problem with the SELECT statement";
		}
		else {
			// login_result is true
			$login_row = mysqli_fetch_assoc($login_result);
			
			if($login_row) {
				print_r($login_row);
				// login row is true
				// found entered username
				print 'found username';
				print $login_row['PASSWORD'];
				//print $password;
				if(password_verify($password, $login_row['PASSWORD'])) {
					// Passwords match
					$_SESSION['user_name'] = $username;

					$memberId = $login_row['MEMBER_ID'];
					
					$_SESSION['member_id'] = $login_row['MEMBER_ID'];
					$_SESSION['f_name'] = $login_row['F_NAME'];
					//print $memberId;
					//print $_SESSION['member_id'];
					$successMessage = "You have successfully logged in";
					unset($_POST);
					header("Location: index.php");
					//header('Location: login.php');
				}
				else {
					// Password doesnt match
					$errors['login'] = "Invalid Password - doesnt match";
					print $password;
				}
			}
			else {
				$errors['login'] = "Unable to find a member with that Username";
			}
		} // End login_row is true
	}
	else {
		print "too many errors";
	} // End 

} // End is $_POST set

if (isLoggedIn()) {
	$username = $_SESSION['user_name'];
	$memberId = $_SESSION['member_id'];
}


?>


<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<form class="form-horizontal" role="form" method="post" action="login.php" style="padding: 1em;">
			<fieldset>
				<legend><h3>Sign in to manage your tune list</h3></legend>

				<div class="form-group">
	              <label class="control-label col-sm-2" for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
					<div class="col-sm-10">
	      				<input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="<?PHP echo (isset($_POST['username']) ? trim($_POST['username']) : "") ?>" maxlength="45" required >
	      				<small class="errorText"><?PHP echo array_key_exists('username', $errors) ? $errors['username'] : '' ?></small>	
	      				<small class="errorText"><?PHP echo array_key_exists('login', $errors) ? $errors['login'] : '' ?></small>		
	    			</div>					
            	</div>
	            
	            <div class="form-group">
	                <label class="control-label col-sm-2" for="psw1"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
					<div class="col-sm-10">
	      				<input type="password" class="form-control" name="password" id="psw1" placeholder="Enter password" maxlength="45" required>
	      				<small class="errorText"><?PHP echo array_key_exists('password', $errors) ? $errors['login'] : '' ?></small>
	      				<small class="errorText"><?PHP echo array_key_exists('login_SELECT', $errors) ? $errors['login_SELECT'] : '' ?></small>
	    			</div>
	            </div>
	            	
				<div class="form-group">
					<label class="control-label col-sm-2" for="login"></label>
					<div class="col-sm-10">
						<button type="submit" name="login" class="btn btn-success" id="login"><span class="glyphicon glyphicon-off"></span> Login</button>	

						<p><?PHP echo (!empty($successMessage)) ? $successMessage : '' ?></p>
						<p><?PHP echo (!empty($logOutMessage)) ? $logOutMessage : '' ?></p>
						<?PHP
						if(!empty($logOutMessage)) {
							print "<button type='submit' name='logOut' class='btn btn-success' id='login' formnovalidate><span class='glyphicon glyphicon-off'></span> LogOut</button>	";
						}
						if (isLoggedIn()) {
						?>
							<button type="button" onclick="window.location ='create_account.php'" class="btn btn-success" id="createAccount">Create Account</button>
							<p>Congrats, you successfully logged in.</p>

						<?PHP
						}
						?>
						<button type="submit" name="reset" class="btn btn-warning" formnovalidate="">Reset</button>
						<!-- <a href="change_pw.php" class="btn btn-danger">Change Sages PW</a> -->
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