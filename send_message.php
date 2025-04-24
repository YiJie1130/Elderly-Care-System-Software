<?php
// Include your database connection
include 'connect.php';

// Check if a message was sent
if (isset($_POST['message'])) {
    $sender_name = $_POST['name'];
    $message = $_POST['message'];

    // Insert the message into the chat_messages table
    $sql = "INSERT INTO chat (name, message) VALUES ('$sender_name', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>