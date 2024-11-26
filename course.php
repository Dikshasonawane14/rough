<?php
// Include database connection
include 'connection.php';

// Handle form submission for adding a new course
if (isset($_POST['Submit'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $discount = mysqli_real_escape_string($con, $_POST['discount']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    // Insert the new course into the database
    $query = "INSERT INTO `course`(`title`, `price`, `discount`, `content`) VALUES ('$title', '$price', '$discount', '$content')";
    $data = mysqli_query($con, $query);

    // Display success or failure message
    if ($data) {
        echo '<script>alert("Course Added Successfully");
        window.location.href="view_course.php";</script>';
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
    <title>Dashboard - Course Management</title>
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
    <a href="view_course.php">View Courses</a>
</div>

<!-- Main Content -->
<div class="content">
    <!-- Course Management Form -->
    <div class="form-container">
        <h2>Add a New Course</h2>
        <form method="POST" action="">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>

            <label for="discount">Discount:</label>
            <input type="number" id="discount" name="discount" required>

            <label for="content">Description:</label>
            <textarea id="content" name="content" rows="5" required></textarea>

            <button type="submit" name="Submit">Add Course</button>
        </form>
    </div>
</div>

</body>
</html>
