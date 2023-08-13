<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: loginpage.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cname = $_POST["cname"];
    $pname = $_POST["pname"];


    $checkQuery = "SELECT cname FROM category_manager WHERE cname = '$cname'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $error_message = "Category name already exists. Please choose a different name.";
    } else {
        if (!empty($pname)) {
            $sql0 = "SELECT id FROM category_manager WHERE cname = '$pname'";
            $result1 = mysqli_query($conn, $sql0) or die("Query Unsuccessful");

            while ($row = mysqli_fetch_assoc($result1)) {
                $pid = $row['id'];
            }
        } else {
            $pid = 0;
        }

        $insertQuery = "INSERT INTO category_manager (cname, pid) VALUES ('$cname', '$pid')";
        $result = mysqli_query($conn, $insertQuery);

        if ($result) {
            header("Location: http://localhost/PHP-projects/CategoryCRUD/index.php");

        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}



mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <?php include 'header.php'; ?>

    <div id="main-content">
        <h2>Add New Category</h2>
        <div class="form-container">
            <h3 style="text-align:center; color: red;">
                <?php echo $error_message; ?>
            </h3>
            <form class="post-form" action="" method="post">
                <div class="form-group">
                    <label>Category Name</label>

                    <input type="text" name="cname" pattern="[A-Za-z\s]+" title="Please enter letters only" required />

                </div>
                <div class="form-group">
                    <label>Parent Category</label>
                    <select name="pname">
                        <option value="" selected>Select Class</option>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "category") or die("Connection Failed");
                        $sql = "SELECT distinct cname FROM category.category_manager where pid=0;";
                        $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $row['cname']; ?>"><?php echo $row['cname']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <input class="submit" type="submit" value="Save" />
            </form>
        </div>
    </div>
</body>

</html>