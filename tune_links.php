<?PHP
include "header.php";
$sortQuery =$sort_result =$url = "";
set_session_vars();
$urlArray = array();
$tempArr = array();
$u =$d =$v ="";


// A few things are going on below. 
// 
// 1. Query to the DB for all of the links. Then, Displays them all as ind iframes.
// 1.5 Edit the urls so they are embed urls, and not watch urls. 
// 2. Get values out of DB result, save in temp array, and push that array on to parent array.
// Giving me all the data in a local array to use as I want.
// Looks like: array(array('URL' => $u, 'Description' => $d, 'VersionId' => $v), array(), array()...)

// Build query to get all video links //
$image_query = "SELECT URL, DESCRIPTION, ifnull(VERSION_ID, '') AS VERSION_ID
                FROM LINKS";
$image_query_result = mysqli_query($db, $image_query);
// Pulled rest of this function from here //
  if(!$image_query_result) {
  die("Connection Terminated :".mysqli_error($db));
}
elseif (mysqli_num_rows($image_query_result) > 0) {

  while($row = mysqli_fetch_assoc($image_query_result)) {
    foreach ($row as $key => $value) {
      if ($key == 'URL') {
        $u = $value;
        $url = $value."?controls=1";
      }
      if ($key == 'DESCRIPTION') {
        $d = $value;
        $desc = $value;
      } 
      if ($key == 'VERSION_ID') { $versionId = $value; $v =$value; } 
        else { $versionId = 'Link Title'; $v ="None"; }
    }
    
    
    if(strpos($url, 'watch?v=') != false) {
      $url = str_replace('watch?v=', "embed/", $url);
    }
    // print "<p>".$url."</p>";
    // $source = "<iframe src='".$url."'></iframe>";
    //print $source;
    
    // I'm taking the $url var instead of the $u, so I have the /embed url plus controls, and not the /watch one
    $tempArr = array('URL' => $url, 'Description' => $d, 'VersionId' => $v);
    array_push($urlArray, $tempArr);
  }
  // print_r($urlArray);
}



?>
<!-- #body started -->


<div class="explorer_results container">
	<div class="legend-like2">
		<h3>Explore our video links</h3>
	</div>
  <section class="vlink-section">
    <div class='row'>
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-6" id="vid-sel">
            
            <!-- <div class="center lnk-btn">
              <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#link-list-drp">Display Links</button>  
            </div> -->

            <div class='drop-down'>
            
              <div id="link-list-drp" >
                <ul>
                  <?PHP
                  
                  for($i=0;$i<count($urlArray);$i++){
                      if($i % 2 ==0){
                        $class = "tune-links";
                      }
                      else {$class = "tune-links2";}

                     print "<li href='#' class='$class' id='".$urlArray[$i]['URL']."'>
                     <span class='glyphicon glyphicon-facetime-video fire'></span> ".$urlArray[$i]['Description']."</li>";
                    }
                  ?>  
                </ul>                             
              </div>
           </div>
          </div>
          <div class="col-sm-6" id="vid-dsp">
            <iframe id="vid-frame" allowfullscreen></iframe>
          </div>
        </div>
      </div>
      <!-- additional row here -->

    </div>
  </section>
  <section></section>

</div>

<!-- #body ends next line -->
<?PHP
//print "<p>".$row['TUNE_NAME']."</p>";
include "footer.php";
?>