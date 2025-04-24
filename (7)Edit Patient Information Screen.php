<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Information - Elderly Care Companion</title>
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
            display: flex;
            flex-direction: column;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            width: 700px; /* Increased width to accommodate the image */
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center; /* Center the title */
        }
        .content {
            display: flex;
            gap: 20px; /* Space between form and image */
        }
        .form-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Push buttons to the bottom */
            height: 100%; /* Ensure form section takes full height */
        }
        .image-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align image to the top */
        }
        input[type="text"], input[type="number"], input[type="tel"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        select {
            width: 100%; /* Adjusted width */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-actions {
            margin-top: 20px;
            display: flex;
            justify-content: space-between; /* Space between Back and Save buttons */
            align-items: flex-end; /* Align buttons to the bottom */
        }
        .form-actions a, .form-actions input[type="submit"] {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .form-actions a.back {
            background-color: #6c757d;
        }
        .form-actions a:hover, .form-actions input[type="submit"]:hover {
            opacity: 0.8;
        }
        .patient-image {
            max-width: 200px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            flex-wrap: nowrap;
        }

        .form-group label {
            flex: 0 0 150px;  /* Fixed width for labels */
            margin-right: 10px;
            text-align: left;
        }

        .form-group input,
        .form-group select {
            flex: 1;  /* Input and select fields take the remaining space */
            width: 100%;
            padding: 10px;
            margin: 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Centered Title -->
        <h1>Edit Patient Information</h1>

        <?php
            include 'connect.php';
            if(isset($_GET['patient_id'])){
                $patient_id = urldecode($_GET['patient_id']);
                $sql = "SELECT * FROM elderly WHERE Elderly_ID = '$patient_id'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $patientData = $result->fetch_assoc();
                }
            }
        ?>

        <!-- Content Section -->
        <div class="content">
            <!-- Form Section -->
            <div class="form-section">
                <form action="database_function.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="patient-id">Elderly's ID:</label>
                        <input type="text" id="patient-id" placeholder="Patient's ID" name="patient-id" value="<?php echo $patientData['Elderly_ID']; ?>" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="patient-name">Elderly's Name:</label>
                        <input type="text" id="patient-name" placeholder="Patient's Name" name="patient-name" value="<?php echo $patientData['Elderly_Name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="patient-age">Elderly's Age:</label>
                        <input type="number" id="patient-age" placeholder="Patient's Age" name="patient-age" value="<?php echo $patientData['Elderly_Age']; ?>" required min="50">
                    </div>

                    <div class="form-group">
                        <label for="patient-contact">Elderly's Contact:</label>
                        <input type="tel" id="patient-contact" placeholder="Patient's Contact" name="patient-contact" value="<?php echo $patientData['Elderly_Contact']; ?>" required inputmode="numeric" pattern="\d*">
                    </div>

                    <div class="form-group">
                        <label for="patient-guardian">Elderly's Guardian:</label>
                        <input type="text" id="patient-guardian" placeholder="Patient's Guardian Name" name="patient-guardian" value="<?php echo $patientData['Elderly_Guardian']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="guardian-contact">Guardian's Contact:</label>
                        <input type="tel" id="guardian-contact" placeholder="Guardian's Contact" name="guardian-contact" value="<?php echo $patientData['Guardian_Contact']; ?>" required inputmode="numeric" pattern="\d*">
                    </div>

                    <div class="form-group">
                        <label for="patient-status">Elderly's Status:</label>
                        <select name="patient-status" id="patient-status" required>
                            <option value="" disabled selected>Elderly's Status</option>
                            <option value="healthy">Healthy</option>
                            <option value="unhealthy">Unhealthy</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="patient-image">Elderly's Image:</label>
                        <input type="file" id="patient-image" name="patient-image" accept=".jpg,.jpeg,.png" required>
                    </div>

                    <!-- Form Actions (Back and Save buttons) -->
                    <div class="form-actions">
                        <a href="(5)report management screen.html" class="back">Back</a>
                        <input type="submit" name="update_patient" value="Save">
                    </div>
                </form>
            </div>

            <!-- Image Section -->
            <div class="image-section">
                <img src="<?php echo $patientData['Image_File']; ?>" alt="Patient Image" class="patient-image"> 
            </div>
        </div>
    </div>
</body>
</html>