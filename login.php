<!DOCTYPE html>
<html>
<head>
<title>PSA Census Login</title>
<style>
  body { 
      font-family: sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #004d99;
    }

  .login-container {
    margin: 20px;
    background-color: white;
    padding: 50px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 300px;
  }

  .login-container h2 {
    text-align: center;
    margin-bottom: 30px;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .form-group label {
    display: block;
    margin-bottom: 5px;
  }

  .form-group input {
    width: calc(100% - 12px);
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .form-group button {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .form-group button:hover {
    background-color: #00BFFF;
  }

  .error-message {
      color: red;
      text-align: center;
      margin-top: 10px;

    }

   .psa-logo {
      max-width: 200px; 
      width: 150px;
      height: 150px;
      border-radius: 150%;
      display: block;
      margin: 0 auto 20px;
    }

    #forgotpass_dom {
      margin-left: 60%;
      margin-top: 10px;
    }
    #password{
      margin-bottom: 15px;
    }

          
</style>
</head>
<body>
    <div class="login-container">
        <header>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/25/Philippine_Statistics_Authority.svg/1200px-Philippine_Statistics_Authority.svg.png" alt="PSA Logo" class="psa-logo">
        </header>
        <h2>PSA Census Login</h2>
        <form id="loginForm" method="POST" action="login_backend.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <a href="#" id="forgotpass_dom">Forgot password</a>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <div id="errorMessage" class="error-message"></div>
        </form>
    </div>
</body>
</html>

