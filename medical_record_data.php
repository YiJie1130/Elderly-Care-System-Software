<?php
    include 'connect.php';

    if (isset($_POST['search_patient'])) {
        $searchQuery = $_POST['search_patient_id'];

        $sql = "SELECT * FROM elderly WHERE Elderly_ID LIKE '%$searchQuery%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $patientData = $result->fetch_assoc();
            echo "<img src='" . ($patientData['Image_File'] ?? 'placeholder.jpg') . "' alt='Elderly Image' class='patient-image'> 

                    <div class='patient-details'>
                        <p><strong>Elderly ID:</strong> " . $patientData['Elderly_ID'] . "</p>
                        <p><strong>Elderly Name:</strong> " . $patientData['Elderly_Name'] . "</p>
                        <p><strong>Age:</strong> " . $patientData['Elderly_Age'] . "</p>
                        <p><strong>Contact:</strong> " . $patientData['Elderly_Contact'] . "</p>
                        <p><strong>Guardian:</strong> " . $patientData['Elderly_Guardian'] . "</p>
                        <p><strong>Guardian Contact:</strong> " . $patientData['Guardian_Contact'] . "</p>
                        <p><strong>Elderly's Status:</strong> " . $patientData['Healthy_Status'] . "</p>
                    </div>";
        } else {
            echo json_encode(['error' => 'No Elderly Found!']);
        }
    }

    ob_end_flush();
?>