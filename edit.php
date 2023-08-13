<?php include 'header.php'; 
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: loginpage.php");
    exit();
}
?>

<div id="main-content">
    <h2>Update Category</h2>
    <?php
   

    $conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");
    $pname = $_GET['param2'];
    $id = $_GET['param1'];
    $error_message = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $newCname =  $_POST["cname"];
        $newPname = $_POST["pname"];

        $checkQuery = "SELECT cname FROM category_manager WHERE cname = '$newCname' AND id != '$id'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $error_message = "Category name already exists. Please choose a different name.";
        } else {
            $updateQuery = "UPDATE category_manager SET cname = '$newCname', pid = '$newPname' WHERE id = '$id'";
            $result = mysqli_query($conn, $updateQuery);

            if ($result) {
                header("Location: http://localhost/PHP-projects/CategoryCRUD/index.php");
                
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }

    $sql = "SELECT * FROM category_manager where id = {$id}";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <h3 style="text-align:center; color: red;"><?php echo $error_message; ?></h3>

            <form class="post-form" action="" method="post">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
                    <input type="text" name="cname" value="<?php echo $row['cname'] ?>" />
                </div>
                <div class="form-group">
                    <label>Parent Category</label>
                    <?php
                    $sql1 = "SELECT distinct cname, pid, id FROM category.category_manager where pid=0;";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");

                    if (mysqli_num_rows($result1) > 0) {
                        echo '<select name="pname">';
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $select = ($row1['cname'] == $pname) ? "selected" : "";
                            echo "<option {$select} value='{$row1["id"]}'>{$row1["cname"]}</option>";
                        }
                        echo "</select>";
                    }
                    ?>
                </div>
                <input class="submit" type="submit" value="Update" />
            </form>
        <?php }
    }

    mysqli_close($conn);
    ?>
</div>
</div>
</body>
</html>




