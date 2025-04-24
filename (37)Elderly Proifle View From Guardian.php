<?php
    session_start();
    include 'connect.php';

    $userID = $_SESSION['id'];
    $sql = "SELECT * FROM elderly WHERE Elderly_ID='$userID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>
                alert('Elderly not found!');
                window.location.href = '(36)Elderly Profile Management Screen.html';
            </script>";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile - Elderly Care Companion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('background.jpg'); /* Replace with your image file name */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(128, 128, 128, 0.5); /* Grey color with 50% opacity */
        }
        .container {
            text-align: left;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            width: 400px;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info p {
            margin: 10px 0;
            font-size: 16px;
        }
        .profile-info p strong {
            color: #007bff;
        }
        .back-link {
            text-align: center;
        }
        .back-link a {
            color: #007bff;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Profile Title -->
        <h1>Elderly's Profile</h1>

        <!-- Personal Information -->
        <div class="profile-info">
            <p><strong>Elderly ID:</strong> <?php echo $row['Elderly_ID']; ?> </p>
            <p><strong>Elderly Name:</strong> <?php echo $row['Elderly_Name']; ?> </p>
            <p><strong>Elderly Age:</strong> <?php echo $row['Elderly_Age']; ?> </p>
            <p><strong>Elderly Contact:</strong> <?php echo $row['Elderly_Contact']; ?> </p>
            <p><strong>Elderly's Guardian:</strong> <?php echo $row['Elderly_Guardian']; ?> </p>
            <p><strong>Guardian Contact:</strong> <?php echo $row['Guardian_Contact']; ?> </p>
            <p><strong>Healthy Status:</strong> <?php echo $row['Healthy_Status']; ?> </p>
        </div>

        <!-- Back Link -->
        <div class="back-link">
            <a href="(36)Elderly Profile Management Screen.html">Back</a>
        </div>
    </div>
</body>
</html>