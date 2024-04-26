<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .logo-container {
      background-color: #007bff; /* Blue background color */
      padding: 20px; /* Add padding for better visual separation */
      color: #fff; /* Text color for contact information */
      border-bottom-left-radius: 10px; /* Rounded corners */
      border-bottom-right-radius: 10px; /* Rounded corners */
    }

    .logo {
      width: 200px;
      height: auto;
    }

    .nav-link {
      color: #090909;
    }

    .nav-link:hover {
      color: #007bff; /* Change to blue on hover */
    }

    .nav-link.active {
      background-color: #0056b3;
    }

    .college-title {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin-top: 10px; /* Adjust spacing from logo */
    }

    #main-nav {
      background-color: #E6F7FF;
      padding: 10px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <!-- Top row for logo and college title -->
    <div class="row">
      <div class="col-md-12">
        <div class="logo-container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <img src="MQMLogo.png" alt="Logo" class="logo">
            </div>
            <div class="col-md-6">
              <p class="college-title"> MQM College of Cyber Security Engineering and Technology Administration Portal </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-right">
              <p>Contact: +123456789 | Email: info@mqmcollege.com</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Second row for navigation options -->
    <div id="main-nav" class="row align-items-center">
      <div class="col">
        <nav class="nav nav-pills flex-column flex-sm-row">
          <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="modules.php">My Modules</a>
          <a class="flex-sm-fill text-sm-center nav-link" href="student.php">Student Details</a>
          <a class="flex-sm-fill text-sm-center nav-link" href="AddStudent.php">Add New Student</a>
          <a class="flex-sm-fill text-sm-center nav-link" href="assignmodule.php">Assign Module</a>
          <a class="flex-sm-fill text-sm-center nav-link" href="details.php">My Details</a>
          <a class="flex-sm-fill text-sm-center nav-link" href="logout.php">Logout</a>
        </nav>
      </div>
    </div>
  </div>
</body>
</html>
