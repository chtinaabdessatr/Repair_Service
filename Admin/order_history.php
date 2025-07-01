<?php
$page_name="Profile";
include './includes/includes.php';
?> <style>
    .data th, .data td{border:none;}
    
</style>

<body>
        <?php
        include './includes/navbar.php';
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
        <?php
        echo'                    <table class="table table-striped table-bordered">
        <tr>
            <th>order_id</th>
            <th>material_name</th>
            <th>quantity</th>
            <th>supplier</th>
            <th>order_date</th>
            <th>delivery_date</th>
            <th>TechnicianID</th>
            <th>Statue</th>
        </tr>';
              $sql = "SELECT *  FROM Order_Material ORDER BY order_id DESC ";
              $result = $conn->query($sql);
              if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                    $order_id = $row["order_id"];
                    $material_name = $row["material_name"];
                    $quantity = $row["quantity"];
                    $supplier = $row["supplier"];
                    $order_date = $row["order_date"];
                    $statue = $row["Statue"];
                    $delivery_date = $row["delivery_date"];
                    $TechnicianID = $row["TechnicianID"];

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
                    '.$TechnicianID.'
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
</body>

</html>