<?php
include 'connection.php'; // Include the database connection file

// Check if the course ID is provided in the URL and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $course_id = $_GET['id'];
    
    // Fetch current details of the course
    $query = "SELECT * FROM `course` WHERE `id` = $course_id";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo '<p class="text-danger">Error fetching course details: ' . mysqli_error($con) . '</p>';
        exit;
    }

    // Check if the course exists
    if (mysqli_num_rows($result) == 1) {
        $course = mysqli_fetch_assoc($result);
    } else {
        echo '<p class="text-danger">Course not found.</p>';
        exit;
    }
} else {
    echo '<p class="text-danger">Invalid Course ID.</p>';
    exit;
}

// Handle form submission for updating the course
if (isset($_POST['Update'])) {
    // Sanitize inputs to prevent SQL injection
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $discount = mysqli_real_escape_string($con, $_POST['discount']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    // Update the course in the database
    $updateQuery = "UPDATE `course` SET `title` = '$title', `price` = '$price', `discount` = '$discount', `content` = '$content' WHERE `id` = $course_id";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        echo '<script>alert("Course updated successfully"); window.location.href="view_course.php";</script>';
    } else {
        echo '<p class="text-danger">Error updating course: ' . mysqli_error($con) . '</p>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
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
    <a href="view_courses.php">View Courses</a>
</div>

<!-- Main Content -->
<div class="content">
    <!-- Update Course Form -->
    <div class="form-container">
        <h2>Update Course</h2>
        <form method="POST" action="">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($course['title']); ?>" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($course['price']); ?>" required>

            <label for="discount">Discount:</label>
            <input type="number" id="discount" name="discount" value="<?php echo htmlspecialchars($course['discount']); ?>" required>

            <label for="content">Description:</label>
            <textarea id="content" name="content" rows="5" required><?php echo htmlspecialchars($course['content']); ?></textarea>

            <button type="submit" name="Update">Update Course</button>
        </form>
    </div>
</div>

</body>
</html>
