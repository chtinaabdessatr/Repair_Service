<?php
$page_name="Profile";
include './includes/includes.php';
include './includes/navbar.php';


$sql = "SELECT *  FROM technicians";
$result = $conn->query($sql);


if(isset($_GET["delID"])){
    $del_id = $_GET["delID"];
    $sql = "DELETE FROM technicians WHERE TechnicianID = $del_id";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
      echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . $conn->error;
    }
}

?>

<body>

<table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>TechnicianID</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>ContactNumber</th>
                    <th>Email</th>
                    <th>PIN</th>
                    <th>History</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                    if($result->num_rows > 0){
                      while($row = $result->fetch_assoc()){
                        $TechnicianID = $row["TechnicianID"];
                        $FirstName = $row["FirstName"];
                        $LastName = $row["LastName"];
                        $ContactNumber = $row["ContactNumber"];
                        $Email = $row["Email"];
                        $PIN = $row["PIN"];
                        echo'
                            <tr>
                            <td>' . $TechnicianID . '</td>
                            <td>' . $FirstName . '</td>
                            <td>' . $LastName . '</td>
                            <td>' . $ContactNumber . '</td>
                            <td>' . $Email . '</td>
                            <td>' . $PIN . '</td>
                            <td>
                                <a href="history_tech.php?TechnecianID='.$TechnicianID .'"><Button class="btn text-light" style="margin: 5px; background-color: #4723D9;">History</Button></a>
                                <a href="dashboard.php?delID='.$TechnicianID .'"><Button class="btn btn-danger" style="margin: 5px;">delete</Button></a>
                            </td>
                            </tr>
                        ';
                      }
                    }else{
                        echo'<tr><td colspan="8"><strong>There is No result!</strong></td></tr>';
                    }
                ?>
            </tbody>
</body>

</html>