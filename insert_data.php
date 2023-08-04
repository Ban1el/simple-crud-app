<?php

include("database.php");

if (isset($_POST['add_user'])) {


    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email_address'];
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];


    $query = "INSERT INTO users (first_name, last_name, email, mobile_number, address)
    VALUES ('$first_name', '$last_name', '$email', '$mobile_number', '$address');";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die(mysqli_error($connection));
    } else {
        header("location:./index.php");
    }
}
