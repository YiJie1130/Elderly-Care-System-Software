<?php
    session_start();
    include 'connect.php';

    if (isset($_GET['patient_id'])) {
        $patient_id = $_GET['patient_id'];

        $sql = "SELECT * FROM medical_record_data WHERE record_id='$patient_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<script>
                alert('Elderly not found!');
                window.location.href = '(23)Elderly Profile Screen.html';
            </script>";
            exit();
        }
    }

    if (isset($_POST['update'])) {
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
                    window.location.href = '(17)Medical Record Data Screen.html';
                </script>";
        } else {
            echo "<script>
                    alert('Error updating record: " . $conn->error . "');
                    window.history.back();
                </script>";
        }
    }

    if (isset($_POST['delete'])) {
        $recordID = $_POST['record_id'];

        // Check if the user exists
        $checkID = "SELECT * FROM medical_record_data WHERE record_id = '$recordID'";
        $result = $conn->query($checkID);

        if ($result->num_rows > 0) {
            $deleteQuery = "DELETE FROM medical_record_data WHERE record_id = '$recordID'";
            if ($conn->query($deleteQuery) === TRUE) {
                echo "<script>
                        alert('Record deleted successfully!');
                        window.location.href = '(9)Manage User Account Screen.html';
                    </script>";
            } else {
                echo "<script>
                        alert('Error deleting record: " . $conn->error . "');
                        window.history.back();
                    </script>";
            }
        } else {
            echo "<script>
                    alert('ID does not exist!');
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
    <title>Update Medical Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .form-section {
            margin-bottom: 20px;
        }
        .form-section h2 {
            margin-bottom: 10px;
        }
        .form-section input, .form-section textarea {
            width: 98%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-section textarea {
            height: 100px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button-container button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .button-container button[type="button"] {
            background-color: #007bff;
            color: #fff;
        }
        .button-container button[type="button"]:hover {
            background-color: #0056b3;
        }
        .button-container button[type="submit"] {
            background-color: #28a745;
            color: #fff;
        }
        .button-container button[type="submit"]:hover {
            background-color: #218838;
        }
        .button-container button.delete {
            background-color: #dc3545;
            color: #fff;
        }
        .button-container button.delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <h1><?php echo $row['elderly_name']; ?>'s Medical Record</h1>
            <form action="" method="post">
                <h3>Record ID</h3>

                <label for="record_id">ID:</label><br>
                <input type="text" id="record_id" name="record_id" value="<?php echo $row['record_id']; ?>" readonly>

                <h3>Elderly Name</h3>

                <label for="elderly_name">Name:</label><br>
                <input type="text" id="elderly_name" name="elderly_name" value="<?php echo $row['elderly_name']; ?>" readonly>

                <h3>Medical History</h3>

                <label for="familyMedicalHistory">Family Medical History:</label>
                <input type="text" id="familyMedicalHistory" name="familyMedicalHistory" value="<?php echo $row['family_medical_history']; ?>" required>

                <h3>Recent Medical Visit</h3>

                <label for="lastCheckup">Date for last Checkup:</label>
                <input type="date" id="lastCheckup" name="lastCheckup" value="<?php echo $row['date']; ?>" required>

                <label for="doctorsNotes">Doctor's Notes:</label>
                <textarea id="doctorsNotes" name="doctorsNotes" required><?php echo $row['doctor_note']; ?></textarea>

                <h3>Current Health Status</h3>

                <label for="vitalSigns">Vital Signs:</label>
                <input type="text" id="vitalSigns" name="vitalSigns" value="<?php echo $row['vital_sign']; ?>" required>
                
                <label for="height">Height:</label>
                <input type="text" id="height" name="height" value="<?php echo $row['height']; ?>" required>

                <label for="weight">Weight:</label>
                <input type="text" id="weight" name="weight" value="<?php echo $row['weight']; ?>" required>

                <h3>Consultant Notes</h3>

                <label for="observation">Recent Observation:</label>
                <textarea id="observation" name="observation" required><?php echo $row['observation']; ?></textarea>

                <div class="button-container">
                    <a href="(17)Medical Record Data Screen.html"><button type="button">Back</button></a>
                    <button type="button" name="delete" class="delete">Delete</button>
                    <button type="submit" name="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>