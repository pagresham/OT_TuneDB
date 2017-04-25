<?PHP
// header("Location: add_tune.php");
include "header.php";
?>

<div class="container-fluid add_tune_container">
	<div class="row">
		<div class="col-sm-12">
			<form  id="add_tune_form" class="form-horizontal" role="form" method="post" action="add_tune.php" style="padding: 3em;">
				<fieldset>
					<legend><h4>You've added a tune to your list</h4></legend>
				</fieldset>
				
				<!-- Tune Name -->
				<div class="form-group">
					<p></p>
					<a class="btn btn-success" href="add_tune.php">Add Another?</a>
				</div>
			</form>
		</div>
	</div>
</div>	




<?PHP
// header("Location: add_tune.php");
include "footer.php";
?>