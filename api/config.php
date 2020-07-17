<?php

    $host="localhost"; // Host name
    $username="root"; // Mysql username
    $password=""; // Mysql password
    $db_name="interview_01-phptrain"; // Database name

    $conn=mysqli_connect("$host", "$username", "$password")or die("cannot connect");
    mysqli_select_db($conn,"$db_name") or die("cannot select db");
    $tbl_name="interlist";
    
?>