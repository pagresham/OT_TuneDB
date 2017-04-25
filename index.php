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
	</div>

</div>























<?PHP
include "footer.php";
?>