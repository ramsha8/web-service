<?php
// Assuming you have a database connection
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'web_service';

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
$baseURL = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);

// Retrieve product data from the database
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="product">';
        echo '<img src="' .$baseURL. $row['image'] . '">';
        echo '<h2>' . $row['name'] . '</h2>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<p>Price: $' . $row['price'] . '</p>';
        echo '</div>';
    }
} else {
    echo 'No products found.';
}

mysqli_close($conn);
?>
