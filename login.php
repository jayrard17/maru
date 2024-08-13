<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'devilla_j');
    if ($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT * FROM registration WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($password === $row['password']) {
                $_SESSION['username'] = $username;
                $stmt->close();
                $conn->close();
                header("Location: shop.html"); // Redirect to shop.php
                exit();
            } else {
                $stmt->close();
                $conn->close();
                echo '<script>alert("Invalid Password")</script>';
            }
        } else {
            $stmt->close();
            $conn->close();
            echo '<script>alert("Invalid Username")</script>';
        }
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Login</h1>
    </div>
    <div class="login-form">
        <form method="post" action="">
            <div class="form-group">
                <label for="email"></label>
                <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password"></label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()"> Show Password
            </div>
            <button type="submit" class="login">Login</button>
        </form>
        
        <div class="create-account">
          <a href="verification.php">Create Account</a>
      </div>

      <?php if (isset($error)) { ?>
        <div class="error">
          <?php echo $error; ?>
        </div>
      <?php } ?>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>

</body>
</html>
