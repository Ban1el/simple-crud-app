<?php

include("database.php");

if (isset($_POST['login_user'])) {


    $query = "SELECT * FROM accounts";
    $result = mysqli_query($connection, $query);
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];


    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['user'] == $user_name && $row['password'] == $password) {
            header("location:./index.php");
            exit();
        }
    }

    header("location:./login_page.php");
}
