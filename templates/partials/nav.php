<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professional Navigation Bar</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    #main-nav {
      background-color: #E6F7FF;
      padding: 10px;
    }

    .logo {
      width: 200px;
      height: auto;
    }

    .nav-link {
      color: #090909;
    }

    .nav-link:hover {
      color: #46699F;
    }
    .nav-link.active {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div id="main-nav" class="row align-items-center">
      <div class="col-auto">
        <img src="MQMLogo.png" alt="Logo" class="logo">
      </div>
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
