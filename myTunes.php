<?PHP
include "header.php";
$sortQuery = "";
$sort_result = "";


// Run search query when page first loads //
$sortQuery = "SELECT DISTINCT V.TUNE_NAME AS 'Name', V.TUNE_KEY AS 'Key', V.PARTS AS 'Parts', S.description AS 'Source', L.SKILL_LVL AS 'Skill', V.VERSION_ID
								FROM SOURCES S 
								JOIN VERSIONS V
								ON V.SOURCES_ID = S.SOURCES_ID
								JOIN LISTS L
								ON L.VERSION_ID = V.VERSION_ID";

$sort_result = mysqli_query($db, $sortQuery." WHERE L.MEMBER_ID = ".$memberId);
	if(!$sort_result)	{
		die("Connection terminated:  ".mysqli_connect_error($db));
	}

// End initial query //

if (isset($_POST['sort_all'])) {
	$sortArray = array();


	// Add additional server side validation here.

	if(!empty($_POST['title'])) {
		$sortArray[] = "v.tune_name ='".$_POST['title']."'";
	}
		
	if(!empty($_POST['key'])) {
		$sortArray[] = "v.tune_key ='".$_POST['key']."'";
	}
	
	if(!empty($_POST['parts'])) {
		$sortArray[] = "v.parts =".$_POST['parts'];
	}
	
	if(!empty($_POST['source'])) {
		$sortArray[] = "s.description ='".$_POST['source']."'";
	}

	// Pulled from here
	$sortQuery = "SELECT DISTINCT V.TUNE_NAME AS 'Name', V.TUNE_KEY AS 'Key', V.PARTS AS 'Parts', S.description AS 'Source', L.SKILL_LVL AS 'Skill', V.VERSION_ID
								FROM SOURCES S 
								JOIN VERSIONS V
								ON V.SOURCES_ID = S.SOURCES_ID
								JOIN LISTS L
								ON L.VERSION_ID = V.VERSION_ID";
	
	for ($i = -1; $i < count($sortArray);$i++) {
			if($i == -1) {
				$sortQuery .= " WHERE L.MEMBER_ID = ".$memberId;
			}
			else {
				$sortQuery .= " AND ".$sortArray[$i]." ";
			}
	}
	// print $sortQuery;

	if(!empty($_POST['order'])) {
		$order = " ORDER BY ".$_POST['order'];
		$sortQuery .= $order;
	}

	$sort_result = mysqli_query($db, $sortQuery);
	if(!$sort_result)	{
		die("Connection terminated:  ".mysqli_connect_error($db));
	}
	else { 
		//print $sortQuery; 
	}

	//print_r($sortArray);
	// print_r($sortQuery);

	// print_r($_POST);
	// $query_sort = "";
}

set_session_vars();
?>

