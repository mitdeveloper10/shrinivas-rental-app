<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/$image");

    $query = "INSERT INTO properties (title, location, price, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssds", $title, $location, $price, $image);
    
    if ($stmt->execute()) {
        header("Location: manage_properties.php");
    } else {
        echo "Error adding property.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Property</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <h2>Add New Property</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Property Title" required>
        <input type="text" name="location" placeholder="Location" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="file" name="image" required>
        <button type="submit">Add Property</button>
    </form>
</body>
</html>
