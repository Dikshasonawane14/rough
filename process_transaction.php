<?php
session_start();

// Retrieve transaction details from session
$email = $_SESSION['email'] ?? null;
$course_id = $_SESSION['course_id'] ?? null;
$amount = $_SESSION['amount'] ?? null;

// If any required details are missing, redirect to payment page
if (!$email || !$course_id || !$amount) {
    header("Location: payment.php");
    exit;
}

// Assuming connection.php is included and $con is set
include("connection.php");

// Fetch course title from database using course_id
$course_query = "SELECT title FROM course WHERE id = '$course_id'";
$course_result = mysqli_query($con, $course_query);
$course = mysqli_fetch_assoc($course_result);
$course_title = $course['title'] ?? 'Unknown Course';

// Redirect to the success page
header("Location: success.php");
exit;
?>
