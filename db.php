<?php
    $con = mysqli_connect("localhost","root","","Lab3_LoginSystem");
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>