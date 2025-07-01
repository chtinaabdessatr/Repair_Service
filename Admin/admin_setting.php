<?php
$page_name="Add New Technician";
include './includes/includes.php';
include './includes/navbar.php';


$sql = "SELECT *  FROM `admin` WHERE aid = $tec_id";
$result = $conn->query($sql);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input fields
  $pin = $_POST['PIN'];

  $sql = "UPDATE `admin` SET `apin`='$pin' WHERE aid=$tec_id";
    
  // Execute the query
  if ($conn->query($sql) === TRUE) {
      echo "Order posted successfully";
  } else {
      echo "Error inserting record: " . $conn->error;
  }
}


?>
<body>

<h3>Change PIN</h3>

<div class="row">
    <form action="#" method="post" style="padding: 10px; border: none;">
      <?php
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $aname = $row["aname"];
        }
        echo '
        <div class="row mb-3">
          <div class="col">
            <label for="FirstName"><b>' . $aname . '</b></label>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <label for="psw"><b>New PIN:</b></label>
            <input type="password" class="form-control" placeholder="Enter Password" name="PIN" required>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <button type="submit" class="btn text-light" style="background-color: #4723D9;">Change PIN</button>
          </div>
        </div>';
        $conn->close();
      ?>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>