<?php
$page_name="Order Material";
include './includes/includes.php';
include './includes/navbar.php';

$msg = "";

$sql = "SELECT *  FROM Order_Material WHERE TechnicianID = $tec_id ORDER BY order_id DESC ";
$result = $conn->query($sql);




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $material_name = $_POST["material_name"];
    $quantity = $_POST["quantity"];
    $supplier = $_POST["supplier"];
    $delivery_date = $_POST["delivery_date"];
    
    // Construct the SQL query
    $sql = "INSERT INTO Order_Material (material_name, quantity, supplier,delivery_date, TechnicianID) VALUES ('$material_name', '$quantity', '$supplier', '$delivery_date', '$tec_id')";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // header('location '.$_SERVER['REQUEST_URI']);
        $msg = "Order posted successfully!";
    } else {
        $msg = "Error inserting record: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
}




?>

<body>
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

    <button type="button" class="btn text-light" style="background-color: #4723D9;" data-toggle="modal" data-target=".bd-example-modal-lg">New Order</button>

    <form method="POST">
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div style="padding: 20px; border-radius: 10px;
                        background: rgba(255, 255, 255, 0);
                        border-radius: 16px;
                        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                        backdrop-filter: blur(8px);
                        -webkit-backdrop-filter: blur(8px);
                        border: 1px solid rgba(255, 255, 255, 0.3);
                        color: white;
                        " class="modal-content">


        
            <div class="form-group">
                <label for="material_name">Material Name:</label>
                <input type="text" class="form-control" id="material_name" name="material_name" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="supplier">Supplier:</label>
                <input type="text" class="form-control" id="supplier" name="supplier" required>
            </div>
            <div class="form-group">
                <label for="delivery_date">Expected Delivery Date:</label>
                <input type="date" class="form-control" data-date-format="yyyy/mm/dd" id="delivery_date" name="delivery_date" required>
            </div>
            <button type="submit" class="btn text-light" style="background-color: #4723D9;">Submit Order</button>

</div>
</div>

</div>
</form>

        <?php
        echo'                    <table id="example" class="table table-striped" style="width:100%">
        <tr>
            <th>order_id</th>
            <th>material_name</th>
            <th>quantity</th>
            <th>supplier</th>
            <th>order_date</th>
            <th>delivery_date</th>
            <th>Statue</th>
        </tr>';
              if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                    $order_id = $row["order_id"];
                    $material_name = $row["material_name"];
                    $quantity = $row["quantity"];
                    $supplier = $row["supplier"];
                    $order_date = $row["order_date"];
                    $delivery_date = $row["delivery_date"];
                    $statue = $row["Statue"];

                    echo '

                    <tr>
                    <td>
                        '.$order_id .'
                    </td>
                    <td>
                    '.$material_name.'
                </td>
                <td>
                '.$quantity.'
            </td>
            <td>
            '.$supplier.'
        </td>
        <td>
        '.$order_date.'
    </td>
                    <td>
                        '.$delivery_date.'
                    </td>
                    <td>
                    '.$statue.'
                </td>
                    </tr>';
                }    
            }else{
                echo'<strong>There is No result!</stong>';
            }
            ?> </table>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>