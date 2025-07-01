<?php
$page_name="Add Order";
include './includes/includes.php';
include './includes/navbar.php';


$sql = "SELECT *  FROM Repairs WHERE TechnicianID = $tec_id AND RepairStatus='Completed'";
$result = $conn->query($sql);

?>
<body>
        <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                        <th>RepairID</th>
                        <th>DeviceID</th>
                        <th>Repair Date</th>
                        <th>Repair Status</th>
                        <th>Repair Description</th>
                        <th>Repair Cost</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                $RepairID = $row["RepairID"];
                                $DeviceID = $row["DeviceID"];
                                $RepairDate = $row["RepairDate"];
                                $RepairStatus = $row["RepairStatus"];
                                $RepairDescription = $row["RepairDescription"];
                                $RepairCost = $row["RepairCost"];
                                $TechnicianID = $row["TechnicianID"];

                                echo '
                                    <tr>
                                        <td>'.$RepairID .'</td>
                                        <td>'.$DeviceID .'</td>
                                        <td>'.$RepairDate.'</td>
                                        <td>'.$RepairStatus.'</td>
                                        <td>'.$RepairDescription.'</td>
                                        <td>'.$RepairCost.'</td>
                                    </tr>';
                            }
                        }else{
                            echo '<tr><td colspan="6"><strong>There is No result!</strong></td></tr>';
                        } 
                        ?>
        </table>
</body>
</html>