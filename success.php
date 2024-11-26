<?php
session_start();

// Retrieve transaction details from session
$email = $_SESSION['email'] ?? null;
$amount = $_SESSION['amount'] ?? null;

// Clear session data to avoid resubmission
session_unset();
session_destroy();

// Redirect to payment page if any information is missing
if (!$email || !$amount) {
    header("Location: payment.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Success</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 500px;
            margin-top: 100px;
            text-align: center;
        }
        h2 {
            color: #4CAF50;
        }
        p {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Transaction Successful!</h2>
        <p>Thank you for your payment.</p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Amount Paid:</strong> $<?php echo htmlspecialchars($amount); ?></p>
        
        <a href="index.php" class="btn btn-primary mt-4">Back to Home Page</a>
    </div>
</body>
</html>
