<?php
    session_start();
    include 'connect.php';

    $userID = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE User_ID='$userID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>
            alert('User not found!');
            window.location.href = '(23)Elderly Profile Screen.html';
        </script>";
        exit();
    }

    if (isset($_POST['update_profile'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        // Prepare the SQL UPDATE query
        $updateQuery = "UPDATE user SET 
                        User_ID = '$id',
                        Username = '$name', 
                        Age = '$age', 
                        Gender = '$gender', 
                        Email = '$email', 
                        Address = '$address', 
                        Phone = '$phone' 
                        WHERE User_ID = '$id'";

        // Execute the query
        if ($conn->query($updateQuery) === TRUE) {
            echo "<script>
                    alert('Profile updated successfully!');
                    window.location.href = '(31)Guardian Profile Management Screen.html';
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
    <title>Update Guardian Profile - Elderly Care Companion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
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
            width: calc(100% - 20px); /* Adjusted width to avoid touching the sides */
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
            background-color: #6c757d; /* Grey color for back button */
            color: #fff;
        }
        .button-container button.back:hover {
            background-color: #5a6268; /* Darker grey on hover */
        }
        .button-container button.save {
            background-color: #28a745; /* Green color for save button */
            color: #fff;
        }
        .button-container button.save:hover {
            background-color: #218838; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Profile Title -->
        <h1>Update Guardian Profile</h1>

        <!-- Editable Profile Information -->
        <form action="" method="post">
            <div class="profile-info">
                <label for="id">Guardian ID:</label>
                <input type="text" id="id" name="id" value="<?php echo $row['User_ID'];?>" readonly>

                <label for="name">Guardian Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['Username'];?>" required>
                
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?php echo $row['Age'];?>" min="1" required>
                
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male" <?php echo ($row['Gender']=='Male' ) ? 'selected' : '' ; ?>>Male</option>
                    <option value="Female" <?php echo ($row['Gender']=='Female' ) ? 'selected' : '' ; ?>>Female</option>
                </select>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['Email'];?>" required>
                
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $row['Address'];?>" required>
                
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $row['Phone'];?>" required inputmode="numeric" pattern="\d*">
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
            alert('Going back...'); // Replace with actual back navigation logic
            window.location.href = "(31)Guardian Profile Management Screen.html";
        }
    </script>
</body>
</html>