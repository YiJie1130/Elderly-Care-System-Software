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

    if (isset($_POST['update_profile'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $elderly_contact = $_POST['elderly_contact'];
        $guardian = $_POST['guardian'];
        $guardian_contact = $_POST['guardian_contact'];
        $healthy_status = $_POST['status'];

        // Prepare the SQL UPDATE query
        $updateQuery = "UPDATE elderly SET 
                        Elderly_ID = '$id',
                        Elderly_Name = '$name', 
                        Elderly_Age = '$age', 
                        Elderly_Contact = '$elderly_contact', 
                        Elderly_Guardian = '$guardian', 
                        Guardian_Contact = '$guardian_contact', 
                        Healthy_Status = '$healthy_status' 
                        WHERE Elderly_ID = '$id'";

        // Execute the query
        if ($conn->query($updateQuery) === TRUE) {
            echo "<script>
                    alert('Profile updated successfully!');
                    window.location.href = '(36)Elderly Profile Management Screen.html';
                </script>";
        } else {
            echo "<script>
                    alert('Error updating profile: " . $conn->error . "');
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
    <title>Update Profile - Elderly Care Companion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('background.jpg');
            /* Replace with your image file name */
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
            background-color: rgba(128, 128, 128, 0.5);
            /* Grey color with 50% opacity */
        }

        .container {
            text-align: left;
            background-color: rgba(255, 255, 255, 0.8);
            /* Semi-transparent white background */
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

        select {
            width: 100%; /* Adjusted width to make fields shorter */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }

        .profile-info input {
            width: calc(100% - 20px);
            /* Adjusted width to avoid touching the sides */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .button-container button.back {
            background-color: #6c757d;
            /* Grey color for back button */
            color: #fff;
        }

        .button-container button.back:hover {
            background-color: #5a6268;
            /* Darker grey on hover */
        }

        .button-container button.save {
            background-color: #28a745;
            /* Green color for save button */
            color: #fff;
        }

        .button-container button.save:hover {
            background-color: #218838;
            /* Darker green on hover */
        }

        /* SOS Button */
        .sos-button {
            position: absolute;
            top: 20px;
            /* Position at the top */
            left: 20px;
            /* Position at the left */
            width: 60px;
            height: 60px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sos-button:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Profile Title -->
        <h1>Update Profile</h1>

        <!-- Editable Profile Information -->
        <form action="" method="post">
            <div class="profile-info">
                <label for="id">Elderly ID:</label>
                <input type="text" id="id" name="id" value="<?php echo $row['Elderly_ID'];?>" readonly>

                <label for="name">Elderly Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['Elderly_Name'];?>" required>

                <label for="age">Elderly Age:</label>
                <input type="number" id="age" name="age" value="<?php echo $row['Elderly_Age'];?>" required min="50">

                <label for="elderly_contact">Elderly Contact:</label>
                <input type="tel" id="elderly_contact" name="elderly_contact" value="<?php echo $row['Elderly_Contact'];?>" required inputmode="numeric" pattern="\d*">

                <label for="guardian">Elderly's Guardian:</label>
                <input type="text" id="guardian" name="guardian" value="<?php echo $row['Elderly_Guardian'];?>" required>

                <label for="guardian_contact">Guardian Contact:</label>
                <input type="tel" id="guardian_contact" name="guardian_contact" value="<?php echo $row['Guardian_Contact'];?>" required inputmode="numeric" pattern="\d*">

                <label for="status">Healthy Status:</label>
                <select id="status" name="status" required>
                    <option value="healthy" <?php echo ($row['Healthy_Status']=='Healthy' ) ? 'selected' : '' ; ?>>Healthy</option>
                    <option value="unhealthy" <?php echo ($row['Healthy_Status']=='Unhealthy' ) ? 'selected' : '' ; ?>>Unhealthy</option>
                </select>
            </div>

            <!-- Back and Save Buttons -->
            <div class="button-container">
                <button type="button" class="back" onclick="goBack()">Back</button>
                <button type="submit" class="save" name="update_profile">Save</button>
            </div>
        </form>
    </div>

    <script>
        // Function to go back
        function goBack() {
            const confirmBack = confirm('Going back...'); // Replace with actual back navigation logic

            if (confirmBack) {
                window.location.href = '(36)Elderly Profile Management Screen.html';
            }
        }
    </script>
</body>

</html>