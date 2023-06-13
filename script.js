function submitFunct (event) {
    event.preventDefault();

    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            document.getElementById('result').textContent = response;                location.reload(); // Reload the page

        }
    };
    xhr.send('signup=1&name=' + name + '&email=' + email + '&password=' + password);
};

function loginForm(event) {
    event.preventDefault();

    var loginEmail = document.getElementById('loginEmail').value;
    var loginPassword = document.getElementById('loginPassword').value;
    var remember = document.getElementById('remember').checked;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {console.log(JSON.parse(xhr.responseText).success);
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success===true) {
                    // If login is successful, perform necessary actions
                    location.reload(); // Reload the page
                } else {
                    // Display error message
                    document.getElementById('result').textContent = response.message;
                }
            } else {
                // Display error message if request fails
                document.getElementById('result').textContent =   JSON.parse(xhr.responseText);
            }
        }
    };
    xhr.send('login=1&loginEmail=' + loginEmail + '&loginPassword=' + loginPassword + '&remember=' + remember);
}

// Logout button click event
function logoutButton (event) {
    //event.preventDefault();

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'logout.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);
            document.getElementById('result').textContent = response.message;

            // Reload the page after logout
            if (response.message === "You have been logged out.") {
                window.location.reload();
            }
        }
    };
    xhr.send();
};
