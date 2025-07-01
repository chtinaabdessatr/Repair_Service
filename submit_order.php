<?php
$page_name = "Submit the Assignment";
include './includes/includes.php';
include './includes/navbar.php';

$RepairID = $_GET["RepairID"];
$sql      = "SELECT * FROM Repairs WHERE RepairID = $RepairID";
$result   = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $RepairDescription = $_POST["RepairDescription"];
    $Repaircost        = $_POST["cost"];
    $RepairStatus      = $_POST["statue"];
    
    // Construct the SQL query
    $sql = "UPDATE Repairs SET RepairDescription = '$RepairDescription', RepairStatus = '$RepairStatus', RepairCost = $Repaircost WHERE RepairID = $RepairID AND TechnicianID = '$tec_id'";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Order Submitted successfully";
    } else {
        echo "Error inserting record: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_name; ?></title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <?php
    if ($result->num_rows > 0) {
        $row               = $result->fetch_assoc();
        $DeviceID          = $row["DeviceID"];
        $RepairDate        = $row["RepairDate"];
        $RepairStatus      = $row["RepairStatus"];
        $RepairDescription = $row["RepairDescription"];
        $RepairCost        = $row["RepairCost"];
        
        $dev_sql    = "SELECT * FROM Devices WHERE DeviceID = $DeviceID";
        $dev_result = $conn->query($dev_sql);
        if ($dev_result->num_rows > 0) {
            $dev_row    = $dev_result->fetch_assoc();
            $Brand      = $dev_row["Brand"];
            $Model      = $dev_row["Model"];
            $CustomerID = $dev_row["CustomerID"];
        }
    ?>
    <div class="row">

    <?php
        if(!empty($msg)){
            echo '
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        ' . $msg . '
                    </div>
                </div>
            ';
        }

    ?>
    
    <form action="#" method="post" class="border p-4 rounded" style="border-color: #4723D9;">
        <div class="form-group">
            <label for="device_name">Name:</label>
            <input type="text" class="form-control" id="device_name" value="<?php echo $Brand . ' ' . $Model; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="statue">Status:</label>
            <select name="statue" id="statue" class="form-control">
                <option value="Completed">Fixed</option>
                <option value="Failed">Failed</option>
            </select>
        </div>
        <div class="form-group">
            <label for="repair_date">Repair Date:</label>
            <input type="text" class="form-control" id="repair_date" value="<?php echo $RepairDate; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="cost">Cost:</label>
            <input type="number" class="form-control" id="cost" name="cost" min="0" step="0.01" value="0.00"> MAD
        </div>
        <div class="form-group">
            <label for="RepairDescription">Repair Description:</label>
            <textarea class="form-control" id="RepairDescription" name="RepairDescription" rows="5" placeholder="Repair Description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    <?php
    } else {
        echo '<strong>There Is No Device</strong>';
    }
    ?>
</div>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>