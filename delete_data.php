<?php
include("database.php");

if (isset($_GET['row_id'])) {
    $row_id = $_GET['row_id'];

    $query = "DELETE FROM users WHERE id = '$row_id'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die(mysqli_error($connection));
    } else {
        header("location:./index.php");
    }
}
