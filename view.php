<?php
// Include database connection
include 'connection.php';

// Fetch all posts from the database
$query = "SELECT * FROM `blog_post` ORDER BY publish_time DESC";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    echo '<p class="text-danger">Error fetching posts: ' . mysqli_error($con) . '</p>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blog Posts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Sidebar Styling */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: #fff;
            padding: 10px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Styling for the All Posts Page */
        .post {
            padding: 20px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .post h3 {
            margin-top: 0;
            font-size: 1.25rem;
        }
        .post-meta {
            font-size: 0.9rem;
            color: gray;
            margin-bottom: 10px;
        }
        .post-content {
            font-size: 1rem;
            line-height: 1.5;
            max-height: 150px;
            overflow: hidden;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Admin Dashboard</h2>
    <a href="dashboard.php">Dashboard Home</a>
    <a href="blog.php">Add Blog Posts</a>
    <!-- <a href="course.php">Add Course</a>
    <a href="view_course.php">View Courses</a> -->
</div>

<!-- Main Content -->
<div class="content">
    <h1 class="my-4">All Blog Posts</h1>
    <div class="row">
        <?php
        // Check if any posts were found
        if (mysqli_num_rows($result) > 0) {
            // Loop through and display each post
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4">';
                echo '<div class="post">';
                echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                echo '<p class="post-meta"><strong>Published on:</strong> ' . htmlspecialchars($row['publish_time']) . '</p>';
                echo '<p class="post-content">' . nl2br(htmlspecialchars($row['content'])) . '</p>';
                echo '<a href="update_blog.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">View Details</a> ';
                echo '<a href="delete_blog.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this post?\');">Delete</a>';
                echo '</div>'; // Close post div
                echo '</div>'; // Close col-md-4 div
            }
        } else {
            echo '<p>No blog posts found.</p>';
        }
        ?>
    </div>
</div>

</body>
</html>
