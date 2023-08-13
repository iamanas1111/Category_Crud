<?php
include 'header2.php';
session_start();

// Check if user is logged in, else redirect to login page
if (!isset($_SESSION["username"])) {
    header("Location: loginpage.php");
    exit();
}
?>
<div id="main-content">
    <h2>All Product Records</h2>
    <form method="GET">
        <input type="text" name="search" placeholder="Search by Category Name">
        <input type="submit" value="Search" style="background-color:greenyellow">
    </form>
    <?php
    include 'config.php';

    $searchQuery = '';
    if (isset($_GET['search'])) {
        $searchQuery = $_GET['search'];
    }

    $sql = "SELECT a.produnct_name, a.price , a.quantity, b.cname, a.prod_id, a.product_image FROM product_manager AS a INNER JOIN category_manager AS b ON b.id = a.c_id WHERE a.produnct_name LIKE '%$searchQuery%' OR b.cname LIKE '%$searchQuery%';";
    // $sql2 = "SELECT b.cname , b.id from category_manager as a join category_manager as b on b.id =a.pid WHERE a.cname LIKE '%$searchQuery%';";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
    // $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful");

    if (mysqli_num_rows($result) > 0) {

        ?>
        <table cellpadding="7px">
            <thead>
                <th>Id</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Category Name</th>
                <th>Image</th>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    // $row2 = mysqli_fetch_assoc($result2);
                    ?>
                    <tr>
                        <td>
                            <?php echo $i ?>
                        </td>
                        <td>
                            <?php echo $row['produnct_name'] ?>
                        </td>
                        <td>
                            <?php echo $row['price'] ?>
                        </td>
                        <td>
                            <?php echo $row['quantity'] ?>
                        </td>
                        <td>
                            <?php echo $row['cname'] ?>
                        </td>
                        <td>
                           <img src="img1/<?php echo $row['product_image'];?>" width="20px" height="20px" title="<?php echo $row['product_image'];?>">
                        </td>
                        <td>
                            <a
                                href='editproduct.php?param1=<?php echo urlencode($row['prod_id']); ?>&param2=<?php echo urlencode($row['cname']); ?>'>Edit</a>
                            <a href='deleteproduct-inline.php?id=<?php echo $row['prod_id'] ?>&param2=<?php echo urlencode($row['cname']); ?>'
                                onclick='return checkdelete()'>Delete</a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "<h2>No Record Found</h2>";
    }
    mysqli_close($conn);
    ?>
</div>
</body>

</html>


<script>
    function checkdelete()  {
        return confirm('Are you sure you want to delete this record?');
    }
</script>