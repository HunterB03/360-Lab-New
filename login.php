<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
<body>
<?php
require('db.php');
session_start();

if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

    // Check user is exist in the database and if user is not deleted
    $query = "SELECT * FROM users WHERE username='$username' 
              AND password='" . md5($password) . "' AND isDelete=0";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        echo "<div class='form'>
                <h3>Incorrect Username/password or account deleted.</h3><br/>
                <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
              </div>";
    }
} else {
?>
<form class="form" method="post" name="login">
    <h1 class="login-title">Login</h1>
    <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true" required />
    <input type="password" class="login-input" name="password" placeholder="Password" required />
    <input type="submit" value="Login" name="submit" class="login-button" />
    <p class="link"><a href="register.php">New Registration</a></p>
</form>
<?php
}
?>
</body>
</html>