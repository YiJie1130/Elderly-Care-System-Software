<?php
// Include your database connection
include 'connect.php';

// Retrieve all chat messages
$sql = "SELECT * FROM chat ORDER BY date ASC";
$result = $conn->query($sql);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
?>