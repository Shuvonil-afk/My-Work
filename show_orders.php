<?php
session_start();

$host = 'localhost';
$dbUser = 'id22079091_loginsystem_1';
$dbPass = 'Aadil@7319777540';
$dbName = 'id22079091_loginsystem';

$con = new mysqli($host, $dbUser, $dbPass, $dbName);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$message = '';
$orderDetails = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure customer_id is provided; otherwise, use a default value or handle it as not provided
    $customerID = isset($_POST['customer_id']) ? $con->real_escape_string($_POST['customer_id']) : '';

    // Proceed only if customer_id is not empty
    if (!empty($customerID)) {
        if ($stmt = $con->prepare("SELECT email, first_name, last_name, status, aadhar_number FROM customer_bookings WHERE customer_id = ?")) {
            $stmt->bind_param("s", $customerID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $orderDetails = $result->fetch_assoc();
                $message = "Order details found.";
            } else {
                $message = "No order found for the provided Customer ID.";
            }
            $stmt->close();
        } else {
            $message = "Error preparing SQL statement: " . $con->error;
        }
    } else {
        $message = "Please provide a Customer ID.";
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show Your Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; }
        .container { max-width: 600px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Check Your Order Details</h1>
    <form method="post" class="mb-4">
        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer ID:</label>
            <input type="text" class="form-control" id="customer_id" name="customer_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Show Order Status</button>
    </form>
    <?php if (!empty($orderDetails)): ?>
        <h3>Order Details:</h3>
        <p>Name: <?php echo htmlspecialchars($orderDetails['first_name'] . " " . $orderDetails['last_name']); ?></p>
        <p>Email: <?php echo htmlspecialchars($orderDetails['email']); ?></p>
        <p>Order Status: <?php echo htmlspecialchars($orderDetails['status']); ?></p>
        <p>aadhar_number: <?php echo htmlspecialchars($orderDetails['aadhar_number']); ?></p>
    <?php else: ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="post">
        <button type="submit" class="btn btn-danger" name="logout">Logout</button>
        <button type="button" class="btn btn-info" onclick="history.back();">Back</button>
    </form>
</div>
</body>
</html>
