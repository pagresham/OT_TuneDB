<?PHP
$connectMessage = '';
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// if (mysqli_connect_errno()) {
// 	die("Connection failed here:  ". mysqli_connect_error());
// }
// else {
// 	$connectMessage = "<h1 style='color:red;'>no con er</h1><br>";
// }

// Changed this to the OOP approach to the same thing
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db->connect_error) {
	die("Connection failed: ". $db->connect_error);
}
else {
	// echo "Connected successfully";
}







?>