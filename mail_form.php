<?PHP
include "header.php";

$to =$subject =$message =$headers =$email ="";
$mail_success_msg =$error_msg ="";
$errors = array();

set_session_vars();



/**
 * In a nutshell 
 *
 * 1. Set up Vars
 * 2. define function to validate an email using sanitize and filter
 * 3. start_session()
 * 4. Check if $_POST is set
 * 5. If yes, validate email and process data
 * 6. Check if the session var generated by the captcha function matches what the user entered for the capthca text
 * 7. If ok, send mail
 * 8. Check if mail() is true
 * 9. IF no, print error
 * 10. If $_POST not set, display form
 */





/**
 * Function to first sanitize an email string of bad chars
 * And then validate the email is good 
 * @param string $field - the email string to be checked
 * @return boolean 
 */
function spamcheck($field) {
	$field = filter_var($field, FILTER_SANITIZE_EMAIL);
	if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	else {
		return false;
	}
}

//Had to add world read and execute permissions to the folder where the session vars are written 
//to to get this to not yell at me.
// Folder Session writes to @ /var/folders/8t/h4cnl6r531159dnkvcf5yy1w0000gq/T

print "<div>";
// if (isset ($_SESSION['6_letters_code'])) {
// 	print "6letter code is set";
// }
// else {
// 	print "letter code is not set";
// }


// Remember the deal with POST, it is not erased on referesh, or even brower refres, you have to visit a DIFFERENT PAGE //




// QQQ Why oh why is post always set??? //



if (isset ($_POST['send_mail']))    
{       

	// Error checking function to validate content of email field.                             
	if(!spamcheck($_POST['email'])) {
		echo "invalid input";
	}
	else {
		// Begin processing email
		$to="piercegresham@yahoo.com";                       

		if(!empty($_POST['subject'])){
			$subject= $_POST['subject']; 
		}		             
		// Subject is optional
		
		$email= $_POST['email']; 
		// $email was already validated
		$headers="From: $email";
		// Had to attach the email field here, so it would come through in my test emails
		$message= $_POST['message'];          
		// Add this to above line - $headers ."\r\n".
		// Check if what user entered matches the captcha code
		

		// QQQ Had to do this to get sessions not to complain, but its really because 
		// post is persisting between browser loads, and broser refreshes
		if (isset($_SESSION['6_letters_code']) && $_SESSION['6_letters_code'] == $_POST['captcha']) {  
			// print "Captcha Correct";
			// call mail using the variables above.  
			$sent = mail($to, $subject, $message, $headers);
			// Check if email sent is true
			if($sent) {
				//print "Your email was successfully sent.";
				$mail_success_msg = "Your email was successfully sent.";
				// clears form
				unset($_POST);
				header("Location: mail_form_success.php");

				// print_r($_POST);
			}
			// Conditional expression to test whether the mail was sent. 
			else {
				$error_msg = "We were unable to send your email at this time.";
			}

			//Not sure where my mail logs are going. 

			//I set mail.log in php.ini, but nothing shows up there. 
			// Earlier, some mail logs were going to /var/mail/piercegresham
			// But now I know that this is the default mailbox for me on this mac
		}
		else {
			$errors[] = "Incorrect Captcha, please try again.";
			//print reset($errors);
			$error_msg = "Incorrect Captcha, please try again.";
			
		}
		
	}
	// Finish processing email
}
// Else submit email is not pressed...
// else { 
?>

<div class="container-fluid add_tune_container">
	<div class="row center">
		<div class="col-sm-12" >
			<?PHP
				echo (!empty($mail_success_msg)) ? "<p id='hid-msg1'>".$mail_success_msg."</p>" : "";
				echo (!empty($error_msg)) ? "<p id='hid-msg2'>".$error_msg."</p>" : "";
			?>
			<form  id="mail-form" class="form-horizontal" role="form" method="post" action="mail_form.php" style="padding: 1em 3em;">
				<fieldset style="min-width: 70%;margin: auto;">

					<legend><h3>Send Us Mail</h3></legend>
					<!--  Could incorporate pick lists for some of these vars... To reduce spam -->
					<p class="legend-like">Questions, Comments, or just want to say HI? Fill out the form below to get in touch.</p>

					<div class="form-group">
						<label class="control-label col-sm-2" for="first_name">First Name:</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="first_name" maxlength="45" id="first_name" value="<?php echo (!empty($_POST['first_name'])) ? $_POST['first_name'] : "";?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2" for="last_name">Last Name:</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="last_name" id="last_name" maxlength="45" value="<?php echo (!empty($_POST['last_name'])) ? $_POST['last_name'] : "";?>">	
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Email Address:</label>
						<div class="col-sm-8">
							<input class="form-control" type="email" name="email" maxlength="45" id="email" required value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : "";?>">	
						</div>

					</div>

					<div class="form-group">
						<label class="control-label col-sm-2" for="subject">Subject</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="subject" id="subject" maxlength="100" value="<?php echo (!empty($_POST['subject'])) ? $_POST['subject'] : "";?>" required>	
						</div>
					</div>
					
					<div class="form-group">		
						
						<label class="control-label col-sm-2" for="message">Message:</label>
						<!-- Put the size of the text area in css and make responsive with no overflow -->
						<div class="col-sm-8">
							<textarea class="form-control" name="message" id="message" rows="3" cols="40"><?php echo(isset($_POST['message']))?$_POST['message']:"";?></textarea>	
						</div>
					</div>

					<div class="form-group">
						<label class="control-label" for="captcha">Captcha:</label>
						<img src="captcha.php?rand=<?php echo rand(); ?>" id="captcha" >	
					</div>
					<div class="form-group">
						<label for="captcha-answer" class="control-label ">Enter Captcha Code:</label>
						<input class="" name="captcha" type="text" id="captcha-answer">
					</div>
						
					<div class="form-group">
						<!-- Captcha fields reference captcha_code_file.php -->
						
						<input type="submit" name="send_mail" value="Send Mail" id="sendMail" ="" class="btn btn-success another">
						
						<input type="submit" name="another_captcha" value="Another Captcha" id="another_captcha" class="btn btn-info another">

					</div>

				</fieldset>					
			</form>
		</div> <!-- end col-12 -->
	</div><!-- end row -->
</div> <!-- end add_tune_container -->

<?PHP
// }
include "footer.php";
?>