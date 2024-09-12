<?php
$host = 'localhost';  // Database host
$dbUser = 'id22079091_loginsystem_1';  // Database user
$dbPass = 'Aadil@7319777540';  // Database password
$dbName = 'id22079091_loginsystem';  // Database name

$con = new mysqli($host, $dbUser, $dbPass, $dbName,);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$message = '';  // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aadharNumber = $con->real_escape_string($_POST['aadhar_number']);
    $customerID = $con->real_escape_string($_POST['customer_id']);
    $firstName = $con->real_escape_string($_POST['first_name']);
    $lastName = $con->real_escape_string($_POST['last_name']);
    $email = $con->real_escape_string($_POST['email']);
    $landType = $con->real_escape_string($_POST['land_type']);

    // Check if Aadhar number already exists
    $stmt = $con->prepare("SELECT aadhar_number FROM customer_bookings WHERE aadhar_number = ?");
    $stmt->bind_param("s", $aadharNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $message = "Aadhar number already registered. Please use a different Aadhar number.";
    } else {
        $stmt->close();
        // Insert new record if no duplicate Aadhar number
        $stmt = $con->prepare("INSERT INTO customer_bookings (aadhar_number, customer_id, first_name, last_name, email, land_type) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $aadharNumber, $customerID, $firstName, $lastName, $email, $landType);
        if ($stmt->execute()) {
            $message = "Booking successful. Your Aadhar number has been registered.";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $con->close();
}
?>



   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Solar Installation Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #007BFF; /* Blue background */
            font-family: 'Roboto', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 350px;
            margin-bottom: 10px;
            animation: slideIn 0.5s ease-out forwards;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button, .back-button {
            width: auto;
            padding: 10px 20px;
            color: white;
            background-color: #4CAF50; /* Green background */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button:hover, .back-button:hover {
            background-color: #45a049; /* Darker shade of green */
            box-shadow: 0 5px 15px rgba(0,0,0,0.2); /* Add shadow on hover */
            transform: translateY(-2px); /* Slight lift */
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        /* Additional styles for small and classy back button */
        .back-button {
            background-color: #ff6347; /* Tomato red background for contrast */
            font-size: 16px; /* Smaller font size for a smaller button */
        }
    </style>
</head>
<body>
    <form method="post">
        <h2>Solar Installation Form</h2>
        <?php if ($message): ?>
        <p><?php echo $message; ?></p>
        <?php endif; ?>
        <input type="text" name="aadhar_number" placeholder="Aadhar Number" required>
        <input type="text" name="customer_id" placeholder="Customer ID" required>
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <select name="land_type" required>
            <option value="">Select Land Type</option>
            <option value="domestic">Domestic</option>
            <option value="commercial">Commercial</option>
        </select>
        <button type="submit">Submit Booking</button>
    </form>
    <!-- Small and animated back button -->
    <button type="button" class="back-button" onclick="history.back();">Go Back</button>
</body>
</html>
