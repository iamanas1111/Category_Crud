<?php
$conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");
$error_message = "";
$newImageName;
$updatenewImageName;
$tmpName;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['prod_id'];
    $productname = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['pname'];
    $newImage = $_POST['product_image']['name'];
    $previousImage = $_POST['product_image_previous'];
    $cid;

    if ($newImage != '') {
        $newImageName = $_POST['product_image']['name'];

    } else {
        $newImageName = $_POST['product_image_previous'];

    }

    if ($_FILES["product_image"]["error"] === 4) {
        echo "<script> alert('Image Does Not Exist'); </script>";

    } else {
        $fileName = $_FILES["product_image"]["name"];
        $fileSize = $_FILES["product_image"]["size"];
        $tmpName = $_FILES["product_image"]["tmp_name"];


        $validImageExtension = ['jpg', 'jpeg', 'png', 'webp'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script> alert('Invalid Image Extension'); </script>";
        } else if ($fileSize > 20000000) {
            echo "<script> alert('Image Size is Too Large'); </script>";
        } else {
            $newImageName = uniqid();
            $newImageName = $fileName;
            move_uploaded_file($tmpName, 'img1/' . $newImageName);
        }
    }

    $sql0 = "SELECT id FROM `category_manager` WHERE cname = '{$category}'";
    $result1 = mysqli_query($conn, $sql0) or die("Query Unsuccessful");

    while ($row = mysqli_fetch_assoc($result1)) {
        $cid = $row['id'];
        echo $cid;
    }

    //Update data in product_manager table using prod_id
    $sql = "UPDATE product_manager SET produnct_name = '{$productname}', price = '{$price}' , quantity = '{$quantity}' , c_id='{$cid}' , product_image='{$newImageName}' WHERE prod_id = '{$id}'";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");

    header("Location: http://localhost/PHP-projects/CategoryCRUD/productindex.php");
    mysqli_close($conn);

}

?>

<?php include 'header2.php';
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: loginpage.php");
    exit();
}
?>

<div id="main-content">
    <h2>Update Product</h2>
    <h3 style="text-align:center; color: red;">
        <?php echo $error_message; ?>
    </h3>
    <?php

    $conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");
    $pname = $_GET['param2'];
    $id = $_GET['param1'];
    $sql = "SELECT * FROM product_manager where prod_id = {$id}";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form class="post-form" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="hidden" name="prod_id" value="<?php echo $row['prod_id'] ?>" />
                    <input type="text" name="product_name" value="<?php echo $row['produnct_name'] ?>" />
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" pattern="^(?!0)[0-9]{1,7}$" required value="<?php echo $row['price'] ?>" />
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" name="quantity" pattern="^(?:[1-9]|[1-4][0-9]|50)$" required
                        value="<?php echo $row['quantity'] ?>" />
                </div>
                <div class="form-group">
                    <label>Parent Category</label>
                    <?php
                    $sql1 = "SELECT distinct cname,pid,id FROM category.category_manager where pid<>0 ;";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");

                    if (mysqli_num_rows($result1) > 0) {
                        echo '<select name = "pname" required>';
                        while ($row1 = mysqli_fetch_assoc($result1)) {

                            if ($row1['cname'] == $pname) {
                                $select = "selected";
                            } else {
                                $select = "";
                            }
                            echo "<option {$select}  value='{$row1["cname"]}'>{$row1["cname"]}</option>";
                        }
                        echo "</select>";
                    }

                    ?>

                </div>
                <div class="form-group">
                    <label>Product Image</label>
                    <input type="file" name="product_image" id="product_image" accept=".jpg, .jpeg, .png , .webp"><br>
                    <img src="img1/<?php echo $row['product_image']; ?>" width="20px" height="20px"
                        title="<?php echo $row['product_image']; ?>">
                    <?php
                    echo $row['product_image'];
                    ?>

                </div>

                <input type="hidden" name="product_image_previous" value="<?php echo $row['product_image']; ?>" />
                <input class="submit" type="submit" value="Update" />
            </form>
        <?php }
    }
    ?>
</div>
</div>
</body>

</html>