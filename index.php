<?php
$host = 'localhost';
$db = 'web_service';
$user = 'root';
$pass = '';

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            $message = "Email already exists. Please use a different email.";
        } else {
            // Insert the new user into the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hashedPassword]);
            $message = "Sign up successful!";
        }

        echo json_encode($message);
        exit;
    } elseif (isset($_POST['login'])) {
        $loginEmail = $_POST['loginEmail'];
        $loginPassword = $_POST['loginPassword'];

        // Check if the email and password match a user in the database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$loginEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($loginPassword, $user['password'])) {
            $message = "Welcome back, " . $user['name'] . "! You are now logged in.";
        } else {
            $message = "Invalid email or password.";
        }

        echo json_encode($message);
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Web Service Example</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Web Service Example</h1>

    <div id="signup-form">
        <h2>Sign Up</h2>
        <form id="signupForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Sign Up</button>
        </form>
    </div>

    <div id="login-form">
        <h2>Login</h2>
        <form id="loginForm">
            <label for="loginEmail">Email:</label>
            <input type="email" id="loginEmail" name="loginEmail" placeholder="Enter your email" required>

            <label for="loginPassword">Password:</label>
            <input type="password" id="loginPassword" name="loginPassword" placeholder="Enter your password" required>

            <button type="submit">Login</button>
        </form>
    </div>

    <div id="result"></div>

    <script src="script.js"></script>
</body>
</html>
