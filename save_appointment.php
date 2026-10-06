<?php
include "db.php";

$name = $_POST['name'];
$phone = $_POST['phone'];
$department = $_POST['department'];
$date = $_POST['date'];
$address = $_POST['address'];
$message = $_POST['message'];

$sql = "INSERT INTO appointments (name, phone, department, date, address, message)
        VALUES ('$name', '$phone', '$department', '$date', '$address', '$message')";

if (mysqli_query($conn, $sql)) {
    echo "Success";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>