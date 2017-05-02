<?PHP
include "header.php";
$sortQuery = "";
$sort_result = "";
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

  if(!empty($_POST['members'])) {
    $sortArray[] = "L.MEMBER_ID =".$_POST['members']." ";
  }


	$sortQuery = "SELECT V.TUNE_NAME AS 'Name', V.TUNE_KEY AS 'Key', V.PARTS AS 'Parts', S.DESCRIPTION AS 'Source'
								
            FROM LISTS L
            JOIN VERSIONS V ON V.VERSION_ID = L.VERSION_ID
            JOIN SOURCES S
            ON V.SOURCES_ID = S.SOURCES_ID";
	
	for ($i = 0; $i < count($sortArray);$i++) {
			if($i == 0) {
				$sortQuery .= " WHERE ".$sortArray[$i]." ";
			}
			else {
				$sortQuery .= " AND ".$sortArray[$i]." ";
			}
	}

	if(!empty($_POST['order'])) {
		$order = " ORDER BY ".$_POST['order'];
		$sortQuery .= $order;
	}
  //print $sortQuery;
	$sort_result = mysqli_query($db, $sortQuery);
	if(!$sort_result)	{
		die("Connection terminated here:  ".mysqli_connect_error());
	}

	//print_r($sortArray);
	// print_r($sortQuery);

	// print_r($_POST);
	// $query_sort = "";
}

set_session_vars();
?>
<!-- #body started -->

<div class="explorer_results container">
	<div>
		<h3 class="legend-like">Explore the DB</h3>
	</div>
	<nav class="navbar navbar-default">
  		<div class="container-fluid sort-nav">
   			<div class="navbar-header">
     			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sortNavbar">
       				<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
      			</button>
      			<!-- <a class="navbar-brand" >Sort the DB!</a> -->
    		</div>
    		<form method="post" action="explore_more.php" id="explore">
   			<div class="collapse navbar-collapse" id="sortNavbar">
      			
      		<ul class="nav navbar-nav form-horizontal">
					<li>		
						<label for="title">Title</label>
    					<select class="form-control" name="title" id="title">
    						<option value="">All Tunes</option>
    						<?PHP
    							$query_name_sort = "SELECT DISTINCT TUNE_NAME
    											FROM VERSIONS
    											ORDER BY TUNE_NAME";
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
  						$query_key_sort = "SELECT DISTINCT TUNE_KEY
  											FROM VERSIONS
                        ORDER BY TUNE_KEY";
  						$key_sort_result = mysqli_query($db, $query_key_sort);
  						if(!$key_sort_result) {
  							print "<option>terminated</option>";
  							 die("DB connection terminated: ".mysqli_error());
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
  						$query_parts_sort = "SELECT DISTINCT PARTS
  											FROM VERSIONS
                        ORDER BY PARTS";
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
              $query_source_sort = "SELECT distinct description 
                                    from sources
                                    ORDER BY description";
  					
  						$source_sort_result = mysqli_query($db, $query_source_sort);
  						if(!$source_sort_result) {
  							 die("DB connection terminated: ".mysqli_error());
  						}
  						else if (mysqli_num_rows($source_sort_result) > 0) {
  							while ($row = mysqli_fetch_assoc($source_sort_result)) {
  								if($row) {
                    print "<option value='".$row['description']."'>".$row['description']."</option>";  
                  }
                  else {
                    die("terminated");
                  }
  							}
  						}
  						?>
  					</select>
					</li>
          <!-- Select Member field -->

          <li>
            <label for="order">Members</label>
            <select class="form-control" name="members" id="members">
              <option value="">All Members</option>
              <?PHP
              $query_member_sort = "SELECT F_NAME, L_NAME, MEMBER_ID 
                                    FROM MEMBERS
                                    ORDER BY L_NAME";
              $result = mysqli_query($db, $query_member_sort);
              if(!$result) {
                die("DB connection terminated: ".mysqli_error());
              }
              else if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  // 
                  print "<option value='".$row['MEMBER_ID']."'>".$row['F_NAME']." ".$row['L_NAME'].$row['MEMBER_ID']."</option>";
                }
              }

              ?>
            </select>
          </li>
					<li>
						<label for="order">Order By</label>
						<select class="form-control" name="order" id="order">
							<option value="v.tune_key">Key</option>
              <option value="">None</option>
							<option value="v.parts">Parts</option>
							<option value="s.description">Source</option>
              <option value="v.tune_name">Title</option>
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
					display_results($sort_result, $db);
				?>
			</table>
		</div>
	</div>
</div>

<!-- #body ends next line -->
<?PHP
//print "<p>".$row['TUNE_NAME']."</p>";
include "footer.php";
?>