<?php
include 'db.php';

// მონაცემების მისაღებად POST იყენებთ
// მაგალითად: name, email, password
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // ჰეში

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if($stmt->execute()){
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Please provide name, email, and password.";
}

$conn->close();
?>
