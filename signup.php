<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <?php
    include 'signupheader.php';
    ?>

    <div id="main-content">
        <br><br>
        <?php if (isset($_GET['error'])) { ?>
            <h2 style="text-align:center; color: red;" class="error">
                <?php echo $_GET['error']; ?>
            </h2>
        <?php } ?>
        <div class="form-container">
            <form class="post-form" action="signup_process.php" method="POST">
                <div class="form-group">
                    <label title="Required Field">Name<span style=color:red;>*</span></label>
                    <input type="text" name="name" required />
                </div>
                <div class="form-group">
                    <label title="Required Field">Username<span style=color:red;>*</span></label>
                    <input type="text" name="username" pattern="^[a-zA-Z0-9.@-]+$"
                        title="Allowed Character Pattern: Letters, Numbers, ., @, and -" required />
                </div>
                <div class="form-group">
                    <label title="Required Field">Password<span style=color:red;>*</span></label>
                    <input type="password" name="password" pattern="^(?=.*[@$])(?=.*[A-Z])(?=.*[0-9]).{6,}$" title="Contains at least 1 special character (@ or $).
Contains at least 1 capital letter.
Contains at least 1 digit (number).
Has a minimum length of 6 characters." required />
                </div>
                <input class="submit" type="submit" value="Sign Up" />

                <br>
                <br>
                <ul>
                    <li>
                        <p>Do you Have an Account: <a href="loginpage.php" type="submit" style="color:blue;">Login</a>
                        </p>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</body>

</html>