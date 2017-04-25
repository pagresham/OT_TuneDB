<!-- logout.php -->
<!-- A redirect to home page -->

<?PHP
session_start();
include "authentication.php";
logOut();
header("Location: index.php");
?> 




<!-- header('Location: http://www.example.com/'); -->