<?php
    session_start();
    include 'connect.php';

    $recordID = $_SESSION['id'];
    $sql = "SELECT * FROM medical_record_data WHERE record_id='$recordID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>
                alert('Record not found!');
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
    <title>Elderly Medical Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }
        .container {
            text-align: left;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            color: #555;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .section p {
            margin: 5px 0;
            font-size: 16px;
        }
        .section p strong {
            color: #007bff;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
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
        <h1>Elderly Medical Record</h1>

        <div class="section">
            <h2>Record ID</h2>
            <p><strong>ID:</strong> <?php echo $row['record_id']; ?> </p>
        </div>

        <div class="section">
            <h2>Elderly Name</h2>
            <p><strong>Name:</strong> <?php echo $row['elderly_name']; ?> </p>
        </div>

        <!-- Medical History Section -->
        <div class="section">
            <h2>Medical History</h2>
            <p><strong>Family Medical History:</strong> <?php echo $row['family_medical_history']; ?> </p>
        </div>

        <!-- Recent Medical Visit Section -->
        <div class="section">
            <h2>Recent Medical Visit</h2>
            <p><strong>Date for last Checkup:</strong> <?php echo $row['date']; ?> </p>
            <p><strong>Doctor's Notes:</strong> <?php echo $row['doctor_note']; ?> </p>
        </div>

        <!-- Current Health Status Section -->
        <div class="section">
            <h2>Current Health Status</h2>
            <p><strong>Vital Signs:</strong> <?php echo $row['vital_sign']; ?> </p>
            <p><strong>Height:</strong> <?php echo $row['height']; ?> </p>
            <p><strong>Weight:</strong> <?php echo $row['weight']; ?> </p>
        </div>

        <!-- Consultant Notes Section -->
        <div class="section">
            <h2>Consultant Notes</h2>
            <p><strong>Recent Observations:</strong> <?php echo $row['observation']; ?> </p>
        </div>

        <!-- Back Link -->
        <div class="back-link">
            <a href="(42)Elderly Medical Record Management Screen.html">Back</a>
        </div>
    </div>
</body>
</html>