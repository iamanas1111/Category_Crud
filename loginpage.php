<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php
include 'loginHeader.php';
?>

    <div id="main-content">
        <br><br>
        <?php if (isset($_GET['error'])) { ?>
            <h2 style="text-align:center; color: red;" class="error"><?php echo $_GET['error']; ?></h2>
     	<?php } ?>
        <div class="form-container">
            <form class="post-form" action="login_process.php" method="POST">
                <div class="form-group">
                    <label title="Required Field">Username<span style=color:red;>*</span></label>
                    <input type="text" name="username"   required/>
                </div>
                <div class="form-group">
                    <label title="Required Field">Password<span style=color:red;>*</span></label>
                    <input type="password" name="password"   required/>
                </div>
                <input  class="submit" type="submit" value="Login" />

                <br>
                <br>
                <ul><li> <p>Don't Have an Account: <a href="signup.php" type="submit" style="color:blue;">Sign Up</a></p></li></ul>
            </form>
        </div>
    </div>
</body>
</html>





