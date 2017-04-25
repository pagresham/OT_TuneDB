
<?PHP
include "header.php";

$newPw = 'PierceGresham1!';
$memberId = 12;

$hashedPassword = password_hash($newPw, 1);
$update_pw_query = "UPDATE MEMBERS
					SET PASSWORD = '$hashedPassword'
					WHERE MEMBER_ID = $memberId";

$update = mysqli_query($db, $update_pw_query);
if(!$update) {
	die("connection terminated: ".mysqli_error($db));
}
else {
	header("Location: index.php");	
}
?>



<?PHP
include "footer.php";



?>