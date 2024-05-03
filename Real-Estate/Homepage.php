<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Website</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Add your styles here */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .top-bar {
      /* Styles for your top bar */
      /* ... */
      z-index: 2; /* Ensure top-bar is above carousel */
      position: relative; /* Position it relative to other elements */
    }

    .main-nav {
      /* Styles for your navigation */
      /* ... */
      z-index: 2; /* Ensure navigation is above carousel */
      position: relative; /* Position it relative to other elements */
    }

    .image-carousel {
      position: relative; /* Position it relative to other elements */
      height: 300px; /* Set the height of your image carousel */
      overflow: hidden; /* Hide overflow of images */
    }

    .image-carousel img {
      width: 100%; /* Set the width to fit the container */
      height: auto; /* Maintain aspect ratio */
      position: absolute; /* Position images absolutely */
      top: 0;
      left: 0;
      opacity: 0;
      transition: opacity 1s ease-in-out; /* Transition effect */
    }

    /* Search box styles */
    .property-search {
      /* Styles for property search */
      /* ... */
      z-index: 2; /* Ensure search box is above carousel */
      position: relative; /* Position it relative to other elements */
    }

    /* Property listings styles */
    .property-listings {
      /* Styles for property listings */
      /* ... */
      z-index: 2; /* Ensure property listings are above carousel */
      position: relative; /* Position it relative to other elements */
    }

    .property-slider {
      /* Styles for property slider */
      /* ... */
      display: flex;
    }

    .property-box {
      /* Styles for property boxes */
      /* ... */
      flex: 0 0 auto;
      padding: 10px;
      /* ... */
    }
  </style>
</head>
<body>
  <body>
  <!-- Blue horizontal box for hotline, location, login, register -->
  <div class="top-bar">
   <!-- Hotline number -->
    <span class="hotline">Hotline: 123-456-789</span>
    <!-- Location of the agency -->
    <span class="location">Location: 15/2,Banani Dhaka</span>
    <!-- Login and Register links -->
    <div class="login-register">
      <a href="MVC/Views/SigninView.php">Login</a>
      <a href="Icon.php">Register</a>
    </div>
  </div>

  <!-- Navigation menu -->
  <nav class="main-nav">
    <ul>
      <li><a href="Homepage.php">Home</a></li>
      <li><a href="properties.php">Property</a></li>
      <li><a href="MVC/Controller/ADController.php">Agent</a></li>
      <li><a href="about.html">About Us</a></li>
    </ul>
  </nav>

  <!-- Image carousel -->
  <div class="image-carousel">
    <!-- Add your images with different URLs -->
    <img src="back1.jpg" alt="Image 1">
    <img src="back2.jpg" alt="Image 2">
    <img src="back3.jpg" alt="Image 3">
    <!-- Add more images as needed -->

    <!-- JavaScript for image slideshow -->
    <script>
      const images = document.querySelectorAll('.image-carousel img');
      let index = 0;

      function showImage() {
        images.forEach(image => image.style.opacity = 0);
        images[index].style.opacity = 1;

        index = (index + 1) % images.length;
        setTimeout(showImage, 3000); // Change image every 3 seconds
      }

      showImage();
    </script>
  </div>

  <!-- Search box for property search -->
  <div class="property-search">
        <form action="search.php" method="GET">
      <input type="text" name="property_status" placeholder="Property Status">
      <input type="text" name="property_price" placeholder="Property Price">
      <!-- Other search input fields -->
      <input type="submit" value="Search">
    </form>
  </div>

  <div class="property-listings">
    <div class="property-slider">
      <div class="property-slider">
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "maishara";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM listing WHERE verified = 1 AND decision = 'approved'";
      $result = mysqli_query($conn, $sql);

      if ($result) {
          while ($property = mysqli_fetch_assoc($result)) {
              // Hyperlink to PropertyDetails.php within a box
              echo "<div class='property-box'>";
              echo "<fieldset style='background-color: rgba(255, 255, 255, 0.9); padding: 10px;'>";
              echo "<h2><a href='Property_details.php?location={$property['location']}'>{$property['title']}</a></h2>";
              echo "</fieldset>";
              echo "</div>";
          }
      }
      ?>
    </div>
  </div>

  <!-- Other content of your homepage -->

  <!-- JavaScript for sliding effect -->
  <script>
    let propertySlider = document.querySelector('.property-slider');

    function slideProperties() {
      setInterval(() => {
        propertySlider.scrollLeft += propertySlider.clientWidth;
      }, 2000); // Change property every 2 seconds
    }

    slideProperties();
  </script>

  <!-- Other content of your homepage -->
</body>
</html>
