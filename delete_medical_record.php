<?php
include 'connect.php';

    if (isset($_GET['patient_id'])) {
        $patient_id = $_GET['patient_id'];

        // Sanitize input (important!)
        $patient_id = mysqli_real_escape_string($conn, $patient_id);

        $deleteQuery = "DELETE FROM elderly WHERE Elderly_ID = '$patient_id'";

        if ($conn->query($deleteQuery) === TRUE) {
            echo "<script>
                    alert('Medical record deleted successfully!');
                    window.location.href = '(17)Medical Record Data Screen.html';
                </script>";
        } else {
            echo "<script>
                    alert('Error deleting elderly record: " . $conn->error . "');
                    window.history.back(); 
                </script>";
        }
    } 
?>