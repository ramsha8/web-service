<?php
session_start();
$host = 'localhost';
$db = 'web_service';
$user = 'root';
$pass = '';

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    // Remove the session token from the database
    $stmt = $pdo->prepare("UPDATE users SET session_token = NULL WHERE email = ?");
    $stmt->execute([$_SESSION['user']['email']]);
}
if (isset($_COOKIE['session_token'])) {
    setcookie('session_token', '', time() - 3600);
}
// Clear the session data
$_SESSION = array();
session_destroy();

// Clear the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Clear the remember me cookie
if (isset($_COOKIE['session_token'])) {
    setcookie('session_token', '', time() - 3600, '/');
}

$message = "You have been logged out.";
echo json_encode(array("message" => $message));
?>
