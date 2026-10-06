<?php
include "db.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM appointments WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <style>
        body { font-family: Arial; background:#f5f5f5; }
        .form-box {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            background: green;
            color: white;
            padding: 10px;
            border: none;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Edit Appointment</h2>

    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">

        <input type="text" name="name" value="<?= $row['name']; ?>" required>
        <input type="text" name="phone" value="<?= $row['phone']; ?>" required>

        <select name="department">
            <option <?= ($row['department']=="Cardiology")?"selected":""; ?>>Cardiology</option>
            <option <?= ($row['department']=="Orthopedics")?"selected":""; ?>>Orthopedics</option>
            <option <?= ($row['department']=="Gynecology")?"selected":""; ?>>Gynecology</option>
            <option <?= ($row['department']=="Pediatrics")?"selected":""; ?>>Pediatrics</option>
        </select>

        <input type="date" name="date" value="<?= $row['date']; ?>">

        <textarea name="address"><?= $row['address']; ?></textarea>
        <textarea name="message"><?= $row['message']; ?></textarea>

        <button type="submit">Update</button>
    </form>
</div>

</body>
</html>