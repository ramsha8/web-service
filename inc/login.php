    <div id="login-form">
        <h2>Login</h2>
<form id="loginForm" onsubmit="loginForm(event)">
    <label for="loginEmail">Email:</label>
    <input type="email" id="loginEmail" name="loginEmail" placeholder="Enter your email" required>

    <label for="loginPassword">Password:</label>
    <input type="password" id="loginPassword" name="loginPassword" placeholder="Enter your password" required>

    <button type="submit">Login</button>
    <label for="remember">Remember Me:</label>
    <input type="checkbox" id="remember" name="remember">
    <div id="result"></div> <!-- Error message will be displayed here -->
</form>

    </div>