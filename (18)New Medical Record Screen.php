<?php
    include 'connect.php';

    if(isset($_POST['create_record'])) {
        $recordID = $_POST['record_id'];
        $name = $_POST['elderly_name'];
        $medical_record = $_POST['familyMedicalHistory'];
        $last_checkup = $_POST['lastCheckup'];
        $doctor_note = $_POST['doctorsNotes'];
        $vital_sign = $_POST['vitalSigns'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $observation = $_POST['observation'];

        $checkID = "SELECT * From medical_record_data where record_id='$recordID'";
        $idResult = $conn->query($checkID);

        if($idResult->num_rows>0){
            echo "<script>
                    alert('Record ID Already Exist!');
                    window.history.back();
                </script>";
        }
        else{
            $insertQuery="INSERT INTO medical_record_data(record_id, elderly_name, family_medical_history, date, doctor_note, vital_sign, height, weight, observation)
                            VALUES ('$recordID', '$name', '$medical_record', '$last_checkup', '$doctor_note', '$vital_sign', '$height', '$weight', '$observation')";
                if($conn->query($insertQuery)==TRUE){
                    echo "<script>
                            alert('Record Create Successful!');
                            window.location.href = '(17)Medical Record Data Screen.html';
                        </script>";
                }
                else{
                    echo "<script>
                            alert('Error: " . $conn->error . "');
                            window.history.back();
                        </script>";
                }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Record System</title>
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
        .form-section {
            margin-bottom: 20px;
        }
        .form-section h2 {
            margin-bottom: 10px;
        }
        .form-section input, .form-section textarea {
            width: 95%;
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
        .button-container button[type="submit"] {
            background-color: #28a745;
            color: #fff;
        }
        .button-container button[type="submit"]:hover {
            background-color: #218838;
        }
        .button-container button[type="button"] {
            background-color: #007bff;
            color: #fff;
        }
        .button-container button[type="button"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <h2>New Medical Record</h2>
            <form action="" method="post">
                <h3>Record ID</h3>

                <label for="record_id">ID:</label><br>
                <input type="text" id="record_id" name="record_id" required inputmode="numeric" pattern="\d*">

                <h3>Elderly Name</h3>

                <label for="elderly_name">Name:</label><br>
                <input type="text" id="elderly_name" name="elderly_name" required>

                <h3>Medical History</h3>

                <label for="familyMedicalHistory">Family Medical History:</label>
                <input type="text" id="familyMedicalHistory" name="familyMedicalHistory" required>

                <h3>Recent Medical Visit</h3>

                <label for="lastCheckup">Date for last Checkup:</label>
                <input type="date" id="lastCheckup" name="lastCheckup" required>

                <label for="doctorsNotes">Doctor's Notes:</label>
                <textarea id="doctorsNotes" name="doctorsNotes" required></textarea>

                <h3>Current Health Status</h3>

                <label for="vitalSigns">Vital Signs:</label>
                <input type="text" id="vitalSigns" name="vitalSigns" required>
                
                <label for="height">Height:</label>
                <input type="text" id="height" name="height" required>

                <label for="weight">Weight:</label>
                <input type="text" id="weight" name="weight" required>

                <h3>Consultant Notes</h3>

                <label for="observation">Recent Observation:</label>
                <textarea id="observation" name="observation" required></textarea>

                <div class="button-container">
                    <a href="(17)Medical Record Data Screen.html"><button type="button">Back</button></a>
                    <button type="submit" name="create_record">Create</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>