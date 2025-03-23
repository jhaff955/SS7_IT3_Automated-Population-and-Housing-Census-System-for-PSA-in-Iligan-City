<?php
require 'connect.php';

$householdNo = isset($_POST['householdNo']) ? $_POST['householdNo'] : '';

if ($householdNo) {
    $stmt = $conn->prepare("SELECT 1 FROM household WHERE Household_ID = ?");
    $stmt->bind_param("i", $householdNo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        // Redirect back to form with error message if household number does not exist
        echo "<script>
            if (confirm('Household number does not exist. Do you want to register a new household?')) {
                window.location.href = 'entry.php';
            } else {
                window.history.back();
            }
              </script>";
        exit();
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $householdNo = $_POST['householdNo'];
    $first_names = $_POST['fname'];
    $middle_names = $_POST['mname'];
    $last_names = $_POST['lname'];
    $birthdates = $_POST['birthdate'];
    $genders = $_POST['gender'];
    $addresses = $_POST['address'];
    $civil_statuses = $_POST['civilStatus'];
    $occupations = $_POST['occupation'];
    $contact_numbers = $_POST['contactNumber'];

    if ($householdNo && $first_names && $last_names && $birthdates && $genders && $addresses && $civil_statuses && $occupations && $contact_numbers) {
        for ($i = 0; $i < count($first_names); $i++) {
            $first_name = $first_names[$i];
            $middle_name = $middle_names[$i];
            $last_name = $last_names[$i];
            $birthdate = $birthdates[$i];
            $gender = $genders[$i];
            $address = $addresses[$i];
            $civil_status = $civil_statuses[$i];
            $occupation = $occupations[$i];
            $contact_number = $contact_numbers[$i];

            $sql = "INSERT INTO members (Household_ID, fname, mname, lname, birthdate, Gender, Address, CivilStatus, Occupation, ContactNumber)
                    VALUES ('$householdNo', '$first_name', '$middle_name', '$last_name', '$birthdate', '$gender', '$address', '$civil_status', '$occupation', '$contact_number')";

            if (!$conn->query($sql)) {
                $error = "Error: " . $sql . "<br>" . $conn->error;
                header("Location: form.php?householdNo=$householdNo&members=" . count($first_names) . "&error=" . urlencode($error));
                exit();
            }
        }

        $conn->close();
        echo "<script>alert('Successfully added the data'); window.location.href='homepage.php';</script>";
        exit();
    } else {
        $error = "Please fill in all fields.";
        header("Location: form.php?householdNo=$householdNo&error=" . urlencode($error));
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
