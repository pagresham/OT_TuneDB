<?PHP
include "header.php";
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="welcome">
				
				<h3 class="legend-like">Welcome to the Our Tunes DataBase</h3>	
				<div class="welcome-info">
					<p>Inside this site you'll find a collection of tunes. Browse all tunes, or log in and create your own list of tunes. Search tunes by name, source, or other features  When you are curious, explore other members tunes to perhaps get inspired to learn something new.  Most of all...   Enjoy!</p>
				</div>
			</div>
		</div>
		<div class="row center welcome-choices">
			<div class="welcome-choice-out col-sm-4">
				<div class="welcome-choice-in">
					<div class="welcome-padding">
						<h4>Exlpore all the tunes</h4>
						<p>Browse other members' tunes. Sort and search to see what others are playing.</p>
					</div>
					<a href="<?PHP echo (isLoggedIn()) ? "explore_more.php" : "explore.php"  ?>" class="btn btn-success">Explore</a>
				</div>
			</div>
			<div class="welcome-choice-out col-sm-4">
				<div class="welcome-choice-in">
					
					<div class="welcome-padding">
						<h4>Manage your list</h4>
						<p>Log in to browse and add content to your own list of tunes. </p>
					</div>
					<a href="login.php" class="btn btn-success">Log In</a>
				</div>
			</div>
			<div class="welcome-choice-out col-sm-4">
				<div class="welcome-choice-in">
					<div class="welcome-padding">
						<h4>Create a User</h4>
						<p>Create a new user to get enjoy all of the features of the OT_DataBase.</p>
					</div>
					<a href="create_account.php" class="btn btn-success">Create</a>
				</div>
			</div>
		</div>
		<div class="row center welcome-choices">
			<div class="welcome-choice-out col-sm-4">
				<div class="welcome-choice-in">
					<div class="welcome-padding">
						<h4>Exlpore Video Links</h4>
						<p>Browse the YouTube links submitted my our users. Some rare and priceless clips can be found inside.</p>
					</div>
					<a href="tune_links.php" class="btn btn-success">Check It Out</a>
				</div>
			</div>
			<div class="welcome-choice-out col-sm-4">
				<div class="welcome-choice-in">
					
					<div class="welcome-padding">
						<h4>Map the OT_DB</h4>
						<p>Members can view each others locations on an embedded map. See where your friends are!</p>
					</div>
					<a href="<?PHP print (isLoggedIn()) ? 'map.php' : 'login.php'  ?>" class="btn btn-success">Map It</a>
				</div>
			</div>
			<div class="welcome-choice-out col-sm-4">
				<div class="welcome-choice-in">
					<div class="welcome-padding">
						<h4>View Model</h4>
						<p>Click here to see a model view of the Database used in the OT_DB as created by Mysql Workbench</p>
					</div>
					<a class="btn btn-success" data-toggle="modal" data-target="#dbModal">View Model</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Model View Modal -->
	<div id="dbModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">OT_DataBase Model View</h4>
	      </div>
	      <div class="modal-body">
	        <img  style="max-width: 100%;" src="img/OT_DB-model_image">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>



</div>

<?PHP
include "footer.php";
?>