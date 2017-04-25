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





// QQQ Why oh why is post always set??? //



?>

<div class="container-fluid add_tune_container">
	<div class="row center">
		<div class="col-sm-12" >
			
			<form  id="mail-form" class="form-horizontal" role="form" method="post" action="mail_form.php" style="padding: 1em 3em;">
				<fieldset style="min-width: 70%;margin: auto;">

					<legend><h3>Send Us Mail</h3></legend>
					<h4>Your email was successfully sent!</h4>
					<p>Thanks, and have a great day.</p>
				</fieldset>					
			</form>
		</div> <!-- end col-12 -->
	</div><!-- end row -->
</div> <!-- end add_tune_container -->

<?PHP
// }
include "footer.php";
?>