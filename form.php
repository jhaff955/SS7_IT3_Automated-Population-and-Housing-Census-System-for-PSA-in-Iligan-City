<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$name = isset($_SESSION['Name']) ? $_SESSION['Name'] : 'Guest';
$id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSA Census Form</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 30px;
            background-color: #004d99;
            color: white;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: calc(100% - 12px); /* Adjust for padding and border */
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }


        .back-button {
            position: absolute;
            margin: 20px;
            top: 20px;
            right: 20px;
            background: dodgerblue;
            color: white;
            padding: 10px 10px;
            text-decoration: none;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <a href="homepage.php" class="back-button">Back</a>

    <h1>PSA Census Form</h1>

    <?php
    $householdNo = isset($_GET['householdNo']) ? $_GET['householdNo'] : '';
    $members = isset($_GET['members']) ? intval($_GET['members']) : 1;
    $error = isset($_GET['error']) ? $_GET['error'] : '';
    ?>

    <form id="censusForm" method="post" action="process_form.php">
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <label for="householdNo">Household Number:</label>
        <input type="text" id="householdNo" name="householdNo" value="<?php echo htmlspecialchars($householdNo); ?>" <?php echo $householdNo ? 'readonly' : ''; ?>>

        <?php for ($i = 1; $i <= $members; $i++): ?>
            <h3>Member <?php echo $i; ?></h3>
            <label for="fname_<?php echo $i; ?>">First Name:</label>
            <input type="text" id="fname_<?php echo $i; ?>" name="fname[]" required>

            <label for="mname_<?php echo $i; ?>">Middle Name:</label>
            <input type="text" id="mname_<?php echo $i; ?>" name="mname[]">

            <label for="lname_<?php echo $i; ?>">Last Name:</label>
            <input type="text" id="lname_<?php echo $i; ?>" name="lname[]" required>

            <label for="birthdate_<?php echo $i; ?>">Birthdate:</label>
            <input type="date" id="birthdate_<?php echo $i; ?>" name="birthdate[]" required>

            <label for="gender_<?php echo $i; ?>">Gender:</label>
            <select id="gender_<?php echo $i; ?>" name="gender[]" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="address_<?php echo $i; ?>">Address:</label>
            <textarea id="address_<?php echo $i; ?>" name="address[]" required></textarea>

            <label for="civilStatus_<?php echo $i; ?>">Civil Status:</label>
            <select id="civilStatus_<?php echo $i; ?>" name="civilStatus[]" required>
                <option value="">Select Civil Status</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Widowed">Widowed</option>
                <option value="Divorced">Divorced</option>
            </select>

            <label for="occupation_<?php echo $i; ?>">Occupation:</label>
            <input type="text" id="occupation_<?php echo $i; ?>" name="occupation[]">

            <label for="contactNumber_<?php echo $i; ?>">Contact Number:</label>
            <input type="tel" id="contactNumber_<?php echo $i; ?>" name="contactNumber[]">
        <?php endfor; ?>

        <button type="submit">Submit</button>
        <div id="message" class="message"></div>
    </form>

</body>
</html>