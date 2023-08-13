<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: loginpage.php");
    exit();
}
$conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");
$error_message = "";
$newImageName;
$tmpName;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $productname = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
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

    $cid;

    $machingQuery = "SELECT produnct_name from product_manager where produnct_name='$productname'";
    $queryResult = mysqli_query($conn, $machingQuery);
    if (mysqli_num_rows($queryResult) > 0) {
        $error_message = "Product name already exists. Please choose a different name.";
    } else {
        $sql0 = "SELECT id FROM `category_manager` WHERE cname = '{$category}'";
        $result1 = mysqli_query($conn, $sql0) or die("Query Unsuccessful");

        while ($row = mysqli_fetch_assoc($result1)) {
            $cid = $row['id'];
            echo $cid;
        }

        //Insert Query

        $sql = "INSERT INTO product_manager(produnct_name,price,quantity,c_id,product_image) VALUES ('{$productname}','{$price}','{$quantity}','{$cid}','{$newImageName}')";
        $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
        if ($result) {
            header("Location: http://localhost/PHP-projects/CategoryCRUD/productindex.php");

        } else {
            echo "Error: " . mysqli_error($conn);
        }

    }

}

mysqli_close($conn);

?>


<?php include 'header2.php'; ?>
<div id="main-content">
    <h2>Add New Product</h2>
    <h3 style="text-align:center; color: red;">
        <?php echo $error_message; ?>
    </h3>
    <form class="post-form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="product_name" required />
        </div>
        <div class="form-group">
            <label>Product Price</label>
            <input type="text" name="price" pattern="^(?!0)[0-9]{1,7}$" title="Range 1-100000 allowed only" required />
        </div>
        <div class="form-group">
            <label>Product Quantity</label>
            <input type="text" name="quantity" pattern="^(?:[1-9]|[1-4][0-9]|50)$"  title="Range 1-50 allowed only"
                required />
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category" required>
                <option value="" selected disabled>Select Class</option>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");
                $sql = "SELECT distinct cname FROM category.category_manager where pid<>0;";
                $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $row['cname']; ?>"><?php echo $row['cname']; ?></option>

                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Product Image</label>
            <input type="file" name="product_image" id="image" accept=".jpg, .jpeg, .png , .webp"
                onchange="showImagePreview(event)"><br><br>
            <img id="imagePreview" src="#" alt="Selected Image" style="max-width: 200px; display: none;" />
            <script>
                function showImagePreview(event) {
                    var input = event.target;
                    var imgPreview = document.getElementById('imagePreview');

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            imgPreview.src = e.target.result;
                            imgPreview.style.display = 'block';
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>

        </div>

        <input class="submit" type="submit" value="Save" />
    </form>
</div>
</div>
</body>

</html>