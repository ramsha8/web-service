    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign Up</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    </head>
    <body>
    
    </body>
    </html>
    <div id="signup-form">
        <div>
        <h2>Sign Up</h2>
        <form id="signupForm" onsubmit="submitFunct(event)" method="post">
            <div><label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
</div>
            <div class="pt-5px"><label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
</div>
            <div class="pt-5px"><label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
</div>
            <div class="pt-5px"><button type="submit">Sign Up</button></div>
        </form></div>Or <br>   
        <p id='google-sign-in-button' onclick="handleGoogleSignIn()">Sign up with Google</p>

    </div>
    <script type="text/javascript">
        // Replace the placeholders with your actual values
const clientId = '328921298490-6imv856as29rjmv5k0pqlfulphh9an7k.apps.googleusercontent.com';
const redirectUri = "https://localhost/ramsha";
const scope = 'profile email';

// Function to handle the button click event
function handleGoogleSignIn() {
  // Construct the authorization URL
  const authorizationEndpoint = 'https://accounts.google.com/o/oauth2/v2/auth';
  const params = new URLSearchParams({
    client_id: clientId,
    redirect_uri: redirectUri,
    scope: scope,
    response_type: 'code',
  });

  const authorizationUrl = `${authorizationEndpoint}?${params}`;

  // Redirect the user to the authorization URL
  window.location.href = authorizationUrl;
}

// Attach the click event listener to the Google sign-in button
//const googleSignInButton = document.getElementById('google-sign-in-button');
//googleSignInButton.addEventListener('click', handleGoogleSignIn);

    </script>