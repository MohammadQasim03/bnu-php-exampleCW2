<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
</head>
<style>
    body {
      background-color: #46699F; /* Light Blue */
    }
    .container {
      background-color: #E6F7FF; /* White */
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center; /* Center align content */
    }
    .btn-primary {
      background-color: #007bff; /* Blue */
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3; /* Darker Blue */
      border-color: #0056b3;
    }
    .logo {
      margin-bottom: 20px;
    }
    .logo img {
      max-width: 350px; /* Adjust image width */
      height: auto;
    }   .form-container {
      max-width: 400px; /* Adjust form container width */
      margin: 0 auto; /* Center align form container */
    }
  </style>
<body>

<div class="container mt-5">
  <div class="logo">
    <img src="MQMLogo.png" alt="Logo">
  </div>

  <h2 class="welcome-heading"> MQM College's Login Portal Administration</h2>
  
  <?php
  if (!empty($message)) {
      echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
  }
  ?>

  <form name="frmLogin" action="authenticate.php" method="post" class="mt-5">
    <div class="mb-3">
      <label for="txtid" class="form-label">Student ID</label>
      <input type="text" class="form-control" id="txtid" name="txtid">
    </div>
    <div class="mb-3">
      <label for="txtpwd" class="form-label">Password</label>
      <input type="password" class="form-control" id="txtpwd" name="txtpwd">
    </div>
    <input type="submit" name="btnlogin" class="btn btn-primary" value="Login" />
  </form>
</div>


</body>
</html>
