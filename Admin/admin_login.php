<?php
$page_name="Admin Login";
include './includes/includes_ns.php';
?>
<body>
<center>
  
<h1>Admin Login</h1>

<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $pin = $_POST["pin"];
    $aid = $_POST["id"];

    $sql="SELECT * FROM admin WHERE aid='$aid'";
            $result=$conn->query($sql);
            if($result->num_rows>0)
            {
                $row=$result->fetch_assoc();
                if($row["apin"] == $pin){
                $_SESSION["AID"]=$row["aid"];
                $_SESSION["ANAME"]=$row["aname"];
                echo "<script>window.open('dashboard.php','_self');</script>";
            }
            else{echo '<div class="error" style="background-color:red;color:white;padding:20px;font-size:18px;width:30%;border-radius:10px;">Wrong Password or Wrong Username</div>';}
            }
    else{echo '<div class="error" style="background-color:red;color:white;padding:20px;font-size:18px;width:30%;border-radius:10px;">Wrong Password or Wrong Username</div>';}
}
?>
<form action="#" method="post">

  <div class="container">
    <label for="uname"><b>ID:</b></label>
    <input type="text" placeholder="Enter ID" name="id" required>

    <label for="Pin"><b>PIN:</b></label>
    <input type="password" placeholder="Enter Password" name="pin" required>
        
    <button type="submit">Login</button>
  </div>
</form>

</center>
</body>
</html>
