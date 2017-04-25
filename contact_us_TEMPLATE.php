<?PHP
include "header.php";
print "<div id='left_col'>";


if (isset ($_POST['sendMail']))      // This must match the name of the submit button you create below. 
{                                    // This means: "Did the user hit the 'send mail' button' 
	$to="###";                       // replace the ### with YOUR email address, or the address of the person who receives email for your website. 
	$subject=                        // enter $_POST variable here
	$email=                          // enter $_POST variable here. This is the email address of the person filling out the contact us form
	$message=                        // enter $_POST variable here. 
	$headers="From: $email";

	
	if ($_SESSION['6_letters_code'] == $_POST['captcha']) {  // This is how we test whether user entered correct captcha value
		
		// ENTER THE PHP function to call mail using the variables above. This is in the powerpoint presentation for PHP Mail. 
		
		// ENTER a conditional expression to test whether the mail was sent. 
		// Print a message: either mail was successfully sent or it was not. 
	}
	else {
		print "Captcha Incorrect. Please try again";
	}
}
else { 
?>
       <!-- THIS IS WHERE YOU ENTER ALL THE HTML FOR THE EMAIL FORM > 

			MAKE SURE YOU HAVE   --> 
		<form method="post" action="">
		
	    <!-- THEN PUT IN ALL THE <input> and <textarea> elements THAT YOU NEED. 	   
		
		Near the bottom, insert:            --> 

     	Captcha:<img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id="captchaimg" >
	
	    <!-- THEN MAKE SURE YOU HAVE A TEXT BOX FOR ENTERING THE CAPTCHA CODE LIKE THIS: -->
       Enter Captcha Code:<input name="captcha" type="text" >

       <!-- CREATE two SUBMIT BUTTONS. Name one "sendMail" (if you change this name, you must change it on line 6 above. 
	   Name the other submit button "anotherCaptcha" (or something similar)

       Add your close form and close html tags here. 
	   
	   The next PHP block serves to add in the close brace for the 'else' above --> 
</div>
<?PHP
}
include "footer.php";
?>