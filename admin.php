<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include "db.php";
$result = mysqli_query($conn, "SELECT * FROM appointments ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Swasthya Care</title>
    <style>
        :root {
            --primary: #4e73df;
            --success: #1cc88a;
            --info: #36b9cc;
            --danger: #e74a3b;
            --dark: #5a5c69;
            --light: #f8f9fc;
            --border: #e3e6f0;
        }

        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--light);
            margin: 0;
            display: flex;
        }

        /* Sidebar Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, var(--primary) 10%, #224abe 100%);
            min-height: 100vh;
            color: white;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar h2 {
            font-size: 1.2rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        /* Main Content Area */
        .main-content {
            flex-grow: 1;
            padding: 40px;
        }

        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .card-header {
            background: #f8f9fc;
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            font-weight: bold;
            color: var(--primary);
        }

        /* Modern Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #fff;
            color: var(--dark);
            text-transform: uppercase;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid var(--border);
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
            font-size: 0.85rem;
            color: #6e707e;
        }

        tr:hover {
            background-color: #f8f9fc;
        }

        /* Action Buttons */
        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-edit {
            background-color: var(--success);
            color: white;
        }

        .btn-delete {
            background-color: var(--danger);
            color: white;
        }

        .btn:hover {
            filter: brightness(90%);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Status Badge */
        .dept-badge {
            background: #eaecf4;
            color: var(--dark);
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Swasthya Care</h2>
    <p style="font-size: 0.8rem; opacity: 0.8;">Admin Dashboard</p>
    <hr style="border: 0.5px solid rgba(255,255,255,0.1);">
    <a href="logout.php" style="color: white; text-decoration: none; font-size: 0.9rem;">Logout</a>
</div>

<div class="main-content">
    <div class="header-flex">
        <h1 style="color: var(--dark); margin: 0;">Appointment Management</h1>
        <div style="color: var(--secondary);">Total Records: <?= mysqli_num_rows($result); ?></div>
    </div>

    <div class="card">
        <div class="card-header">Patient Inquiries</div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Details</th>
                    <th>Department</th>
                    <th>Date</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td>#<?= $row['id']; ?></td>
                    <td>
                        <strong><?= htmlspecialchars($row['name']); ?></strong><br>
                        <small><?= htmlspecialchars($row['phone']); ?></small>
                    </td>
                    <td><span class="dept-badge"><?= $row['department']; ?></span></td>
                    <td><?= date('M d, Y', strtotime($row['date'])); ?></td>
                    <td title="<?= htmlspecialchars($row['message']); ?>">
                        <?= substr(htmlspecialchars($row['message']), 0, 30) . '...'; ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Confirm deletion?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>