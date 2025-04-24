<?php
    include 'connect.php';

    if(isset($_POST['register'])) {
        $UserID = $_POST['id'];
        $Username = $_POST['username'];
        $Password = $_POST['password'];
        $Age = $_POST['age'];
        $Gender = $_POST['gender'];
        $Email = $_POST['email'];
        $Address = $_POST['address'];
        $Phone = $_POST['phone'];
        $Role = $_POST['role'];

        $checkID = "SELECT * From user where User_ID='$UserID'";
        $idResult = $conn->query($checkID);

        if($idResult->num_rows>0){
            echo "<script>
                    alert('User ID Already Exist!');
                    window.history.back();
                </script>";
        }
        else{
            $insertQuery="INSERT INTO user(User_ID, Username, Password, Age, Gender, Email, Address, Phone, Role)
                            VALUES ('$UserID', '$Username', '$Password', '$Age', '$Gender', '$Email', '$Address', '$Phone', '$Role')";
                if($conn->query($insertQuery)==TRUE){
                    echo "<script>
                            alert('Registration Successful! Please login.');
                            window.location.href = '(2)Elderly Care Companion with Emergency Alert System Login Screen.html';
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

    if(isset($_POST['login'])) {
        $userID = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $nameSql = "SELECT * FROM user WHERE Username='$username'";
        $nameResult = $conn->query($nameSql);

        $idSql = "SELECT * FROM user WHERE User_ID='$userID'";
        $idResult = $conn->query($idSql);

        if($idResult->num_rows > 0) {
            if($nameResult->num_rows > 0) {
                $row = $nameResult->fetch_assoc();
                if($row['Password'] === $password) { 
                    session_start();
                    $_SESSION['id'] = $row['User_ID'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['role'] = $row['Role'];

                    // Prepare role-based redirection
                    $redirectPage = "";
                    $roleMessage = "";

                    switch ($row['Role']) {
                        case 'elderly':
                            $redirectPage = "(21)Elderly Dashboard.html";
                            $roleMessage = "Welcome Elderly User!";
                            break;
                        case 'admin':
                            $redirectPage = "(4)Administrator Home Screen.html";
                            $roleMessage = "Welcome Admin!";
                            break;
                        case 'consultant':
                            $redirectPage = "(14)Consultant Dashboard.html";
                            $roleMessage = "Welcome Consultant!";
                            break;
                        case 'guardian':
                            $redirectPage = "(29)Guardian Dashboard.html";
                            $roleMessage = "Welcome Guardian!";
                            break;
                        default:
                            $redirectPage = "(3)Elderly Care Companion with Emergency Alert System Register Screen.html";
                            $roleMessage = "Role not recognized. Redirecting to registration.";
                            break;
                    }

                    // Send JavaScript alert before redirecting
                    echo "<script>
                            alert('$roleMessage');
                            window.location.href = '$redirectPage';
                        </script>";
                    exit();
                } else {
                    echo "<script>alert('Incorrect Password'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Incorrect Username'); window.history.back();</script>";
            }
        }
        else{
            echo "<script>alert('Incorrect User ID'); window.history.back();</script>";
        }
    }

    if(isset($_POST['create_user'])) {
        $UserID = $_POST['id'];
        $Username = $_POST['username'];
        $Password = $_POST['password'];
        $Age = $_POST['age'];
        $Gender = $_POST['gender'];
        $Email = $_POST['email'];
        $Address = $_POST['address'];
        $Phone = $_POST['phone'];
        $Role = $_POST['role'];

        $checkID = "SELECT * From user where User_ID='$UserID'";
        $idResult = $conn->query($checkID);

        if($idResult->num_rows>0){
            echo "<script>
                    alert('User ID Already Exist!');
                    window.history.back();
                </script>";
        }
        else{
            $insertQuery="INSERT INTO user(User_ID, Username, Password, Age, Gender, Email, Address, Phone, Role)
                            VALUES ('$UserID', '$Username', '$Password', '$Age', '$Gender', '$Email', '$Address', '$Phone', '$Role')";
                if($conn->query($insertQuery)==TRUE){
                    echo "<script>
                            alert('User Create Successful!');
                            window.location.href = '(9)Manage User Account Screen.html';
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

    if (isset($_POST['update_user'])) {
        $userID = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];

        $updateQuery = "UPDATE user SET 
                        User_ID = '$userID',
                        Username = '$username',
                        Password = '$password', 
                        Age = '$age', 
                        Gender = '$gender', 
                        Email = '$email', 
                        Address = '$address', 
                        Phone = '$phone', 
                        Role = '$role' 
                        WHERE User_ID = '$userID'";

        if ($conn->query($updateQuery) === TRUE) {
            echo "<script>
                    alert('User updated successfully!');
                    window.location.href = '(9)Manage User Account Screen.html';
                </script>";
        } else {
            echo "<script>
                    alert('Error updating user: " . $conn->error . "');
                    window.history.back();
                </script>";
        }
    }

    if (isset($_POST['delete_user'])) {
        $userID = $_POST['id'];
        $username = $_POST['username'];

        // Check if the user exists
        $checkUser = "SELECT * FROM user WHERE User_ID = '$userID'";
        $result = $conn->query($checkUser);

        if ($result->num_rows > 0) {
            // Delete the user
            $deleteQuery = "DELETE FROM user WHERE User_ID = '$userID'";
            if ($conn->query($deleteQuery) === TRUE) {
                echo "<script>
                        alert('User deleted successfully!');
                        window.location.href = '(9)Manage User Account Screen.html';
                    </script>";
            } else {
                echo "<script>
                        alert('Error deleting user: " . $conn->error . "');
                        window.history.back();
                    </script>";
            }
        } else {
            echo "<script>
                    alert('User does not exist!');
                    window.history.back();
                </script>";
        }
    }

    if (isset($_POST['create_patient'])) {
        $patient_id = $_POST["patient-id"];
        $patient_name = $_POST["patient-name"];
        $patient_age = $_POST["patient-age"];
        $patient_contact = $_POST["patient-contact"];
        $patient_guardian = $_POST["patient-guardian"];
        $guardian_contact = $_POST["guardian-contact"];
        $patient_status = $_POST["patient-status"];
        $patient_image = $_FILES["patient-image"];

        $checkPatientQuery = "SELECT * FROM elderly WHERE Elderly_ID = '$patient_id'";
        $patientResult = $conn->query($checkPatientQuery);

        if ($patientResult->num_rows > 0) {
            echo "<script>
                    alert('Elderly's ID Already Exists!');
                    window.history.back();
                </script>";
        }
        else{
            $imageFileName = $patient_image['name'];
            $imageFileError = $patient_image['error'];
            $imageFileTemp = $patient_image['tmp_name'];

            $fileName_separate = explode('.', $imageFileName);
            $imageExtension = strtolower(end($fileName_separate));

            $validImageExtension = array('jpg', 'jpeg', 'png');
            if(in_array($imageExtension, $validImageExtension)) {
                $upload_image = 'image/'.$imageFileName;
                move_uploaded_file($imageFileTemp, $upload_image);
                $insertQuery="INSERT INTO elderly(Elderly_ID, Elderly_Name, Elderly_Age, Elderly_Contact, Elderly_Guardian, Guardian_Contact, Healthy_Status, Image_File)
                                VALUES ('$patient_id', '$patient_name', '$patient_age', '$patient_contact', '$patient_guardian', '$guardian_contact', '$patient_status', '$upload_image')";
                $result = mysqli_query($conn, $insertQuery);
                if($result) {
                    echo "<script>
                            alert('Elderly Created Successfully!'); 
                            window.location.href = '(5)report management screen.html'
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
    }

    if (isset($_POST['search_patient'])) {
        $searchQuery = $_POST['search_patient_id'];

        $sql = "SELECT * FROM elderly WHERE Elderly_ID LIKE '%$searchQuery%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $patientData = $result->fetch_assoc();
            echo "<div class='patient-details'>
                    <img src='" . ($patientData['Image_File'] ?? 'placeholder.jpg') . "' alt='Elderly Image'>
                    <p><strong>Elderly ID:</strong> " . $patientData['Elderly_ID'] . "</p>
                    <p><strong>Elderly Name:</strong> " . $patientData['Elderly_Name'] . "</p>
                    <p><strong>Age:</strong> " . $patientData['Elderly_Age'] . "</p>
                    <p><strong>Contact:</strong> " . $patientData['Elderly_Contact'] . "</p>
                    <p><strong>Guardian:</strong> " . $patientData['Elderly_Guardian'] . "</p>
                    <p><strong>Guardian Contact:</strong> " . $patientData['Guardian_Contact'] . "</p>
                    <p><strong>Elderly's Status:</strong> " . $patientData['Healthy_Status'] . "</p>
                    <div class='form-actions'>
                        <a href='(7)Edit Patient Information Screen.php?patient_id=" . urlencode($patientData['Elderly_ID']) . "' class='edit'>Edit</a>
                        <a href='delete_patient.php?patient_id=" . urlencode($patientData['Elderly_ID']) . "' class='delete' onclick='return confirm(\"Are you sure you want to delete this elderly record?\");'>Delete</a>
                    </div>
                </div>";
        } else {
            echo json_encode(['error' => 'No Elderly Found!']);
        }
    }

    if (isset($_POST['update_patient'])) {
            $patient_id = $_POST['patient-id'];
            $patient_name = $_POST['patient-name'];
            $patient_age = $_POST['patient-age'];
            $patient_contact = $_POST['patient-contact'];
            $patient_guardian = $_POST['patient-guardian'];
            $guardian_contact = $_POST['guardian-contact'];
            $patient_status = $_POST['patient-status'];
            $patient_image = $_FILES['patient-image'];

            // If a new image is uploaded, update it, otherwise keep the old one
            if ($patient_image['error'] == 0) {
                $imageFileName = $patient_image['name'];
                $imageFileTemp = $patient_image['tmp_name'];
                $upload_image = 'image/' . $imageFileName;
                move_uploaded_file($imageFileTemp, $upload_image);
                $updateQuery = "UPDATE elderly SET 
                                Elderly_ID = '$patient_id', 
                                Elderly_Name = '$patient_name', 
                                Elderly_Age = '$patient_age', 
                                Elderly_Contact = '$patient_contact',
                                Elderly_Guardian = '$patient_guardian', 
                                Guardian_Contact = '$guardian_contact', 
                                Healthy_Status = '$patient_status',
                                Image_File = '$upload_image'
                                WHERE Elderly_ID = '$patient_id'";
            } else {
                $updateQuery = "UPDATE elderly SET 
                                Elderly_ID = '$patient_id', 
                                Elderly_Name = '$patient_name', 
                                Elderly_Age = '$patient_age', 
                                Elderly_Contact = '$patient_contact',
                                Elderly_Guardian = '$patient_guardian', 
                                Guardian_Contact = '$guardian_contact', 
                                Healthy_Status = '$patient_status'
                                WHERE Elderly_ID = '$patient_id'";
            }

            if ($conn->query($updateQuery) === TRUE) {
                echo "<script>
                        alert('Elderly Information Updated Successfully!'); 
                        window.location.href = '(5)report management screen.html';
                    </script>";
            } else {
                echo "<script>
                        alert('Error: " . $conn->error . "'); 
                        window.history.back();
                    </script>";
            }
        }

    ob_end_flush(); // Send the output buffer to the browser
?>