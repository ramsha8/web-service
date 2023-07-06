<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    </head>
    <body>
    <div id="login-form">
       <div> <h2>Login</h2>
<form id="loginForm" onsubmit="loginForm(event)" method="post">
     <div class=""> 
    <label for="loginEmail">Email:</label>
    <input type="email" id="loginEmail" name="loginEmail" placeholder="Enter your email" required>
 </div><div class="pt-5px"> 
    <label for="loginPassword">Password:</label>
    <input type="password" id="loginPassword" name="loginPassword" placeholder="Enter your password" required>
 </div><div class="pt-5px"> 
    <button type="submit" class="button">Login</button></div>
    <div class="d-flex ai-start pt-5px">    <input type="checkbox" id="remember" name="remember">
    <label for="remember">Remember Me</label></div>

    <div id="result"></div> <!-- Error message will be displayed here -->
</form>
</div>
    </div>
    <script  src="../assets/js/script.js"></script>
  
    </body>
    </html>    