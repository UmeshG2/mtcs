<?php
include 'dbConfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contacts (name, phone, email, message)
            VALUES ('$name', '$phone', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message received. Thank you!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>