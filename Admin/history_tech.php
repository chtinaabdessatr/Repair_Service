<?php
$page_name="Technicians History Of Repairs";
include './includes/includes.php';
?>
<body>
    <center>
        <h1>My History</h1>
        <?php include './includes/navbar.php';?>
        <?php
         $tecneciansid= $_GET["TechnecianID"];
                $sql = "SELECT COUNT(*) as count FROM Repairs WHERE TechnicianID = $tecneciansid AND RepairStatus='Completed'";
                $result = $conn->query($sql);
        
                if ($result->num_rows > 0) {
                // Assuming there is only one row returned
                $row = $result->fetch_assoc();
                $pics = $row["count"];
                } 

        $sql = "SELECT *  FROM Technicians WHERE TechnicianID = $tecneciansid";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
              $row = $result->fetch_assoc();
              $FirstName = $row["FirstName"];
              $LastName = $row["LastName"];
              $Email = $row["Email"];
              $ContactNumber = $row["ContactNumber"];}
              
  echo'<table class="data">
  <tr>
      <th>Name:</th>
      <td>'.$FirstName.' '.$LastName.'</td>
  </tr>
  <tr>
      <th>Email:</th>
      <td>'.$Email.'</td>
  </tr>
  <tr>
      <th>Repairs:</th>
      <td>'.$pics.'</td>
  </tr>
</table>';
        ?>
        <table>
            <tr>
                <th>RepairID</th>
                <th>DeviceID</th>
                <th>Repair Date</th>
                <th>Repair Status</th>
                <th>Repair Description</th>
                <th>Repair Cost</th>
            </tr>
            <?php
              $sql = "SELECT *  FROM repairs WHERE TechnicianID = $tecneciansid";
              $result = $conn->query($sql);
                if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $RepairID = $row["RepairID"];
                    $DeviceID = $row["DeviceID"];
                    $RepairDate = $row["RepairDate"];
                    $RepairStatus = $row["RepairStatus"];
                    $RepairDescription = $row["RepairDescription"];
                    $RepairCost = $row["RepairCost"];
                    $TechnicianID = $row["TechnicianID"];

                    echo '<tr>
                    <td>
                        '.$RepairID .'
                    </td>
                    <td>
                        '.$DeviceID .'
                    </td>
                    <td>
                        '.$RepairDate.'
                    </td>
                    <td>
                        '.$RepairStatus.'
                     </td>
                     <td>
                         '.$RepairDescription.'
                    </td>
                    <td>
                        '.$RepairCost.'
                    </td>
                    </tr>';
                }   } else{echo"There is No Repairs in the History!!";}
            ?>
        </table>
</center>
</body>
</html>