<?PHP
include "header.php";



$errors = array();

$memberId =$tunename =$tunekey =$parts =$skill =$tunesource =$newsource =$tune_added_message =$sourceDescription =$tuneEntered= "";

set_session_vars();
$memberId = $_SESSION['member_id'];
$valid = false;
// Fields needed to add on add tune page.
// tune name, tune key, parts, skill level, 
// source info - source description(name etc), s_type, add_info
// eventually - recordings for version, and links for version 

// If user clears browser data, they are logged out and redirected.
if(!isLoggedIn()){
	header("Location: index.php");
}


if (isset($_POST['add_tune']) && isset($_SESSION['member_id'])) {
	//print "this post add tune is set and member is logged in";
	//print_r($_POST);
	// process tune info form

	if(!empty($_POST['tune-name'])) {
		$tunename = trim($_POST['tune-name']);
		if(strlen(trim($tunename)) == 0) {
			$errors['tune-name'] = "Name cannot be blank";;
		}
		else if(!preg_match("/^[a-zA-Z0-9.' -]{1,45}$/", $tunename)) {
			$errors['tune-name'] = "Sorry, tune names are 45 characters max, and contain letters and numbers.";
		}
	}
	else { $errors['tune-name'] = "Please enter the tune's name"; 
	}

	if(!empty($_POST['tune-key'])) {
		$tunekey = $_POST['tune-key'];
		if(!preg_match("/^([ABCDEFG])|(Bb)$/", $tunekey)) {
			$errors['tune-key'] = "Please enter a valid key for your tune.";
		}
	}
	else { $errors['tune-key'] = "Please enter a valid tune key."; }

	if(!empty($_POST['tune-parts'])) {
		$parts = $_POST['tune-parts'];
		if(!preg_match("/^([12345])|(Other)$/", $parts)) {
			$errors['tune-parts'] = "Please enter a valid number of parts for your tune.";
		}
	}
	else { $errors['tune-parts'] = "Please enter a valid number of parts. you done screwed up"; }


	if(!empty($_POST['skill'])) {
		$skill = $_POST['skill'];
		if(!preg_match("/^(Interested)|(Learning)|(Mastered)$/", $skill)) {
			$errors['skill'] = "Enter a valid skill level";
		}
	}
	else { $errors['skill'] = "Enter a valid skill level"; }


	// process source selects
	//IF $tunesource = "Other"{} tune-source
	if(!empty($_POST['tune-source'])) {
		$tunesource = $_POST['tune-source'];
		if(preg_match("/^[a-zA-Z0-9 ]{1,45}$/", $tunesource)) {
			if($tunesource == "Other") {
				if(!empty($_POST['new-source'])) {
					$tunesource = trim($_POST['new-source']);
					if (strlen(trim($tunesource)) == 0) {
						$errors['new-source'] = "Enter some dang text!";
					}
					else if(!preg_match("/^([a-zA-Z0-9 .'-]+)|(Other)$/", $tunesource)) {
						$errors['new-source'] = "Enter a valid source";
					}
				}
				else {
					$errors['new-source'] = "Enter a valid source";	
				}
			}
			// ts != other but passes regex
		}
		else { $errors['tune-source'] = "Enter a valid source selection"; }
	}
	else { $errors['tune-source'] = "Enter a valid source selection"; }

	// process source "other" field new-source
	
	// Process source type //
	
	if(!empty($_POST['source-type'])) {
		$sourceType = $_POST['source-type'];
		if(!preg_match("/^[a-zA-Z0-9 .-]{1,20}$/",$sourceType) || (strlen(trim($sourceType)) == 0)) {
			$errors['source-type'] = "Enter a valid source type"; 
		}
	}
	else { $errors['source-type'] = "Enter a valid source type"; }

	if(!empty($_POST['source-desc'])) {
		$sourceDescription = $_POST['source-desc'];
		if(!preg_match("/^[a-zA-Z0-9 '\".,!?]{1,100}$/", $sourceDescription)) {
			$errors['source-desc'] = "Please use only numbers, letters and ['\".,!? ]. Thanks!";
		}
	}
	else { $sourceDescription = "None"; }


	// Process addtional info //
	// $tuneEntered = true;
	// Check for Errors //
	$errorCount = count($errors);
	//print_r($errors);
	if ($errorCount == 0)  {
		$valid = true;
		
		// Clears post array, and input fields with page refresh
		

		// Build source insert query //
		$tunesource = addslashes($tunesource);
		$sourceType = addslashes($sourceType);
		$sourceDescription = addslashes($sourceDescription);

		$source_query = "INSERT INTO SOURCES (DESCRIPTION, SOURCE_TYPE, ADD_INFO) 
							VALUES ('$tunesource', '$sourceType', '$sourceDescription')";

		$source_query_result = mysqli_query($db, $source_query);
		if(!$source_query_result) {
			die("Connection terminated, source: ".mysqli_error($db));
		}
		else {
			// Yes!!! This worked to get the last ID //
			$last_source_id = mysqli_insert_id($db); 

			$tunename = addslashes($tunename);
			$versions_query = "INSERT INTO VERSIONS (SOURCES_ID, TUNE_NAME, TUNE_KEY, PARTS, MEMBER_ID)
								VALUES ($last_source_id, '$tunename', '$tunekey', $parts, $memberId)";

			$version_query_result = mysqli_query($db, $versions_query);

			if(!$versions_query) {
				die("Connection terminated, version: ".mysqli_error($db));
			}
			else {
				$last_version_id = mysqli_insert_id($db);
				print $last_version_id.": is the last version id entered.";
				$lists_query = "INSERT INTO LISTS (VERSION_ID, MEMBER_ID, SKILL_LVL) VALUES ($last_version_id, $memberId, '$skill')";
				print $lists_query;
				// $lists_query = "INSERT INTO LISTS (VERSION_ID, MEMBER_ID, SKILL_LVL) VALUES (100, 100, 'learning')";
				$lists_query_result = mysqli_query($db, $lists_query);

				if(!$lists_query_result) {
					die("Connection terminated lists: ".mysqli_error($db)."<br>".$lists_query);
				}
				else {
					print "you sent to the sources table: ".$last_source_id;
					$tune_added_message = "<div class='successfully'><h5>Great! You've successfully added a tune.<h5><h4>".$tunename."<h4></div>";
			
					header("Location: unset.php");
				}
			}
		}	
	} // End db work / no errors
}
//print_r($_POST);
// print_r($errors);

