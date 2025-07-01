<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap 4.3.1 CDN -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <!-- FontAwesome 4.7.0 CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
      integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <title>Tracking Page</title>
        <style>body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-color: #8c9eff;
    background-repeat: no-repeat;
}

.card {
    z-index: 0;
    background-color: #eceff1;
    padding-bottom: 20px;
    margin-top: 90px;
    margin-bottom: 90px;
    border-radius: 10px;
}

.top {
    padding-top: 40px;
    padding-left: 13% !important;
    padding-right: 13% !important;
}

/* Icon progressbar */

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455a64;
    padding-left: 0;
    margin-top: 30px;
}

#progressbar li {
    list-style-type: none;
    font-size: 13px;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400;
}

#progressbar .step0::before {
    font-family: FontAwesome;
    content: '\f10c';
    color: #fff;
}

#progressbar li::before {
    width: 40px;
    height: 40px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    background: #c5cae9;
    border-radius: 50%;
    margin: auto;
    padding: 0;
}

/* Progressbar connector */
#progressbar li::after {
    content: '';
    width: 100%;
    height: 12px;
    background-color: #c5cae9;
    position: absolute;
    top: 16px;
    left: 0;
    z-index: -1;
}

#progressbar li:last-child::after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: -50%;
}

#progressbar li:nth-child(2)::after,
#progressbar li:nth-child(3)::after {
    left: -50%;
}

#progressbar li:first-child::after {
    border-top-left-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: 50%;
}

/* Color number of the step and the connect tor before it */

#progressbar li.active::before,
#progressbar li.active::after {
    background-color: #651fff;
}

#progressbar li.active::before {
    font-family: FontAwesome;
    content: '\f00c';
}

.icon {
    width: 60px;
    height: 60px;
    margin-right: 15px;
}

.icon-content {
    padding-bottom: 20px;
}

@media screen and (max-width: 992px) {
    .icon-content {
        width: 50%;
    }
}
button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100px;
  }
  button:hover {
    opacity: 0.8;
  }
  input[type=text]{
    width: 30%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }
  </style>
    </head>
  <body>
    <div class="container px-1 px-md-4 py-5 mx-auto">
      <div class="card">
        <center>        
          <h1>Track Your Device:</h1>
          <form action="#" method="post">
            <input type="text"  name="tracker" placeHolder="EX:016839028">
            <button>Search</button>
          </form>
        </center>
        <?php
        include './includes/db.php';
        if($_SERVER["REQUEST_METHOD"] == "POST"){
          $tracker = $_POST["tracker"];
          $sql = "SELECT *  FROM Repairs WHERE RepairID=$tracker";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $DeviceID = $row["DeviceID"];
            $RepairDate = $row["RepairDate"];
            $RepairStatus = $row["RepairStatus"];
            $RepairDescription = $row["RepairDescription"];
            $RepairCost = $row["RepairCost"];
          }
          if($RepairStatus == "Pending"){
            $barmax = 2;
          }elseif($RepairStatus == "In Progress"){
            $barmax = 3;
          }elseif($RepairStatus == "Completed" || $RepairStatus == "Failed"){
            $barmax = 4;
          }
          echo '<div class="row d-flex justify-content-between px-3 top">
          <div class="d-flex">
            <h5>
              ORDER
              <span class="text-primary font-weight-bold">#'.$tracker.'</span>
            </h5>
          </div>
          <div class="d-flex flex-column text-sm-right">
            <p class="mb-0">
              Recived In: <span class="font-weight-bold">'.$RepairDate.'</span>
            </p>
            <p class="mb-0">
            Cost <span class="font-weight-bold">'.$RepairCost.' MAD</span>
          </p>
          </div>
        </div>
        <!-- Add class "active" to progress -->
        <div class="row d-flex justify-content-center">
          <div class="col-12">
            <ul id="progressbar" class="text-center">
              <li class="active step0"></li>
              <li class="';if($barmax >=2 ){echo"active";} echo'  step0"></li>
              <li class="';if($barmax >=3 ){echo"active";}echo'  step0"></li>
              <li class="';if($barmax >=4 ){echo"active";} echo'  step0"></li>
            </ul>
          </div>
        </div>
        <div class="row justify-content-between top">
          <div class="row d-flex icon-content">
            <img src="./img/CheckList.png" alt="" class="icon" />
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order <br />Pending</p>
            </div>
          </div>
          <div class="row d-flex icon-content">
            <img src="./img/Delivery.png" alt="" class="icon" />
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order <br />In Processing</p>
            </div>
          </div>
          <div class="row d-flex icon-content">
            <img src="./img/Shipping.png" alt="" class="icon" />
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Device <br />In Fixing</p>
            </div>
          </div>
          <div class="row d-flex icon-content">
            <img src="./img/Home.png" alt="" class="icon" />
            <div class="d-flex flex-column">
              <p class="font-weight-bold">Order <br />Done</p>
            </div>
          </div>
        </div>';
        }
        ?>
      </div>
    </div>
  </body>
</html>