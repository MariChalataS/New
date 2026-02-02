<?php
include 'db.php';

// მონაცემების მიღება POST-ით: email, password
if(isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if(password_verify($password, $hashed_password)){
            echo "Login successful!";
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
} else {
    echo "Please provide email and password.";
}

$conn->close();
?>
