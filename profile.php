<?php
$page_name = "Profile";
include './includes/includes.php';
// Import Navbar
// 
include './includes/navbar.php';

// Initialize variables
$FirstName = $LastName = $Email = $ContactNumber = '';
$inProgressRepairs = [];
$completedRepairCount = 0;

// Fetch technician details
$sql = "SELECT * FROM Technicians WHERE TechnicianID = $tec_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $FirstName = $row["FirstName"];
    $LastName = $row["LastName"];
    $Email = $row["Email"];
    $ContactNumber = $row["ContactNumber"];
}

// Fetch in-progress repairs
$sql = "SELECT * FROM Repairs WHERE TechnicianID = $tec_id AND RepairStatus='In Progress'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $RepairID = $row["RepairID"];
        $RepairDate = $row["RepairDate"];
        $RepairStatus = $row["RepairStatus"];
        $DeviceID = $row["DeviceID"];

        $dev_sql = "SELECT * FROM Devices WHERE DeviceID = $DeviceID";
        $dev_result = $conn->query($dev_sql);
        if ($dev_result->num_rows > 0) {
            $dev_row = $dev_result->fetch_assoc();
            $row["DeviceType"] = $dev_row["DeviceType"];
            $row["Brand"] = $dev_row["Brand"];
            $row["Model"] = $dev_row["Model"];
            $row["RepairDescription"] = $dev_row["RepairDescription"];
        }

        $inProgressRepairs[] = $row;
    }
}

// Fetch count of completed repairs
$sql = "SELECT COUNT(*) as count FROM Repairs WHERE TechnicianID = $tec_id AND RepairStatus='Completed'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $completedRepairCount = $row["count"];
}
?>
<body>
    <?php
    ?>

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Repair ID</th>
                    <th>Device Type</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Description</th>
                    <th>Repair Date</th>
                    <th>Repair Status</th>
                    <th>Submit</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php if (count($inProgressRepairs) > 0): ?>
                    <?php foreach ($inProgressRepairs as $repair): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($repair["RepairID"]); ?></td>
                            <td><?php echo htmlspecialchars($repair["DeviceType"]); ?></td>
                            <td><?php echo htmlspecialchars($repair["Brand"]); ?></td>
                            <td><?php echo htmlspecialchars($repair["Model"]); ?></td>
                            <td><?php echo htmlspecialchars($repair["RepairDescription"]); ?></td>
                            <td><?php echo htmlspecialchars($repair["RepairDate"]); ?></td>
                            <td><?php echo htmlspecialchars($repair["RepairStatus"]); ?></td>
                            <td>
                                <a href="submit_order.php?RepairID=<?php echo htmlspecialchars($repair["RepairID"]); ?>">
                                    <button class="btn text-light" style="background-color: #4723D9;">Submit</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8"><strong>There is No result!</strong></td></tr>
                <?php endif; ?>
            </tbody>
        </table>


        <script>
            new DataTable('#example');
        </script>

</body>
</html>
