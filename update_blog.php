<?php
include 'connection.php'; // Include the database connection file

// Check if the ID is set and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the current details of the blog post
    $query = "SELECT * FROM `blog_post` WHERE `id` = $id";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo '<p class="text-danger">Error fetching post details: ' . mysqli_error($con) . '</p>';
        exit;
    }

    // Check if the post exists
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
    } else {
        echo '<p class="text-danger">Post not found.</p>';
        exit;
    }
} else {
    echo '<p class="text-danger">Invalid ID.</p>';
    exit;
}

// Check if the form is submitted to update the post
if (isset($_POST['Update'])) {
    // Sanitize inputs to escape special characters
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $publish_time = mysqli_real_escape_string($con, $_POST['publish_time']);

    // Update the post in the database
    $updateQuery = "UPDATE `blog_post` SET `title` = '$title', `content` = '$content', `publish_time` = '$publish_time' WHERE `id` = $id";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        echo '<script type="text/javascript">alert("Post updated successfully"); window.location.href="view.php";</script>';
    } else {
        echo '<p class="text-danger">Error updating post: ' . mysqli_error($con) . '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Blog Post</title>
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
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        /* Main Content Styling */
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        /* Buttons Styling */
        .btn-primary {
            background-color: #4CAF50;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
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
    <a href="blog.php">Manage Blog Posts</a>
    <a href="add_course.php">Add Course</a>
    <a href="view_courses.php">View Courses</a>
</div>

<!-- Main Content -->
<div class="content">
    <div class="container">
        <h1 class="my-4">Update Blog Post</h1>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" class="form-control" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="publish_time">Publish Time:</label>
                <input type="datetime-local" id="publish_time" name="publish_time" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($post['publish_time'])); ?>" required>
            </div>

            <button type="submit" name="Update" class="btn btn-primary">Update Post</button>
            <a href="view.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>
