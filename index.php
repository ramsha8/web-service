<?php
session_start();

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
            $_SESSION['user'] = $user;
    // Check if "Remember Me" checkbox is checked
       // echo json_encode($_POST['remember']);exit;
    if (isset($_POST['remember']) && $_POST['remember'] === "true") {
        // Generate a random session token
        $sessionToken = bin2hex(random_bytes(32));

        // Save the session token in a cookie
        setcookie('session_token', $sessionToken, time() + (30 * 24 * 60 * 60)); // Cookie expires in 30 days

        // Update the user's session token in the database
        $stmt = $pdo->prepare("UPDATE users SET session_token = ? WHERE email = ?");
        $stmt->execute([$sessionToken, $loginEmail]);
    }
    $response = array('success' => true, 'message' => "Welcome back, " . $user['name'] . "! You are now logged in.");
        } else {
    $response = array('success' => false, 'message' => "Invalid email or password.");
        }

        echo json_encode($response);
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Web Service Example</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
   
     
<?php if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];?>
   Welcome,   <?php echo$user['name']; ?> ! You are logged in.<br>
 <div id='logout-form'>
 <button id='logoutButton' onClick="logoutButton(this)">Logout</button>
 </div>
 <?php  
}elseif (isset($_COOKIE['session_token'])) {    // Check if the session token exists in the database
    $sessionToken = $_COOKIE['session_token'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE session_token = ?");
    $stmt->execute([$sessionToken]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 if ($user) {
        $_SESSION['user'] = $user;

    ?>   Welcome,   <?php echo$user['name']; ?> ! You are logged in.
 <div id='logout-form'>
 <button id='logoutButton' onClick="logoutButton(this)">Logout</button>
 </div><?php }
}   else   { ?>
    <nav class=" "> <h1 class="center calc-ml">Web Service Example</h1>
<a href="<?php echo'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']); ?>/inc/login.php" class="button right-buttons">Log in</a>
<a href="<?php echo'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']); ?>/inc/signup.php" class="button right-buttons">Sign up</a>

</nav>
<?php } ?>
    <div id="result"></div>
  <div class="container">
    <h1>Product Catalog</h1>
    <div id="product-list">
      <?php include 'product_list.php'; ?>
    </div>
  </div>
    <script src="<?php echo'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']); ?>/script.js"></script>
</body>
</html>
