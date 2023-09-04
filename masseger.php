
<?php
// Database connection details
// $db_host = "your_database_host"; // e.g., localhost
// $db_username = "your_username";
// $db_password = "your_password";
// $db_name = "your_database_name";

// // Create a database connection
// $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
@include 'config.php';
// Check the connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Insert the form data into the database
    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        // Data inserted successfully
        echo '<div class="alert alert-success">Your message has been sent and saved.</div>';
    } else {
        // Error inserting data
        echo '<div class="alert alert-danger">Sorry, there was an error sending your message. Please try again later.</div>';
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>






