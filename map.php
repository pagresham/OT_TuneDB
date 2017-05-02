<?PHP
include "header.php";

$memberInfoArray = [];


$member_info_query = "SELECT CONCAT(F_NAME,' ',L_NAME) AS NAME, 
						IFNULL(TOWN, 'NONE') AS TOWN, IFNULL(STATE, 'NONE') AS STATE
						FROM MEMBERS";
$member_info_result = $db->query($member_info_query);
if(!$member_info_result) {
	die("Connection Terminated: member-query: ".mysqli_error($db));
}
else {
	if($member_info_result->num_rows > 0) {
		while ($row = $member_info_result->fetch_assoc()) {
			array_push($memberInfoArray, $row);
		}
	}
}

?>
<!-- JS link for this page -->
<script type="text/javascript" src="js/mapPage.js"></script>
<div class="container" id="mapPage">
	<div class="row">
		
		<div class="col-sm-12 member-info">
			<h2 class="legend-like2">Map the Database</h2>
			<div class="map-wrapper col-sm-8">
				<div id="umap" ></div>	
			</div>
			<div id="member-output" class="col-sm-4">
				<h2 class="legend-like">Member Information</h2>
				<?PHP
					print "<table style='text-align: left; min-width: 20em;'>";
					print "<tr><th>Name</th><th>Home Town</th><th>State</th></tr>";
					foreach ($memberInfoArray as $key => $value) {
						print "<tr class='member-line'>";
						print "<td class='memberName'>".$value['NAME']."</td>";
						print "<td class='memberTown'>".$value['TOWN']."</td>";
						print "<td class='memberState'>".$value['STATE']."</td>";
						print "</tr>";
					}
					print "</table>";
				?>
			</div>
		</div>
		<div class="col-sm-12 regional-info">
			<div id="regional-output" class="col-sm-4">
				<h2 class="legend-like">Regional Styles</h2>
				<div id="style-output">
					<div class="style-controls text-center">
						<button id="prev"><span class="glyphicon glyphicon-menu-left"></span><span class="glyphicon glyphicon-menu-left"></span></button>
						<button id="next"><span class="glyphicon glyphicon-menu-right"></span><span class="glyphicon glyphicon-menu-right"></span></button>
					</div>
				</div>
			</div>
			<div class="map-wrapper col-sm-8">
				<div id="regional-map"></div>
			</div>
		</div>
	</div>
</div>

<?PHP
include "footer.php";
?>