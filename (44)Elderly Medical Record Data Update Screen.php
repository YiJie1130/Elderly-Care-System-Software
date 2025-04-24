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

    if (isset($_POST['save'])) {
        $recordID = $_POST['record_id'];
        $name = $_POST['elderly_name'];
        $medical_record = $_POST['familyMedicalHistory'];
        $last_checkup = $_POST['lastCheckup'];
        $doctor_note = $_POST['doctorsNotes'];
        $vital_sign = $_POST['vitalSigns'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $observation = $_POST['observation'];

        // Prepare the SQL UPDATE query
        $updateQuery = "UPDATE medical_record_data SET 
                        record_id = '$recordID',
                        elderly_name = '$name', 
                        family_medical_history = '$medical_record', 
                        date = '$last_checkup', 
                        doctor_note = '$doctor_note', 
                        vital_sign = '$vital_sign', 
                        height = '$height', 
                        weight = '$weight', 
                        observation = '$observation' 
                        WHERE record_id = '$recordID'";

        // Execute the query
        if ($conn->query($updateQuery) === TRUE) {
            echo "<script>
                    alert('Record updated successfully!');
                    window.location.href = '(42)Elderly Medical Record Management Screen.html';
                </script>";
        } else {
            echo "<script>
                    alert('Error updating record: " . $conn->error . "');
                    window.history.back();
                </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Elderly Medical Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
        .section label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }
        .section input,
        .section textarea {
            width: 95%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .section textarea {
            resize: vertical;
            height: 80px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            flex: 1;
            margin: 0 5px;
            text-align: center;
        }
        .button.back {
            background-color: #6c757d;
        }
        .button.save {
            background-color: #28a745;
        }
        .button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Elderly Medical Record</h1>

        <form action="" method="post">
            <div class="section">
                <h2>Record ID</h2>
                <label for="record_id">ID:</label><br>
                <input type="text" id="record_id" name="record_id" value="<?php echo $row['record_id']; ?>" readonly>
            </div>

            <div class="section">
                <h2>Elderly Name</h2>
                <label for="elderly_name">Name:</label><br>
                <input type="text" id="elderly_name" name="elderly_name" value="<?php echo $row['elderly_name']; ?>" readonly>
            </div>

            <!-- Medical History Section -->
            <div class="section">
                <h2>Medical History</h2>
                <label for="familyMedicalHistory">Family Medical History:</label>
                <input type="text" id="familyMedicalHistory" name="familyMedicalHistory" value="<?php echo $row['family_medical_history']; ?>" required>
            </div>

            <!-- Recent Medical Visit Section -->
            <div class="section">
                <h2>Recent Medical Visit</h2>
                <label for="lastCheckup">Date for last Checkup:</label>
                <input type="date" id="lastCheckup" name="lastCheckup" value="<?php echo $row['date']; ?>" required>

                <label for="doctorsNotes">Doctor's Notes:</label>
                <textarea id="doctorsNotes" name="doctorsNotes" required><?php echo $row['doctor_note']; ?></textarea>
            </div>

            <!-- Current Health Status Section -->
            <div class="section">
                <h2>Current Health Status</h2>
                <label for="vitalSigns">Vital Signs:</label>
                <input type="text" id="vitalSigns" name="vitalSigns" value="<?php echo $row['vital_sign']; ?>" required>
                
                <label for="height">Height:</label>
                <input type="text" id="height" name="height" value="<?php echo $row['height']; ?>" required>

                <label for="weight">Weight:</label>
                <input type="text" id="weight" name="weight" value="<?php echo $row['weight']; ?>" required>
            </div>

            <!-- Consultant Notes Section -->
            <div class="section">
                <h2>Consultant Notes</h2>
                <label for="observation">Recent Observation:</label>
                <textarea id="observation" name="observation" required><?php echo $row['observation']; ?></textarea>
            </div>

            <!-- Button Container -->
            <div class="button-container">
                <button class="button back" onclick="window.location.href='(42)Elderly Medical Record Management Screen.html'">Back</button>
                <button class="button save" name="save">Save</button>
            </div>
        </form>
    </div>
</body>
</html>