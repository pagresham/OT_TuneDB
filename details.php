<?PHP
include "header.php";
$sortQuery = $sort_result = $tune_details = $details_result = $versionId =$newLvl =$link = $linkDesc ="";
$errors = array();
// when update skill is selected, pass vId up in post array, for select function. 
if (isset($_POST['skill'])) {
	if(!empty($_POST['skill_level'])){
		$newLvl = $_POST['skill_level'];
	}
	$versionId = $_POST['version_Id'];
	$update_skill_query = "UPDATE LISTS
							SET SKILL_LVL = '$newLvl'
							WHERE VERSION_ID = '$versionId'
							AND MEMBER_ID = '$memberId'";
	$update_skill_result = mysqli_query($db, $update_skill_query);
	if(!$update_skill_result) {
		die("Connection Terminated at Skill Update: ".mysqli_error($db));
	}
	// else {
	// 	print "updated table";
	// 	print $update_skill_query;
	// }
}

// Process when add_link submit is pressed. 
if(isset($_POST['add_link'])) {
	$versionId = $_POST['version_Id'];

		if(!empty($_POST['link_name']) && strlen(trim($_POST['link_name'])) !== 0) {
			$link = $_POST['link_name'];
			if (!preg_match("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/",$link)) {
				if(strpos($link, 'www.youtube.com')) {
					// print $link;
					$insert_link_query = "";
					if(!empty($_POST['link_desc']) && strlen(trim($_POST['link_desc'])) !== 0) {
						$linkDesc = $_POST['link_desc'];
						if(!preg_match("/^[a-zA-Z0-9.,?!@#$%&\'\"-]{1,100}/", $linkDesc)) {
							$errors['add_link'] = "Please leave a description of your link.";
						}
					}
					else { $errors['add_link'] = "Please leave a description of your link."; }
				}
				else { $errors['add_link'] = "Please enter a YouTube link."; }
			}	
			else { $errors['add_link'] = "Please enter a YouTube link."; }
		}
		else { $errors['add_link'] = "Please enter a You Tube link"; }
	
	if(count($errors) == 0) {
		unset($_POST['link_desc']);
		unset($_POST['link_name']);
		// print "no errors";
		
		$link = addslashes($link);
		$linkDesc = addslashes($linkDesc);

		$add_link_query = "INSERT INTO LINKS
						(URL, DESCRIPTION, VERSION_ID)
						VALUES('$link','$linkDesc', '$versionId')";

		$add_link_result = mysqli_query($db, $add_link_query);
		if(!$add_link_result) {
			die("Connecttion Terminated: ".mysqli_error($db));
		}
	}
}

// Go through Get array, and get the passed value out //
foreach ($_GET as $key => $value) {
	if ($key == 'versionId_') {
		$versionId = $_GET['versionId_'];
	}
}

// build query to get the one tune selected.
$detailQuery = "SELECT DISTINCT V.TUNE_NAME AS 'Name', V.TUNE_KEY AS 'Key', V.PARTS AS 'Parts', S.description AS 'Source', L.SKILL_LVL AS 'Skill'
								FROM SOURCES S 
								JOIN VERSIONS V
								ON V.SOURCES_ID = S.SOURCES_ID
								JOIN LISTS L
								ON L.VERSION_ID = V.VERSION_ID
								WHERE L.MEMBER_ID = '$memberId'
								AND L.VERSION_ID = '$versionId'";
// Run select statement when page loads
$details_result = mysqli_query($db, $detailQuery);

if(!$details_result) {
	die("Connection Terminated: ".mysqli_error($db));
} 
else {
// display the following html if results are true
?>

<div class="explorer_results container">
	<div class='row'>
		<div class="col-sm-12 detail-headers">
			<h4>Tune Details</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
		<?PHP
		display_results($details_result, $db)
		?>
		</div>	
	</div>
	<div class="row">
		<div class="col-sm-12 detail-headers">
			<h3>Actions</h3>
		</div>
	</div>
	<div class="row center">
		
		<!-- Submit link -->
		<div class="col-sm-4">
			<button  id="open-link" class="form-control btn btn-success">Links</button>
			<form method="post" action="details.php" id="update-link">
				<input type="hidden" name="version_Id" value="<?PHP echo $versionId ?>">
				
				<div id="links_hidden_div">

					<div class="center update-drops">
						<h4 for="link_name">Add a Video Link</h4>
					</div>
					
					<input type="url" class="form-control update-drops" name="link_name" id="link_name" placeholder="YouTube link here" value="<?PHP echo (isset($_POST['link_name']) ? $_POST['link_name'] : "") ?>">
					
					<textarea class="update-drops form-control" name="link_desc" id="link_desc" placeholder="Link Description Here"><?PHP echo (isset($_POST['link_desc']) ? $_POST['link_desc'] : "") ?></textarea>
					<button type="submit" name="add_link" id="link" value="add_link" class="form-control btn btn-success">Add a link<label for="add_link" style="display: none;"></label></button>
				</div>
				
				<small><?PHP echo (isset($errors['add_link'])) ? $errors['add_link'] : "" ?></small>
			</form>
		</div>
		<!-- Update skill -->
		<div class="col-sm-4">
			<button  id="open-skill" class="form-control btn btn-success">Skill Level</button>
			<form method="post" action="details.php" class="form-horizontal" id="update-skill">
			
				<div id="skill_hidden_div">	
					<div class="center update-drops">
						<h4 class="">Set New Skill Level</h4>
					</div>
					<select class="form-control update-drops" name="skill_level">
						<option value="Interested">Interested</option>
						<option value="Learning">Learning</option>
						<option value="Mastered">Maseterd</option>
					</select>
					<input type="hidden" name="version_Id" value="<?PHP echo $versionId ?>">
					<button type="submit" name="skill" id="skill" value="update_skill" class="form-control btn btn-success">Update Skill</button>
				</div>
			</form>
		</div>
		<!-- Delete Tune -->
		<div class="col-sm-4">
			<button  id="open-delete" class="form-control btn btn-warning">Delete Tune From List</button>
			<form method="post" action="delete_tune.php">


				<div class="" id="delete_hidden_div">
					<div class="center update-drops">
						<h4 class="">Are you sure?</h4>
					</div>
					<button type="submit" name="delete_tune" value="<?PHP echo $versionId ?>" class="form-control btn btn-danger" id="delete">Delete Tune!</button>	
				</div>

			</form>
		</div>
	</div>
	
	
</div>

<!-- #body ends next line -->
<?PHP
}
//print "<p>".$row['TUNE_NAME']."</p>";
include "footer.php";
?>