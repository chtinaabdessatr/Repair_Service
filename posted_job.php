<?php
$page_name="Add Order";
include './includes/includes.php';
include './includes/navbar.php';


$sql = "SELECT * FROM Devices WHERE DeviceID NOT IN (SELECT DeviceID FROM Repairs)";
$result = $conn->query($sql);


/////////////////////////////////////////////////////////////////
if(isset($_GET["repair_id"])){
    $repair_id=$_GET["repair_id"];
    $check_sql = "SELECT DeviceID FROM Devices WHERE DeviceID = $repair_id";
    $check_result = $conn->query($check_sql);
          if ($check_result->num_rows > 0) {
            $row = $check_result->fetch_assoc();
            $DeviceID = $row["DeviceID"];

            //Execute the inserting proccess of the repair demand after chacking 

                // Construct the SQL query
                $sql = "INSERT INTO Repairs (DeviceID, RepairDate, RepairStatus, TechnicianID) VALUES ($DeviceID, $date, 'In Progress', $tec_id)";
    
                 // Execute the query
                if ($conn->query($sql) === TRUE) {
                      header('location: ./profile.php');
                 } else {
                        echo "Error inserting record: " . $conn->error;
                    }
    
                 // Close the database connection
                $conn->close();
          }
          else{
            echo'<strong>There Is No Device</strong>';
          }
        }



?>
<body>


<table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                <th>ID</th>
                <th>Device Type</th>
                <th>Name And Model</th>
                <th>Repair Description</th>
                <th>Accept</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $DeviceID = $row["DeviceID"];
                            $DeviceType = $row["DeviceType"];
                            $Brand = $row["Brand"];
                            $Model = $row["Model"];
                            $RepairDescription = $row["RepairDescription"];

                        
                    echo '
                        <tr>
                            <td>'.$DeviceID.'</td>
                                <td>'.$DeviceType.'</td>
                                <td>'.$Brand.' '.$Model.'</td>
                                <td>'.$RepairDescription.'</td>
                                <td>
                                    <a class="btn text-light" style="background-color: #4723D9; href="?repair_id='.$DeviceID.'">
                                        Accept
                                    </a>
                                </td>
                        </tr>';
                    }
                }else{
                    echo'<strong>There Is No Posted Jobs Right Now!</strong>';
                }

                
                ?>
            </tbody>
        </table>


        <script>
            new DataTable('#example');
        </script>

</table>

</body>
</html>