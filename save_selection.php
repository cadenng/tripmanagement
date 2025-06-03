<?php
require_once 'config.php';

//basic secure
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    echo "Forbidden";
    exit;
}

//post the data from id
$username = htmlspecialchars($_POST['username'] ?? '');
$destination = htmlspecialchars($_POST['destination'] ?? '');
$airline = htmlspecialchars($_POST['airline'] ?? '');
$flight_price = floatval($_POST['flight_price'] ?? 0);
$hotel = htmlspecialchars($_POST['hotel'] ?? '');
$hotel_price = floatval($_POST['hotel_price'] ?? 0);

//linked with config.php
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset(DB_CHARSET);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//insert selection to id
$stmt = $conn->prepare("
    INSERT INTO user_selection 
    (username, destination, airline, flight_price, hotel, hotel_price) 
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("sssdsd", 
    $username,       // string
    $destination,    // string
    $airline,        // string
    $flight_price,   // double
    $hotel,          // string
    $hotel_price     // double
);

//When selection was save
if ($stmt->execute()) {
    echo "Selection saved successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
