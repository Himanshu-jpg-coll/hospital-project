<?php
include "db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$department = $_POST['department'];
$date = $_POST['date'];
$address = $_POST['address'];
$message = $_POST['message'];

$sql = "UPDATE appointments SET 
        name='$name',
        phone='$phone',
        department='$department',
        date='$date',
        address='$address',
        message='$message'
        WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: admin.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>