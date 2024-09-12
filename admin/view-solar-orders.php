<?php
session_start();
include_once('../includes/config.php');

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit;
}

// Handle logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Handle status update
if (isset($_POST['update_status']) && isset($_POST['order_id']) && isset($_POST['new_status'])) {
    $orderId = $con->real_escape_string($_POST['order_id']);
    $newStatus = $con->real_escape_string($_POST['new_status']);

    $stmt = $con->prepare("UPDATE customer_bookings SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $newStatus, $orderId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Status updated successfully.";
    } else {
        echo "Failed to update status.";
    }
    $stmt->close();
    exit; // Stop further execution to return the response
}

$query = "SELECT * FROM customer_bookings"; // Fetch all solar orders
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>!
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Solar Installation Booking Candidates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; }
        .container { max-width: 1200px; margin: auto; }
        table { width: 100%; }
        .header-title {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border-radius: 8px;
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .action-buttons button {
            width: 49%; /* Make buttons equal width and fill space */
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .table thead th {
            border-bottom: 2px solid #dee2e6;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,.05);
        }
        .table-hover tbody tr:hover {
            color: #212529;
            background-color: rgba(0,0,0,.075);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header-title">All Solar Installation Booking Candidates</div>
    <div class="action-buttons">
        <form method="post">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            <button type="button" class="btn btn-secondary" onclick="history.back();">Back</button>
        </form>
    </div>
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th> <!-- Added Order ID column header -->
                <th>Customer Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Country</th>
                <th>State</th>
                <th>Aadhar Number</th>
                <th>PAN Number</th>
                <th>Created At</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td> <!-- Displaying the Order ID -->
                <td><?php echo htmlspecialchars($row['customer_id']); ?></td>
                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                <td><?php echo htmlspecialchars($row['age']); ?></td>
                <td><?php echo htmlspecialchars($row['country']); ?></td>
                <td><?php echo htmlspecialchars($row['state']); ?></td>
                <td><?php echo htmlspecialchars($row['aadhar_number']); ?></td>
                <td><?php echo htmlspecialchars($row['pan_number']); ?></td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td id="status-<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['status']); ?></td>
                <td>
                    <button onclick="updateStatus('<?php echo $row['id']; ?>', 'Completed')" class="btn btn-success btn-sm">Completed</button>
                    <button onclick="updateStatus('<?php echo $row['id']; ?>', 'Cancelled')" class="btn btn-danger btn-sm">Cancelled</button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function updateStatus(orderId, newStatus) {
    $.ajax({
        type: "POST",
        url: window.location.href, // Post back to the same page
        data: {order_id: orderId, new_status: newStatus, update_status: true},
        success: function(response) {
            alert(response);
            $('#status-' + orderId).text(newStatus); // Update the status text on success
        }
    });
}
</script>
</body>
</html>