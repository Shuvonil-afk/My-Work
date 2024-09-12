<?php
// Connection setup
$host = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'loginsystem';
$con = new mysqli($host, $dbUser, $dbPass, $dbName);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Data insertion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aadharNumber = $con->real_escape_string($_POST['aadhar_number']);
    $email = $con->real_escape_string($_POST['email']);
    $name = $con->real_escape_string($_POST['name']);
    $details = $con->real_escape_string($_POST['details']); // Assuming form input for order details
    $status = 'Pending'; // Default status

    $sql = "INSERT INTO orders (aadhar_number, email, name, order_details, status, order_date) 
            VALUES (?, ?, ?, ?, ?, CURDATE())";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssss", $aadharNumber, $email, $name, $details, $status);
    if ($stmt->execute()) {
        echo "Order submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$con->close();
?>
