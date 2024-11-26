<?php
session_start();
include("connection.php"); // Database connection

// Fetch courses from the database
$query = "SELECT id, title, price FROM course";
$result = mysqli_query($con, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $course_id = $_POST['course_id'];
    $amount = $_POST['amount'];

    // Store transaction details in session for simulation
    $_SESSION['email'] = $email;
    $_SESSION['course_id'] = $course_id;
    $_SESSION['amount'] = $amount;
    
    // Redirect to dummy transaction processing page
    header("Location: process_transaction.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 500px;
            margin-top: 100px;
        }
        h2 {
            color: #343a40;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dummy Payment Page</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="course">Select Course:</label>
                <select class="form-control" id="course" name="course_id" required onchange="updateAmount()">
                    <option value="">Choose a course</option>
                    <?php
                    // Populate courses dropdown
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "' data-price='" . $row['price'] . "'>" . htmlspecialchars($row['title']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Amount (USD):</label>
                <input type="number" class="form-control" id="amount" name="amount" readonly required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Proceed to Payment</button>
        </form>
    </div>

    <script>
        function updateAmount() {
            const courseSelect = document.getElementById('course');
            const amountInput = document.getElementById('amount');
            
            // Get selected course's price from data attribute
            const selectedOption = courseSelect.options[courseSelect.selectedIndex];
            const price = selectedOption.getAttribute('data-price');

            amountInput.value = price ? price : ''; // Set amount field with price or clear if none
        }
    </script>
</body>
</html>
