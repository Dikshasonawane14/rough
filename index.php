<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Hub</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<style type="text/css">
  /* Basic Styling */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-sizing: border-box;
  }

  header, footer {
    background-color: #4CAF50;
    width: 100%;
    padding: 1em;
    text-align: center;
    color: white;
  }

  #course-list, #blog-section {
    width: 90%;
    max-width: 1200px;
    margin: 1em auto;
  }

  #courses, #blog-posts {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
  }

  .course-item, .blog-item {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 5px;
    width: 100%;
    max-width: 300px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    transition: box-shadow 0.3s;
  }

  .course-item:hover, .blog-item:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .course-item h3, .blog-item h3 {
    color: #333;
    margin-top: 0;
  }

  .course-item p, .blog-item p {
    margin: 0.5em 0;
  }

  .course-item button {
    margin-top: auto;
    background-color: #4CAF50;
    color: white;
    padding: 0.5em 1em;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    align-self: center;
  }

  .course-item button:hover {
    background-color: #45a049;
  }

  /* Responsive Styling */
  @media (max-width: 768px) {
    #course-list, #blog-section {
      width: 95%;
    }
    .course-item, .blog-item {
      max-width: 100%;
    }
  }
</style>

<body>
  <!-- Header Section with Flexbox Layout -->
  <header class="bg-dark text-white d-flex justify-content-between align-items-center p-3">
    <!-- Title Centered -->
    <div class="flex-grow-1 text-center">
      <h1 class="m-0">Welcome to Course Hub</h1>
    </div>
    
    <!-- Admin Button that links directly to another page -->
    <nav class="navbar navbar-dark bg-dark ml-auto">
      <a href="dashboard.php" class="btn btn-secondary" role="button">Admin</a>
    </nav>
  </header>

  <!-- Course List Section -->
  <section id="course-list">
    <h2>Discounted Courses</h2>
    <div id="courses">
      <?php
        // Database connection
        include("connection.php");

        // Query to fetch courses from the database
        $sql = "SELECT * FROM course WHERE discount IS NOT NULL AND discount > 0";
        $result = mysqli_query($con, $sql);

        // Loop through the results and display each course
        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="course-item">';
            echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
            echo '<p><strong>Price:</strong> $' . htmlspecialchars($row['price']) . '</p>';
            echo '<p><strong>Discount:</strong> ' . htmlspecialchars($row['discount']) . '% off</p>';
            echo '<p>' . htmlspecialchars($row['content']) . '</p>';
            echo '<button onclick="redirectToPayment(\'' . htmlspecialchars($row['title']) . '\')">Select Course</button>';
            echo '</div>';
          }
        } else {
          echo '<p>No discounted courses available at the moment.</p>';
        }
      ?>
    </div>
  </section>

  <!-- Blog Section -->
  <section id="blog-section">
    <h2>Latest Blog Posts</h2>
    <div id="blog-posts">
      <?php
        // Query to fetch blog posts from the database
        $sql = "SELECT * FROM blog_post";
        $res = mysqli_query($con, $sql);

        // Loop through the results and display each blog post
        while ($row = mysqli_fetch_assoc($res)) {
          echo '<div class="blog-item">';
          echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
          echo '<p>' . htmlspecialchars($row['content']) . '</p>';
          echo '</div>';
        }
      ?>
    </div>
  </section>

  <!-- <footer>
    <p>© 2024 Course Hub</p>
  </footer> -->

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <script>
    // Redirect to payment page
    function redirectToPayment(courseName) {
      alert(`You selected ${courseName}. Redirecting to payment...`);
      window.location.href = "payment.php";
    }
  </script>
</body>
</html>
