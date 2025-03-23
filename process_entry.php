<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$name = isset($_SESSION['Name']) ? $_SESSION['Name'] : 'Guest';
$id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
?>

<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $householdNo = $_POST['householdNo'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $income = $_POST['income'];
    $members = $_POST['members'];
    $housingType = $_POST['housingType'];
    $enumeratorId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

    if ($householdNo && $name && $age && $gender && $address && $income && $members && $housingType) {
        $sql = "INSERT INTO household (Household_ID, Head_name, Address, Number_of_Members, Housing_Type, Income_Level, Age)
                VALUES ('$householdNo', '$name', '$address', '$members', '$housingType', '$income', '$age')";

        if ($conn->query($sql) === TRUE) {
            $dateCollected = date('Y-m-d');
            $sql2 = "INSERT INTO census_record (User_ID, Household_ID, Date_Collected)
                     VALUES ('$enumeratorId', '$householdNo', '$dateCollected')";

            if ($conn->query($sql2) === TRUE) {
                echo "<script>alert('New record created successfully'); window.location.href='form.php?householdNo=$householdNo&members=$members';</script>";
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill in all fields.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
