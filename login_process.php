<?php

session_start();
$usernamedb;
$passworddb;
$name;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    //THIS METHOD ALSO WORKING

//     if (empty($username)) {
// 		header("Location: loginpage.php?error=User Name is required");
// 	    exit();
// 	}else if(empty($password)){
//         header("Location: loginpage.php?error=Password is required");
// 	    exit();
// 	}else{
//         $conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");
// 		$sql = "SELECT * FROM users WHERE user_name='$username' AND password='$password'";

// 		$result = mysqli_query($conn, $sql);

// 		if (mysqli_num_rows($result) === 1) {
// 			$row = mysqli_fetch_assoc($result);
//             if ($row['user_name'] === $username && $row['password'] === $password) {
//             	$_SESSION['username'] = $row['user_name'];
//             	$_SESSION['name'] = $row['name'];
//             	$_SESSION['id'] = $row['id'];
//             	header("Location: http://localhost/PHP-projects/CategoryCRUD/index.php");
// 		        exit();
//             }else{
// 				header("Location: http://localhost/PHP-projects/CategoryCRUD/loginpage.php?error=Incorect User name or password");
// 		        exit();
// 			}
// 		}else{
// 			header("Location: http://localhost/PHP-projects/CategoryCRUD/loginpage.php?error=Incorect User name or password");
// 	        exit();
// 		}
// 	}
	
// }else{
// 	header("Location: loginpage.php");
// 	exit();
// }

    $conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");
    $sql = "SELECT * FROM users;";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
    while ($row = mysqli_fetch_assoc($result)) {
        
        $usernamedb = $row['user_name'];
        $passworddb = $row['password'];
        $name = $row['name'];

        if ($username === $usernamedb && $password === $passworddb) {
            $_SESSION["username"] = $username; // Store username in session
            $_SESSION["name"]=$name;
            header("Location: http://localhost/PHP-projects/CategoryCRUD/index.php");
            exit();
            
        } else {
           
            header("Location: http://localhost/PHP-projects/CategoryCRUD/loginpage.php?error=Invalid Username or Password");
		    

        }
       
    }

}

    

?>
