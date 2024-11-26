<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    /* General Styling */
    body {
      display: flex;
      min-height: 100vh;
      margin: 0;
      background-color: #f8f9fa;
    }

    .sidebar {
      width: 250px;
      background-color: #343a40;
      color: #fff;
      min-height: 100vh;
      padding-top: 20px;
      transition: width 0.3s ease;
    }

    .sidebar.collapsed {
      width: 80px;
    }

    .sidebar .nav-link {
      color: #ccc;
      font-size: 16px;
    }

    .sidebar .nav-link i {
      margin-right: 10px;
    }

    .sidebar .nav-link:hover, .sidebar .nav-link.active {
      background-color: #495057;
      color: #fff;
    }

    .sidebar h2 {
      text-align: center;
      font-size: 1.25rem;
    }

    .sidebar-toggle {
      display: none;
      position: fixed;
      top: 15px;
      left: 15px;
      font-size: 1.5rem;
      background: #343a40;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      z-index: 1000;
    }

    .content {
      flex-grow: 1;
      padding: 20px;
      margin-left: 250px;
      transition: margin-left 0.3s ease;
    }

    .content.collapsed {
      margin-left: 80px;
    }

    .card-container {
      display: flex;
      gap: 20px;
      margin-top: 20px;
      flex-wrap: wrap;
    }

    .card {
      flex: 1 1 calc(50% - 20px);
      padding: 15px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 300px;
    }

    .card h3 {
      font-size: 1.25rem;
      margin: 0;
      color: #333;
    }

    .card p {
      font-size: 1.75rem;
      font-weight: bold;
      color: #4CAF50;
      margin: 10px 0 0;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        z-index: 100;
        height: 100vh;
        left: -250px;
        transition: left 0.3s ease;
      }

      .sidebar.open {
        left: 0;
      }

      .sidebar-toggle {
        display: block;
      }

      .content {
        margin-left: 0;
        padding-top: 60px;
      }

      .card-container {
        flex-direction: column;
        align-items: center;
      }

      .card {
        max-width: 90%;
      }
    }
  </style>
</head>
<body>

  <?php
    // Include database connection
    include("connection.php");

    // Fetch the total number of courses
    $courseCountQuery = "SELECT COUNT(*) as total_courses FROM course";
    $courseCountResult = mysqli_query($con, $courseCountQuery);
    $courseCount = mysqli_fetch_assoc($courseCountResult)['total_courses'];

    // Fetch the total number of blog posts
    $blogCountQuery = "SELECT COUNT(*) as total_posts FROM blog_post";
    $blogCountResult = mysqli_query($con, $blogCountQuery);
    $blogCount = mysqli_fetch_assoc($blogCountResult)['total_posts'];
  ?>

  <!-- Sidebar Toggle Button for Smaller Screens -->
  <div class="sidebar-toggle" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
  </div>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <h2>Admin Dashboard</h2>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="course.php">
          <i class="fas fa-book"></i> Add Course
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view_course.php">
          <i class="fas fa-book-open"></i> Manage Courses
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="blog.php">
          <i class="fas fa-pen"></i> Add Blog Post
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view.php">
          <i class="fas fa-clipboard-list"></i> Manage Blog Posts
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fa fa-home"></i> Home
        </a>
      </li>
    </ul>
  </div>

  <!-- Main Content Area -->
  <div class="content" id="content">
    <h1>Welcome to the Admin Dashboard</h1>
    <p>Select an option from the sidebar to manage courses or blog posts.</p>

    <!-- Cards to show total counts -->
    <div class="card-container">
      <div class="card">
        <h3>Total Courses</h3>
        <p><?php echo $courseCount; ?></p>
      </div>
      <div class="card">
        <h3>Total Blog Posts</h3>
        <p><?php echo $blogCount; ?></p>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS, jQuery, and Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Sidebar Toggle Script -->
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      const content = document.getElementById("content");
      if (window.innerWidth <= 768) {
        sidebar.classList.toggle("open");
      } else {
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("collapsed");
      }
    }
  </script>
</body>
</html>
