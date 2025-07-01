<?php
$page_name="Add New Technician";
include './includes/includes.php';
include './includes/navbar.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input fields
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $ContactNumber = $_POST['ContactNumber'];
  $Email = $_POST['Email'];
  $pin = $_POST['psw'];

  // prepare and bind sql statement
  $stmt = $conn->prepare("INSERT INTO Technicians (FirstName, LastName, ContactNumber, Email,PIN) VALUES (?, ?, ?, ?,$pin)");
  $stmt->bind_param("ssss", $FirstName, $LastName, $ContactNumber, $Email);

  // validate inputs to prevent SQL injection attacks
  $FirstName = mysqli_real_escape_string($conn, $FirstName);
  $LastName = mysqli_real_escape_string($conn, $LastName);
  $ContactNumber = mysqli_real_escape_string($conn, $ContactNumber);
  $Email = mysqli_real_escape_string($conn, $Email);

  // execute sql statement
  if ($stmt->execute() === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $stmt->error;
  }

  // close statement and connection
  $stmt->close();
  $conn->close();
}




?>
<body>
  
<h3>Add New Technician</h3>

<div class="row">
  <form action="#" method="post" style="padding: 10px; border: none;">
    <div class="form-group">
      <label for="FirstName"><b>First Name:</b></label>
      <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="First Name" required>
    </div>
    <div class="form-group">
      <label for="LastName"><b>Last Name:</b></label>
      <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Last Name">
    </div>
    <div class="form-group">
      <label for="ContactNumber"><b>Contact Number:</b></label>
      <input type="text" class="form-control" id="ContactNumber" name="ContactNumber" placeholder="Contact Number">
    </div>
    <div class="form-group">
      <label for="Email"><b>Email:</b></label>
      <input type="email" class="form-control" id="Email" name="Email" placeholder="Email">
    </div>
    <div class="form-group">
      <label for="psw"><b>Password:</b></label>
      <input type="password" class="form-control" id="psw" name="psw" placeholder="Enter Password" required>
    </div>
    <button type="submit" class="btn text-light" style="background-color: #4723D9;" >Register</button>
  </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>