?>
	



<div class="container-fluid add_tune_container">
	<div class="row">
		<div class="col-sm-12">
			<form  id="add_tune_form" class="form-horizontal" role="form" method="post" action="add_tune.php" style="padding: 3em;">
				<fieldset>
					<legend><h3>Add a Tune to Your List</h3></legend>
				</fieldset>
				
				<!-- Tune Name -->
				<div class="form-group">
	              	<label class="control-label col-sm-2" for="tune-name"><span class=""></span> Tune Name</label>
					<div class="col-sm-10">
	      				<input type="text" class="form-control" name="tune-name" id="tune-name"  value="<?PHP echo (isset($_POST['tune-name']) ? $tunename : "") ?>" maxlength="45" required >
	      				<small class="errorText"><?PHP echo array_key_exists('tune-name', $errors) ? $errors['tune-name'] : '' ?></small>		
	    			</div>					
            	</div>


  				<!--  I could do this with an array and a loop  -->
            	<div class="form-group">
	              	<label class="control-label col-sm-2" for="tune-key"><span class=""></span> Key</label>
					<div class="col-sm-10">
	      				<select class="form-control" name="tune-key" id="tune-key" required="">
	      					<option value="">Choose one</option>
	      					<option value="G" <?PHP print (isset($_POST['tune-key']) && $_POST['tune-key'] == "G") ? "selected": "" ?>>G</option>
	      					<option value="A" <?PHP print (isset($_POST['tune-key']) && $_POST['tune-key'] == "A") ? "selected": "" ?>>A</option>
	      					<option value="B" <?PHP print (isset($_POST['tune-key']) && $_POST['tune-key'] == "B") ? "selected": "" ?>>B</option>
	      					<option value="Bb" <?PHP print (isset($_POST['tune-key']) && $_POST['tune-key'] == "Bb") ? "selected": "" ?>>Bb</option>
	      					<option value="C" <?PHP print (isset($_POST['tune-key']) && $_POST['tune-key'] == "C") ? "selected": "" ?>>C</option>
	      					<option value="D" <?PHP print (isset($_POST['tune-key']) && $_POST['tune-key'] == "D") ? "selected": "" ?>>D</option>
	      					<option value="E" <?PHP print (isset($_POST['tune-key']) && $_POST['tune-key'] == "E") ? "selected": "" ?>>E</option>
	      					<option value="F" <?PHP print (isset($_POST['tune-key']) && $_POST['tune-key'] == "F") ? "selected": "" ?>>F</option>
	      					<option value="Other" <?PHP print (isset($_POST['tune-key']) && $_POST['tune-key'] == "Other") ? "selected": "" ?>>Other</option>
	      				</select>
	      				<small class="errorText"><?PHP echo array_key_exists('tune-key', $errors) ? $errors['tune-key'] : '' ?></small>		
	    			</div>					
            	</div>



            	<div class="form-group">
	              	<label class="control-label col-sm-2" for="tune-parts"><span class=""></span> Parts</label>
					<div class="col-sm-10">
						<select class="form-control" name="tune-parts" id="tune-parts" required>
	      					<option value="">Choose one</option>
	      					<option value="1" <?PHP print (isset($_POST['tune-parts']) && $_POST['tune-parts'] == "1") ? "selected": "" ?>>1</option>
	      					<option value="2" <?PHP print (isset($_POST['tune-parts']) && $_POST['tune-parts'] == "2") ? "selected": "" ?>>2</option>
	      					<option value="3" <?PHP print (isset($_POST['tune-parts']) && $_POST['tune-parts'] == "3") ? "selected": "" ?>>3</option>
	      					<option value="4" <?PHP print (isset($_POST['tune-parts']) && $_POST['tune-parts'] == "4") ? "selected": "" ?>>4</option>
	      					<option value="5" <?PHP print (isset($_POST['tune-parts']) && $_POST['tune-parts'] == "5") ? "selected": "" ?>>5</option>
	      					<option value="Other" <?PHP print (isset($_POST['tune-parts']) && $_POST['tune-parts'] == "Other") ? "selected": "" ?>>Other</option>
	      				</select>
	      				<small class="errorText"><?PHP echo array_key_exists('tune-parts', $errors) ? $errors['tune-parts'] : '' ?></small>		
	    			</div>					
            	</div>

				
				
				<div class="form-group">
	              	<label class="control-label col-sm-2" for="skill"><span class=""></span> Skill Level</label>
					<div class="col-sm-10">
						<label class="radio-inline"><input type="radio" name="skill" value="Interested" required
						<?PHP print (isset($_POST['skill']) && $_POST['skill'] == "Interested") ? "checked": "" ?>
						>Interested</label>
						<label class="radio-inline"><input type="radio" name="skill" value="Learning" <?PHP print (isset($_POST['skill']) && $_POST['skill'] == "Learning") ? "checked": "" ?>>Learning</label>
						<label class="radio-inline"><input type="radio" name="skill" value="Mastered" <?PHP print (isset($_POST['skill']) && $_POST['skill'] == "Mastered") ? "checked": "" ?>> Mastered</label>
	      				<small class="errorText"><?PHP echo array_key_exists('skill', $errors) ? $errors['skill'] : '' ?></small>		
	    			</div>					
            	</div>


            	<div class="form-group">
	              	<label class="control-label col-sm-2" for="tune-source"><span class=""></span> Source</label>
					<div class="col-sm-10">
						<select class="form-control" name="tune-source" id="tune-source" required>
	      					<option value="">Choose one</option>
	      					<option value="Other" <?PHP print (isset($_POST['tune-source']) && $_POST['tune-source'] == "Other") ? "selected" : "" ?>>Other</option>
	      					<?PHP

  						// $query_source_sort = "SELECT DISTINCT s.description, s.sources_id from sources s
  						// join versions v 
  						// on s.sources_id = v.sources_id";
  						$query_source_sort = "SELECT DISTINCT description from sources";
  						$source_sort_result = mysqli_query($db, $query_source_sort);
  						if(!$source_sort_result) {
  							print "<option>terminated</option>";
  							 die("DB connection terminated: ".mysqli_error());
  						}
  						else if (mysqli_num_rows($source_sort_result) > 0) {
  							while ($row = mysqli_fetch_assoc($source_sort_result)) {


  							
  								print "<option value='".$row['description']."'";
  								if(isset($_POST['tune-source']) && $_POST['tune-source'] == $row['description']) {
  									print "selected";
  								}
  								print ">".$row['description']."</option>";
  							}
  						}
  						?>
	      				</select>
	      				<small class="errorText"><?PHP echo array_key_exists('tune-parts', $errors) ? $errors['tune-parts'] : '' ?></small>		
	    			</div>				
            	</div>

            	<div class="">
            		<label class="col-sm-2"></label>
            		<p class="col-sm-10">If you don't see your <strong>source</strong>, select other in the above field and enter a new one below.</p>	
            	</div>
            	
            	<div class="form-group">
	              	<label class="control-label col-sm-2" for="new-source"><span class=""></span> New Source</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="new-source" id="new-source" value="<?PHP echo (isset($_POST['new-source']) ? $newsource : "") ?>" maxlength="45">
	      					
	      				<small class="errorText"><?PHP echo array_key_exists('new-source', $errors) ? $errors['new-source'] : '' ?></small>		
	    			</div>		
            	</div>
            	<div class="form-group">
	              	<label class="control-label col-sm-2" for="source-type"><span class=""></span> Source Type</label>
					<div class="col-sm-10">
						<select class="form-control" name="source-type" id="source-type" required>
	      					<!-- add options here -->
	      					<option value="">Choose one</option>
	      					<option value="Audio-recording"  
							<?PHP print (isset($_POST['source-type']) && $_POST['source-type'] == "Audio-recording") ? "selected": "" ?>
	      					>Audio Recording</option>
	      					<option value="Video-recording" <?PHP print (isset($_POST['source-type']) && $_POST['source-type'] == "Video-recording") ? "selected": "" ?>>Video Recording</option>
							<option value="Book" <?PHP print (isset($_POST['source-type']) && $_POST['source-type'] == "Book") ? "selected": "" ?>>Book</option>
							<option value="Personal" <?PHP print (isset($_POST['source-type']) && $_POST['source-type'] == "Personal") ? "selected": "" ?>>Personal</option>	
							<option value="Other" <?PHP print (isset($_POST['source-type']) && $_POST['source-type'] == "Other") ? "selected": "" ?>>Other</option>
	      				</select>
	      				<small class="errorText"><?PHP echo array_key_exists('source-type', $errors) ? $errors['source-type'] : '' ?></small>		
	    			</div>		
            	</div>
            	<div class="form-group">
	              	<label class="control-label col-sm-2" for="source-desc"><span class=""></span> Source Description</label>
					<div class="col-sm-10">
						
						<textarea class="source-text form-control" id="source-desc" name="source-desc" rows='2' maxlength="100"><?PHP echo (isset($_POST['source-desc']) ? $_POST['source-desc'] : "") ?></textarea>
	      				<small class="errorText"><?PHP echo array_key_exists('source-desc', $errors) ? $errors['source-desc'] : '' ?></small>		
	    			</div>		
            	</div>
            	<div class="form-group">
            		<label class="control-label col-sm-2"><span></span></label>
            		<div class="col-sm-10" style="text-align: center">
            			<input class="btn btn-success col-sm-2" type="submit" name="add_tune" value="Add Tune">	
            		</div>            		
            	</div>   
            	<div class="form-group ">
	              	<label class="control-label col-sm-2" for="source-desc"></label>
					<div class="col-sm-10 ">
						
							<?PHP print (!empty($tune_added_message)) ? $tune_added_message : "";?>	
						
	    			</div>		
            	</div> 	
        		
			</form> 
		</div> <!-- end col-12 -->
	</div><!-- end row -->
</div> <!-- end add_tune_container -->



<?PHP
include "footer.php";
?>