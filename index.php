<?php
include 'header.php';
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: loginpage.php");
    exit();
}
?>

<div id="main-content">
    <h2 >Welcome, <?php echo $_SESSION["name"]; ?>!</h2>
    <h2 >All Records</h2>
    
    <form class="col" method="GET">
        <input type="text" name="search" onkeyup="search" placeholder="Search by Category Name">
        <input type="submit" value="Search" style="background-color:greenyellow">
    </form>
   
    <?php
    include 'config.php';

    $searchQuery = '';
    if (isset($_GET['search'])) {
        $searchQuery = $_GET['search'];
    }

    $sql = "SELECT a.cname, a.id ,b.cname as pname, cc FROM category_manager AS a JOIN category_manager AS b ON b.id = a.pid LEFT JOIN ( SELECT c_id, COUNT(*) AS cc FROM product_manager GROUP BY c_id ) AS subquery ON subquery.c_id = a.id WHERE a.cname LIKE '%$searchQuery%' OR EXISTS ( SELECT 1 FROM category_manager AS b WHERE b.id = a.pid AND b.cname LIKE '%$searchQuery%');";
    // $sql2 = "SELECT b.cname , b.id from category_manager as a join category_manager as b on b.id =a.pid WHERE a.cname LIKE '%$searchQuery%';";
    
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
    // $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessful");
   

    


    if (mysqli_num_rows($result) > 0) {
        
    ?>
        <table cellpadding="7px">
            <thead>
                <th>Id</th>
                <th>Category Name</th>
                <th>Parent Category</th>
                <th>No. of Products</th>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    // $row2 = mysqli_fetch_assoc($result2);

                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['cname'] ?></td>
                        <td><?php echo $row['pname'] ?></td>
                        <td><?php echo empty($row['cc'])? 0: $row['cc']; ?></td>
                        <td>
                            <a href='edit.php?param1=<?php echo urlencode($row['id']); ?>&param2=<?php echo urlencode($row['pname']); ?>'>Edit</a>
                            <a href='delete-inline.php?id=<?php echo $row['id'] ?>' onclick='return checkdelete()'>Delete</a>
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
    function checkdelete(){
        return confirm('Are you sure you want to delete this record?');
    }
</script>