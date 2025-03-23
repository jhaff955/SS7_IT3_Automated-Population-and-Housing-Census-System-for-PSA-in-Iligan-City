<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$name = isset($_SESSION['Name']) ? $_SESSION['Name'] : 'Guest';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Census 2025 - Iligan City</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #004d99 ;
            color: #255;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
            background-color: #1f5af3;
            color: white;
            padding: 20px 0;
        }
        h1 {
            margin: 0;
            font-size: 2.5em;
        }
        .content {
            padding: 20px;
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
        }
        .cta-button {
            display: inline-block;
            margin-top: 30px;
            padding: 20px 40px;
            font-size: 1.2em;
            color: white;
            background-color: #1E90FF;
            text-decoration: none;
            border-radius: 10px;
        }
        .cta-button:hover {
            background-color: #AFEEEE;
        }
        .cta-button1 {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px; /* Adjusted padding to make it smaller */
            font-size: 1em; /* Adjusted font size to make it smaller */
            color: white;
            background-color: green; /* Changed color to green */
            text-decoration: none;
            border-radius: 10px;
            border: none; /* Removed black stroke */
        }
        .cta-button1:hover {
            background-color: #AFEEEE;
        }
        footer {
            margin-top: 40px;
            padding: 20px;
            background-color: #1E90FF;
            color: white;

        }
        header {background-color: #004d99; /* PSA Blue */
            color: white;
            text-align: center;
            padding: 20px 0;

        }
        .psa-logo {
            max-width: 150px;
            width: 150px; /* Adjusted to make it circular */
            height: 150px; /* Adjusted to make it circular */
            border-radius: 50%; /* Changed to 50% to make it circular */
            display: block;
            margin: 0 auto 20px; }
        .welcome-message {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 16px;
            color: white;
        }
            </style>
</head>
<body>
    <header>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/25/Philippine_Statistics_Authority.svg/1200px-Philippine_Statistics_Authority.svg.png" alt="PSA Logo" class="psa-logo">

    </style>
</head>
<body>

    <header>
        <h1>2025 Census - Iligan City</h1>
    </header>

    <div class="welcome-message">
        Welcome, <?php echo htmlspecialchars($name); ?>
        <form action="logout.php" method="post" style="display:inline;">
            <button type="submit" class="cta-button1">Logout</button>
        </form>
        <a href="account_settings.php" class="cta-button1">Account Settings</a>
    </div>

    <div class="content">
        <p>Help shape the future of Iligan City! Participate in the 2025 Census and ensure that your community is accurately represented.</p>
        <p>Your information is confidential and will be used solely for statistical purposes.</p>
        <a href="form.php" class="cta-button">Form</a>
        <a href="entry.php" class="cta-button">Entry</a>
        <a href="census_record.php" class="cta-button">Census Records</a>
        <a href="about us.php" class="cta-button">About us</a>
    </div>
    

    <footer>
        <p>&copy; 2025 Iligan City Government. All rights reserved.</p>
    </footer>

</body>
</html>