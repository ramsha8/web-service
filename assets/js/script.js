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

  var url = "http://localhost/ramsha's%20web%20service/index.php";
  var data = new FormData();
  data.append('login', '1');
  data.append('loginEmail', loginEmail);
  data.append('loginPassword', loginPassword);
  data.append('remember', remember);

  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: new URLSearchParams(data)
  })
    .then(function(response) {
      return response.json();
    })
    .then(function(response) {
      
      if (response.success === true) {
       const token=response.message;
        // 

        // 
        // If login is successful, perform necessary actions
        //location.reload(); // Reload the page
      } else {
        // Display error message
        document.getElementById('result').textContent = response.message;
      }
    })
    .catch(function(error) {
      // Display error message if request fails
      document.getElementById('result').textContent = error.message;
    });
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
function addToCart(product) {
    var cartItems = document.getElementById('cart-items');
    var totalElement = document.getElementById('total-price');

    var cartItem = document.createElement('div');
    cartItem.innerHTML = product.name + ' - $' + product.price;

    var removeButton = document.createElement('button');
    removeButton.textContent = 'Remove';
    removeButton.addEventListener('click', function() {
        removeFromCart(product);
    });

    cartItem.appendChild(removeButton);
    cartItems.appendChild(cartItem);

    var total = parseFloat(totalElement.textContent);
    total += product.price;
    totalElement.textContent = total.toFixed(2);
}
function removeFromCart(product) {
    var cartItems = document.getElementById('cart-items');
    var totalElement = document.getElementById('total-price');

    var cartItem = product.name + ' - $' + product.price;
    var items = cartItems.getElementsByClassName('product-item');

    for (var i = 0; i < items.length; i++) {
        if (items[i].textContent === cartItem) {
            items[i].remove();
            break;
        }
    }

    var total = parseFloat(totalElement.textContent);
    total -= product.price;
    totalElement.textContent = total.toFixed(2);
}
