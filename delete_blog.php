<?php
include 'connection.php'; // Include the database connection file

// Check if the ID is set and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete the post from the database
    $deleteQuery = "DELETE FROM `blog_post` WHERE `id` = $id";
    $deleteResult = mysqli_query($con, $deleteQuery);

    if ($deleteResult) {
        echo '<script type="text/javascript">alert("Post deleted successfully"); window.location.href="view.php";</script>';
    } else {
        echo '<p class="text-danger">Error deleting post: ' . mysqli_error($con) . '</p>';
    }
} else {
    echo '<p class="text-danger">Invalid ID.</p>';
    exit;
}
?>
