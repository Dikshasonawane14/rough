<?php
include 'connection.php'; // Include the database connection file

// Fetch all courses from the database
$query = "SELECT * FROM `course`";
$result = mysqli_query($con, $query);

if (!$result) {
    echo '<p class="text-danger">Error fetching courses: ' . mysqli_error($con) . '</p>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Courses</title>
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

        .card {
            margin-bottom: 20px;
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
    <a href="course.php">Add New Course</a>
</div>

<!-- Main Content -->
<div class="content">
    <h1>All Courses</h1>
    <div class="row">
        <?php
        // Loop through each course and display it as a card
        while ($course = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                        <p class="card-text">
                            <strong>Price:</strong> $<?php echo htmlspecialchars($course['price']); ?><br>
                            <strong>Discount:</strong> <?php echo htmlspecialchars($course['discount']); ?>%<br>
                            <strong>Description:</strong> <?php echo htmlspecialchars($course['content']); ?>
                        </p>
                        <a href="update_course.php?id=<?php echo $course['id']; ?>" class="btn btn-primary">Edit</a>
                        <!-- Delete Button -->
                        <a href="delete_course.php?id=<?php echo $course['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

</body>
</html>
