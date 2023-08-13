<?php

// $id = $_POST['prod_id'];
// $productname = $_POST['product_name'];
// $price = $_POST['price'];
// $quantity = $_POST['quantity'];
// $category = $_POST['pname'];
// $cid;

// echo $productname;
// echo $price;
// echo $quantity . "<br>";
// echo $category;


// $conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");

// //Fetch the id of category name from category_manager table and assign to $cid variable
// $sql0 = "SELECT id FROM `category_manager` WHERE cname = '{$category}'";
// $result1 = mysqli_query($conn, $sql0) or die("Query Unsuccessful");

// while ($row = mysqli_fetch_assoc($result1)) {
//     $cid = $row['id'];
//     echo $cid;
// }

// //Update data in product_manager table using prod_id
// $sql = "UPDATE product_manager SET produnct_name = '{$productname}', price = '{$price}' , quantity = '{$quantity}' , c_id='{$cid}' WHERE prod_id = '{$id}'";
// $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");




// header("Location: http://localhost/PHP-projects/CategoryCRUD/productindex.php");

// mysqli_close($conn);
?>



































// //Get Counts of C_ID of Category group by c_id and assign counts to $cc variable
// $sql3 = "SELECT count(*) as cc from product_manager WHERE c_id={$cid} group by c_id ";
// $result3 = mysqli_query($conn, $sql3) or die("Query Unsuccessful");
// $cc;
// while ($row2 = mysqli_fetch_assoc($result3)) {
// $cc = $row2['cc'];
// }

// //Update no_of_products in category_manager table
// $sql2 = "UPDATE category_manager set no_of_products = {$cc} where id = {$cid}";
// $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful");