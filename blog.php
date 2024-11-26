<?php
// Include database connection
include 'connection.php';

// Handle form submission for adding a new blog post
if (isset($_POST['Submit'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $publish_time = mysqli_real_escape_string($con, $_POST['publish_time']);

    // Insert the new post into the database
    $query = "INSERT INTO `blog_post`(`title`, `content`, `publish_time`) VALUES ('$title', '$content', '$publish_time')";
    $data = mysqli_query($con, $query);

    // Display success or failure message
    if ($data) {
        echo '<script>alert("Data Saved Successfully");
        window.location.href="view.php";</script>';
    } else {
        echo '<script>alert("Please try again");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Blog Management</title>
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

        /* Form Styling */
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #357abd;
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
    <a href="view.php">View Blog Posts</a>
    <!-- <a href="add_course.php">Add Course</a>
    <a href="view_courses.php">View Courses</a> -->
</div>

<!-- Main Content -->
<div class="content">
    <!-- Blog Management Form -->
    <div class="form-container">
        <h2>Create a New Blog Post</h2>
        <form method="POST" action="">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="5" required></textarea>

            <label for="publish-time">Publish Time:</label>
            <input type="datetime-local" id="publish-time" name="publish_time" required>

            <button type="submit" name="Submit">Create Post</button>
        </form>
    </div>

    <!-- Scheduled Posts Section -->
    <section id="scheduled-posts" class="mt-5">
        <h2>Scheduled Blog Posts</h2>
        <div class="form-container">
            <?php
            // Fetch scheduled posts from the database
            $query = "SELECT * FROM `blog_post` WHERE publish_time >= NOW() ORDER BY publish_time ASC";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="post border p-3 mb-3">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['content']) . '</p>';
                    echo '<p><strong>Scheduled for:</strong> ' . htmlspecialchars($row['publish_time']) . '</p>';
                    echo '<button onclick="deletePost(' . $row['id'] . ')" class="btn btn-danger">Delete</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>No scheduled posts found.</p>';
            }
            ?>
        </div>
    </section>
</div>

<script>
    // Delete post function (to be implemented on server-side if needed)
    function deletePost(postId) {
        if (confirm('Are you sure you want to delete this post?')) {
            window.location.href = "delete_post.php?id=" + postId;
        }
    }
</script>

</body>
</html>
