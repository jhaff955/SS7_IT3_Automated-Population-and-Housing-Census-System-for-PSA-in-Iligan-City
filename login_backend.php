<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT User_ID, Name FROM user WHERE username = ? AND password = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful
        $row = $result->fetch_assoc();
        $userId = $row['User_ID'];
        $name = $row['Name'];
        session_start();
        $_SESSION['user_id'] = $userId;
        $_SESSION['Name'] = $name;
        echo "<script>
                alert('Login successful');
                window.location.href = 'homepage.php';
              </script>";
    } else {
        // Login failed
        echo "<script>
                document.getElementById('errorMessage').innerText = 'Invalid username or password';
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
