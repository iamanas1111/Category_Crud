<?php 

// $name = $_POST['cname'];
// $pname = $_POST['pname'];
// $pid;

// echo $name;
// echo $pname;

// $conn = mysqli_connect("localhost","root","","category") or die("Connection Failed");
// if(!empty($pname)){
// $sql0 = "SELECT id FROM `category_manager` WHERE cname = '{$pname}'";
// $result1 = mysqli_query($conn,$sql0) or die("Query Unsuccessful");

// while($row=mysqli_fetch_assoc($result1)){
// $pid = $row['id'];
// echo $pid;
// }
// }else{
//     $pid =0;
// }
// $sql = "INSERT INTO category_manager(cname,pid) VALUES ('{$name}','{$pid}')";
// $result = mysqli_query($conn,$sql) or die("Query Unsuccessful");

// header("Location: http://localhost/PHP-projects/CategoryCRUD/index.php");

// mysqli_close($conn);

?>













<?php
// session_start(); 

// $conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");

// $error_message = ""; 

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $cname = mysqli_real_escape_string($conn, $_POST["cname"]);
//     $pname = mysqli_real_escape_string($conn, $_POST["pname"]);

   
//     $checkQuery = "SELECT cname FROM category_manager WHERE cname = '$cname'";
//     $checkResult = mysqli_query($conn, $checkQuery);

//     if (mysqli_num_rows($checkResult) > 0) {
//         $error_message = "Category name already exists. Please choose a different name.";
//     } else {
//         if (!empty($pname)) {
//             $sql0 = "SELECT id FROM category_manager WHERE cname = '$pname'";
//             $result1 = mysqli_query($conn, $sql0) or die("Query Unsuccessful");

//             while ($row = mysqli_fetch_assoc($result1)) {
//                 $pid = $row['id'];
//             }
//         } else {
//             $pid = 0;
//         }

//         $insertQuery = "INSERT INTO category_manager (cname, pid) VALUES ('$cname', '$pid')";
//         $result = mysqli_query($conn, $insertQuery);

//         if ($result) {
//             header("Location: form.php"); 
//         } else {
//             echo "Error: " . mysqli_error($conn);
//         }
//     }
// }


// $_SESSION['error_message'] = $error_message;

// mysqli_close($conn);
?>
