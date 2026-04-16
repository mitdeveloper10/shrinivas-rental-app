<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rental_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $price = $_POST['price'];
    $bhk_size = $_POST['bhk_size'];
    
    // Handle House Photos
    $photo_paths = [];
    foreach ($_FILES['house_photos']['tmp_name'] as $key => $tmp_name) {
        $photo_name = basename($_FILES['house_photos']['name'][$key]);
        $target_file = "uploads/houses/" . $photo_name;
        if (move_uploaded_file($tmp_name, $target_file)) {
            $photo_paths[] = $target_file;
        }
    }
    $photos = implode(",", $photo_paths);

    // Handle Aadhar Upload
    $aadhar_path = "uploads/aadhar/" . basename($_FILES['aadhar']['name']);
    move_uploaded_file($_FILES['aadhar']['tmp_name'], $aadhar_path);

    // Insert Data
    $sql = "INSERT INTO properties (full_name, phone, email, address, price, bhk_size, house_photos, aadhar) 
            VALUES ('$full_name', '$phone', '$email', '$address', '$price', '$bhk_size', '$photos', '$aadhar_path')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Property Registered Successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
