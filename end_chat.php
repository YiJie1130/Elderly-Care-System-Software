<?php
// Include database connection
include 'connect.php';

// SQL query to delete all messages from the chat table
$sql = "DELETE FROM chat";

// Execute the query and check if it was successful
if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error ending chat: " . $conn->error;
}

// Close the database connection
$conn->close();
?>