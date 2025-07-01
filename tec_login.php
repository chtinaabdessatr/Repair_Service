
<?php
$page_name="Technician Login";
include './includes/includes_ns.php';
?>
<body>
<center>
<h1>Technician Login</h1>

<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $pin = $_POST["pin"];
    $email = $_POST["email"];

    $sql="SELECT * FROM Technicians WHERE Email='$email'";
            $result=$conn->query($sql);
            if($result->num_rows>0)
            {
                $row=$result->fetch_assoc();
                if($row["PIN"] == $pin){
                $_SESSION["TID"]=$row["TechnicianID"];
                $_SESSION["TNAME"]=$row["FirstName"];
                echo "<script>window.open('profile.php','_self');</script>";
            }
            else{echo '<div class="error" style="background-color:red;color:white;padding:20px;font-size:18px;width:30%;border-radius:10px;">Wrong Password or Wrong Username</div>';}
            }
    else{echo '<div class="error" style="background-color:red;color:white;padding:20px;font-size:18px;width:30%;border-radius:10px;">Wrong Password or Wrong Username</div>';}
}
?>

<form action="#" method="POST">

  <div class="container">
    <label for="uname"><b>Email:</b></label>
    <input type="email" placeholder="EX: email@email.com" name="email" required>

    <label for="psw"><b>PIN:</b></label>
    <input type="password" placeholder="EX:0213" name="pin" maxlength="4" required>
        
    <button type="submit">Login</button>
  </div>
</form>
</center>
</body>
</html>
