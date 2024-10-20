<?php

session_start();
// Database credentials
$servername = "localhost"; // or your server's IP
$username = "root";        // your MySQL username
$password = "";            // your MySQL password
$dbname = "portfolio_db";  // your portfolio database
$dbport = 3306;            // MySQL default port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $dbport);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Sanitize input to prevent SQL injection
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $message = $conn->real_escape_string($message);

    // Insert data into the contact_form table
    $sql = "INSERT INTO contact_form (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "trivediraj650@gmail.com";  // Your email address
    $subject = "New Contact Form Submission";
    $body = "You received a new message from $name ($email):\n\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent and email notification delivered!";
    } else {
        echo "Message sent, but email notification failed.";
    }
}

// Close the database connection
$conn->close();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
