<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");

$error_message = ""; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $username =  $_POST["username"];
    $password =  $_POST["password"];

    
    $checkQuery = "SELECT user_name FROM users WHERE user_name = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // $error_message = "Category name already exists. Please choose a different name.";
        header("Location: http://localhost/PHP-projects/CategoryCRUD/signup.php?error=Username already exists. Please choose a different Username.");
    } else {

        $insertQuery = "INSERT INTO users (name,user_name,password) VALUES ('$name', '$username','$password')";
        $result = mysqli_query($conn, $insertQuery);
        $_SESSION['username']=$username;
        $_SESSION['name']=$name;

        
            header("Location: http://localhost/PHP-projects/CategoryCRUD/index.php"); 
           
        
    }
}



mysqli_close($conn);
?>