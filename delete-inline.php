<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: loginpage.php");
    exit();
}


$id = $_GET['id'];

include 'config.php';

$sql = "DELETE FROM category_manager WHERE id = {$id}";
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful");

header("Location: http://localhost/PHP-projects/CategoryCRUD/index.php");

mysqli_close($conn);


?>
