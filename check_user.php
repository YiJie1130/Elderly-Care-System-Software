<?php
    include 'connect.php';

    $userID = $_POST['id'];

    $checkID = "SELECT * FROM user WHERE User_ID='$userID'";
    $result = $conn->query($checkID);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode(['exists' => true, 'user' => $user]);
    } else {
        echo json_encode(['exists' => false]);
    }

    $conn->close();
?>