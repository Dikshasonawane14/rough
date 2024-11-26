<?php
include 'connection.php'; // Include the database connection file

// Check if an ID is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the course from the database
    $query = "DELETE FROM `course` WHERE `id` = $id";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Redirect back to the courses page with a success message
        echo '<script>alert("Course deleted successfully."); window.location.href="view_course.php";</script>';
    } else {
        // If there's an error, show a message
        echo '<script>alert("Error deleting course: ' . mysqli_error($con) . '"); window.location.href="view_courses.php";</script>';
    }
} else {
    echo '<script>alert("Invalid course ID."); window.location.href="view_courses.php";</script>';
}
?>
