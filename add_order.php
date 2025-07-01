<?php
$page_name="Add Order";
include './includes/includes.php';
include './includes/navbar.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $RepairDescription = $_POST["RepairDescription"];
    $DeviceType = $_POST["DeviceType"];
    $Brand = $_POST["Brand"];
    $Model = $_POST["Model"];
    $SerialNumber = $_POST["SerialNumber"];
    $Customername = $_POST["Customername"];
    $Customerphone = $_POST["Customerphone"];

    if(isset($Customerphone)){
        $check_customer="SELECT * FROM `customers` WHERE `ContactNumber` = '$Customerphone'";
        $check_result = $conn->query($check_customer);
        if($check_result->num_rows > 0){
           $check_row = $check_result->fetch_assoc();
              $CustomerID = $check_row["CustomerID"];
        }else{

            $sql_customer="INSERT INTO `customers`(`Name`,`ContactNumber`) VALUES ('$Customername','$Customerphone')";
            // Execute the query
            if ($conn->query($sql_customer) === TRUE) {
                $check_customer="SELECT * FROM `customers` WHERE `ContactNumber` = '$Customerphone'";
                $check_result = $conn->query($check_customer);
                if($check_result->num_rows > 0){
                    $check_row = $check_result->fetch_assoc();
                    $CustomerID = $check_row["CustomerID"];
                }
            } else {
                echo "Error inserting record: " . $conn->error;
            }

        }



    }
       
    // Construct the SQL query
    $sql = "INSERT INTO Devices (RepairDescription, DeviceType, Brand, Model, SerialNumber, CustomerID) VALUES ('$RepairDescription', '$DeviceType', '$Brand', '$Model', '$SerialNumber', '$CustomerID')";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $msg =  "Order posted successfully";
    } else {
        $msg = "Error inserting record: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
}


?>


<body>
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
    <form method="POST" style="
                                padding: 15px;
                                border: 1px solid #4723D9;
                                border-radius: 20px;
                                ">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Customername">Customer Name</label>
                    <input type="text" class="form-control" id="Customername" name="Customername">
                </div>
                <div class="form-group">
                    <label for="Customerphone">Customer Phone</label>
                    <input type="text" class="form-control" id="Customerphone" name="Customerphone">
                </div>
                <div class="form-group">
                    <label for="DeviceType">Device Type</label>
                    <select class="form-control" id="DeviceType" name="DeviceType">
                        <option value="Phone" selected>Phone</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Desktop">Desktop</option>
                        <option value="Smartphone">Smartphone</option>
                        <option value="Camera">Camera</option>
                        <option value="Scanner">Scanner</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Brand">Brand</label>
                    <select class="form-control" id="Brand" name="Brand">
                        <option value="Other" selected>Other</option>
                        <option value="Lenovo">Lenovo</option>
                        <option value="Hp">Hp</option>
                        <option value="Dell">Dell</option>
                        <option value="Apple">Apple</option>
                        <option value="Xaomi">Xaomi</option>
                        <option value="Samsung">Samsung</option>
                        <option value="Oppo">Oppo</option>
                        <option value="Vivo">Vivo</option>
                        <option value="Fujutsu">Fujutsu</option>
                        <option value="Infinex">Infinex</option>
                        <option value="Sony">Sony</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Model">Model</label>
                    <input type="text" class="form-control" id="Model" name="Model" placeholder="Model">
                </div>
                <div class="form-group">
                    <label for="SerialNumber">Serial Number</label>
                    <input type="text" class="form-control" id="SerialNumber" name="SerialNumber" placeholder="Serial Number">
                </div>
                <div class="form-group">
                    <label for="RepairDescription">Repair Description</label>
                    <textarea class="form-control" id="RepairDescription" name="RepairDescription" rows="5" placeholder="Repair Description"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn text-light" style="background-color: #4723D9;">Submit</button>
    </form>

</div>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
