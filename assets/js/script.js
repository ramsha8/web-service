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
      var formData = new FormData();
  formData.append('login', '1');
  formData.append('loginEmail', loginEmail);
  formData.append('loginPassword', loginPassword);
  formData.append('remember', remember);
  xhr.send(formData);
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
// You can add any JavaScript code for interactivity or additional functionality
// For example, adding a click event to the products

window.addEventListener('load', function () {
    var products = document.getElementsByClassName('product');
    
    for (var i = 0; i < products.length; i++) {
        products[i].addEventListener('click', function () {
            // Perform some action when a product is clicked
            console.log('Product clicked');
        });
    }
});
