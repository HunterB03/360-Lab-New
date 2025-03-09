<?php
require('db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "<p>You must be logged in to delete your account.</p>";
    exit();
}

// Get the logged-in user's ID
$username = $_SESSION['username'];

$query = "SELECT id FROM users WHERE username = '$username' AND isDelete = 0";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];

    // Proceed to delete the user (set isDelete = 1)
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        $delete_query = "UPDATE users SET isDelete = 1 WHERE id = $id";
        if (mysqli_query($con, $delete_query)) {
            echo "<p>Your account has been deleted successfully. <a href='login.php'>Go back to Login</a></p>";
        } else {
            echo "<p>Error deleting your account. <a href='dashboard.php'>Go back</a></p>";
        }
    } else {
        // Confirms with user
        echo "<p>Are you sure you want to delete your account? This action is irreversible.</p>";
        echo "<a href='deleteUser.php?id=$id&confirm=yes'>Yes, delete my account</a> | ";
        echo "<a href='dashboard.php'>Cancel</a>";
    }
} else {
    echo "<p>No such user found or the account is already deleted.</p>";
}
?>

