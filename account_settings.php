<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'connect.php'; 

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE User_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Add other fields as necessary

    $update_query = "UPDATE user SET Name = ?, Email = ?, username = ?, Password = ? WHERE User_ID = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssssi", $name, $email, $username, $password, $user_id);
    $update_stmt->execute();

    echo "<script>alert('Update successful');</script>";
    header("Location: account_settings.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1em;
            color: white;
            background-color: #1E90FF;
            text-decoration: none;
            border-radius: 5px;
        }
        .cta-button:hover {
            background-color: #AFEEEE;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="homepage.php" class="cta-button" style="float: right; margin-top: 10px;">Back</a>
        <h1>Account Settings</h1>
        <form action="account_settings.php" method="post">
            <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['Name']); ?>" required>
            </div>
            <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
            </div>
            <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($user['Password']); ?>" required>
            <input type="checkbox" id="show-password"> Show Password
            </div>
            <button type="submit" class="cta-button">Save Changes</button>
        </form>
        <script>
            document.getElementById('show-password').addEventListener('change', function() {
                var passwordInput = document.getElementById('password');
                if (this.checked) {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });
        </script>
    </div>
</body>
</html>
