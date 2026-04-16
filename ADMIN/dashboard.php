<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../config/db.php';

// Get property count
$prop_result = $conn->query("SELECT COUNT(*) AS total FROM properties");
$property_count = $prop_result->fetch_assoc()['total'];

// Get user count
$user_result = $conn->query("SELECT COUNT(*) AS total FROM users");
$user_count = $user_result->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <div class="admin-container">
        <h2>Welcome, Admin</h2>
        <p>Total Properties: <?php echo $property_count; ?></p>
        <p>Total Users: <?php echo $user_count; ?></p>
        <a href="manage_properties.php">Manage Properties</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
