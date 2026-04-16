<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../config/db.php';

$properties = $conn->query("SELECT * FROM properties");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Properties</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <h2>Manage Properties</h2>
    <a href="add_property.php">Add Property</a>
    <table>
        <tr>
            <th>Title</th>
            <th>Location</th>
            <th>Price</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $properties->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><img src="../images/<?php echo $row['image']; ?>" width="80"></td>
            <td>
                <a href="edit_property.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete_property.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete property?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
