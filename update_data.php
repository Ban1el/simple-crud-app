<?php
include("database.php");

//Displays current user data 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $row_id = $_POST['row_id'];

    $query = "SELECT * FROM users WHERE id = '$row_id'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        http_response_code(500);
        echo "Query error: " . mysqli_error($connection);
    } else {

        $row = mysqli_fetch_assoc($result);


        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $email = $row['email'];
        $mobileNumber = $row['mobile_number'];
        $address = $row['address'];

        $assocArray = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'mobile_number' => $mobileNumber,
            'address' => $address
        ];

        $jsonData = json_encode($assocArray);
        echo $jsonData;
    }
}

if (isset($_POST['update_record'])) {

    $row_id = $_POST['row_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email_address'];
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];

    $query = "UPDATE users
    SET first_name = '$first_name', last_name='$last_name', email='$email', mobile_number='$mobile_number', address='$address'
    WHERE id = '$row_id';";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die(mysqli_error($connection));
    } else {
        header("location:./index.php");
    }
}
