<?php
$page_name="Profile";
include './includes/includes.php';
include './includes/navbar.php';



$sql = "SELECT *  FROM Order_Material WHERE Statue= 'Pending' ORDER BY order_id DESC ";
$result = $conn->query($sql);


if(isset($_GET["order_id"])){
    $order_id = $_GET["order_id"];
    $sql = "UPDATE `order_material` SET `Statue`='Completed' WHERE `order_id` = $order_id"; 

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
      echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . $conn->error;
    }
}


?>

<body>
        <h3>My Profile</h3> 

        <div class="container mt-5">
  <?php
  echo '<table class="table table-striped table-bordered">
  <thead class="thead-dark">
    <tr>
      <th>Order ID</th>
      <th>Material Name</th>
      <th>Quantity</th>
      <th>Supplier</th>
      <th>Order Date</th>
      <th>Delivery Date</th>
      <th>Technician ID</th>
      <th>Completed</th>
    </tr>
  </thead>
  <tbody>';

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $order_id = $row["order_id"];
      $material_name = $row["material_name"];
      $quantity = $row["quantity"];
      $supplier = $row["supplier"];
      $order_date = $row["order_date"];
      $delivery_date = $row["delivery_date"];
      $TechnicianID = $row["TechnicianID"];

      echo '
      <tr>
        <td>' . $order_id . '</td>
        <td>' . $material_name . '</td>
        <td>' . $quantity . '</td>
        <td>' . $supplier . '</td>
        <td>' . $order_date . '</td>
        <td>' . $delivery_date . '</td>
        <td>' . $TechnicianID . '</td>
        <td><a href="?order_id=' . $order_id . '" class="btn btn-success btn-sm">Completed</a></td>
      </tr>';
    }    
  } else {
    echo '<tr><td colspan="8" class="text-center"><strong>There is no result!</strong></td></tr>';
  }
  echo '</tbody></table>';
  ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>