<div class="explorer_results container">
	<div>
		<h3 class="legend-like">Explore the DB</h3>
	</div>
	<nav class="navbar navbar-default">
  		<div class="container-fluid serach-nav">
   			<div class="navbar-header">
     			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sortNavbar">
       				<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
      			</button>
      			<!-- <a class="navbar-brand" >Sort the DB!</a> -->
    		</div>
    		<form method="post" action="myTunes.php" id="explore">
   			<div class="collapse navbar-collapse" id="sortNavbar">
      			
      		<ul class="nav navbar-nav form-horizontal">
      		
			<li>		
				<label for="title">Title</label>
				<select class="form-control" name="title" id="title">
					<option value="">All Tunes</option>
					<?PHP
						$query_name_sort = "SELECT DISTINCT V.TUNE_NAME
										FROM VERSIONS V JOIN 
										LISTS L 
										ON V.VERSION_ID = L.VERSION_ID
										JOIN MEMBERS M
										ON M.MEMBER_ID = L.MEMBER_ID
										WHERE M.MEMBER_ID = '$memberId'
										ORDER BY V.TUNE_NAME";
						$name_sort_result = mysqli_query($db, $query_name_sort);
						if(!$name_sort_result) {
							//print "<option>terminated</option>";
							 die("DB connection terminated: ".mysqli_error());
						}
						else if (mysqli_num_rows($name_sort_result) > 0) {
							while ($row = mysqli_fetch_assoc($name_sort_result)) {
								// $replaced = str_replace(" ", "\ ",$row['TUNE_NAME']);

								print "<option value='".$row['TUNE_NAME']."'>".$row['TUNE_NAME']."</option>";
								// print $row['TUNE_NAME'];
							}
						}
						print $row['TUNE_NAME'];
					?>
				</select>
			</li>
			
			<li>		
				<label for="key">Key</label>
				<select class="form-control" name="key" id="key">
					<option value="">All Keys</option>
					<?PHP
					$query_key_sort = "SELECT DISTINCT V.TUNE_KEY 
										FROM VERSIONS V 
										JOIN LISTS L 
										ON V.VERSION_ID = L.VERSION_ID 
										JOIN MEMBERS M 
										ON M.MEMBER_ID = '$memberId' 
										ORDER BY V.TUNE_KEY";
					$key_sort_result = mysqli_query($db, $query_key_sort);
					if(!$key_sort_result) {
						print "<option>terminated</option>";
						print(mysqli_error($db));
						 die("DB connection terminated: ".mysqli_error($db));
					}
					else if (mysqli_num_rows($key_sort_result) > 0) {
						while ($row = mysqli_fetch_assoc($key_sort_result)) {
							print "<option value='".$row['TUNE_KEY']."'>".$row['TUNE_KEY']."</option>";
						}
					}
					?>
				</select>
			</li>
		
			<li>
				<label for="parts">Parts</label>			
				<select class="form-control" name="parts" id="parts">
					<option value="">Any Number</option>
					<?PHP
					$query_parts_sort = "SELECT DISTINCT V.PARTS 
										FROM VERSIONS V 
										JOIN LISTS L 
										ON V.VERSION_ID = L.VERSION_ID 
										JOIN MEMBERS M 
										ON M.MEMBER_ID = '$memberId' 
										ORDER BY V.PARTS";
					$parts_sort_result = mysqli_query($db, $query_parts_sort);
					if(!$parts_sort_result) {
						print "<option>terminated</option>";
						 die("DB connection terminated: ".mysqli_error());
					}
					else if (mysqli_num_rows($parts_sort_result) > 0) {
						while ($row = mysqli_fetch_assoc($parts_sort_result)) {
							print "<option value='".$row['PARTS']."'>".$row['PARTS']."</option>";
						}
					}
					?>
				</select>
			</li>
			<li>
				<label for="source">Source</label>			
				<select class="form-control" name="source" id="source">
					<option value="">All Sources</option>
					<?PHP
					$query_source_sort = "SELECT DISTINCT S.description 
										FROM SOURCES S 
										JOIN VERSIONS V
										ON S.SOURCES_ID = V.SOURCES_ID 
										JOIN LISTS L 
										ON V.VERSION_ID = L.VERSION_ID 
										JOIN MEMBERS M 
										ON M.MEMBER_ID = '$memberId' 
										
										ORDER BY S.description";

					$source_sort_result = mysqli_query($db, $query_source_sort);
					if(!$source_sort_result) {
						print "<option>terminated</option>";
						 die("DB connection terminated: ".mysqli_error());
					}
					else if (mysqli_num_rows($source_sort_result) > 0) {
						while ($row = mysqli_fetch_assoc($source_sort_result)) {
							print "<option value='".$row['description']."'>".$row['description']."</option>";
						}
					}
					?>
				</select>
			</li>
			<li>
				<label for="order">Order By</label>
				<select class="form-control" name="order" id="order">
					<option value="">None</option>
					<option value="v.tune_name">Title</option>
					<option value="v.tune_key">Key</option>
					<option value="v.parts">Parts</option>
					<option value="s.description">Source</option>
					<?PHP

					?>
				</select>
			</li>
	      </ul>
    		<ul class="nav navbar-nav navbar-right form-horizontal">
  				<button class="navbar-btn btn myNavBtn" type="submit" name="sort_all">Sort!</button>
  			</ul>
    		</div>
    		</form>
  		</div>
	</nav>
	<div class="row">
		<div class="col-sm-12 explore-display">
			
				<?PHP
				if($sort_result)
					display_myTunes($sort_result, $db, $_SERVER['PHP_SELF'])
				?>
			</table>
		</div>
	</div>
</div>

<!-- #body ends next line -->
<?PHP
include "footer.php";
?>