<?PHP
include "header.php";

$versionId ="";

if(isset($_POST['delete_tune'])) {
	$versionId = $_POST['delete_tune'];
	
	$delete_list_query = "DELETE FROM LISTS
						WHERE VERSION_ID = '$versionId'";

	$delete_version_query = "DELETE FROM VERSIONS
							WHERE VERSION_ID = '$versionId'";

	$delete_list_result = mysqli_query($db, $delete_list_query);
	if(!$delete_list_result) {
		die("Connection Terminated: on delete: ".mysqli_error($db));
	}
	else {
		$delete_version_result = mysqli_query($db, $delete_version_query);
		if(!$delete_version_result) {
			die("Connection Terminated: on delete: ".mysqli_error($db));
		}
	}

	

	?>
	
	<div class="row">
		<div class="col-sm-12 center">
			<h4>Your tune has been deleted</h4>
		</div>
	</div>

	<?PHP

	header("Location: myTunes.php");

}





include "footer.php";
?>