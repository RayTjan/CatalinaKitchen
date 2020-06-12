<?php

session_start();


?>
<!DOCTYPE html>
<title>Your Cart</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="favicon.png">

<link rel="stylesheet" href="style.css">
<!-- DELETE CART ORDER, EMPTY CART AND IMAGE SHOWING STILL PROBLEM -->

<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand" href="index.php"><img src="graphics/logoFinal.png" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="catalog.php">Catalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">AdminLogin</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div>


        <?php
        $query = "SELECT id,code, name,image,stock,price,details FROM kitchentools";
        $result = mysqli_query(connectDB(), $query);
        if (!isset($_SESSION['order'])) {
            $_SESSION['order'] = "";
        }

        if (isset($_POST['finalize'])) {

            $name      = $_POST['name'];
            $email     = $_POST['email'];
            $codes       =  $_SESSION['idCollect'];
            $amounts    =  $_SESSION['noCollect'];
            $address    = $_POST['address'];
            $phoneNumber    = $_POST['phone'];
            $stat = "New";
            $sql = "INSERT INTO cart(name,email,codes,amounts,address,phoneNumber,status) VALUES ('" . $name . "','" . $email . "','" . $codes . "','" . $amounts . "','" . $address . "','" . $phoneNumber . "','" . $stat . "')";
            $_SESSION['idCollect'] = "";
            $_SESSION['noCollect'] = "";
            if (mysqli_query(connectDB(), $sql)) {
            }
            session_destroy();
            //EMAIL
            $to = "rayy0001@student.ciputra.ac.id";
            $from = $_POST['email'];
            $subjectO = "New Order from " . $_POST['name'];
            $subjectU = "Thank you for your purchase " . $_POST["name"];
            $messageO = "The Person Ordered " . $_SESSION['order'];
            $messageU = "You ordered " . $_SESSION['order'];
            $headerO = "From: " . $from;
            $headerU = "From: " . $to;
            mail($to, $subjectO, $messageO, $headerO);
            mail($from, $subjectU, $messageU, $headerU);
            $_SESSION['order'] = "";
        }
        if (!isset($_SESSION['idCollect']) || !isset($_SESSION['idCollect']) || $_SESSION['idCollect'] == "" || $_SESSION['noCollect'] == "") {
            echo "<div class='empty'>
                <p>Empty Cart</p>
                <a href='catalog.php'><button>Search Catalog</button></a>
            </div>";
        } else {
            $arrayId = explode(",", $_SESSION['idCollect']);
            $arrayNo = explode(",", $_SESSION['noCollect']);

            if (isset($_POST["delete"])) {
                \array_splice($arrayId, $_POST['delete'],1);
                \array_splice($arrayNo, $_POST['delete'],1);
                $_SESSION['idCollect']="";
                $_SESSION['noCollect']="";
                for ($a = 1; $a < count($arrayId); $a++) {
                    $_SESSION['idCollect'] .= ",";
                    $_SESSION['idCollect'] .= $arrayId[$a];
                    $_SESSION['noCollect'] .= ",";
                    $_SESSION['noCollect'] .= $arrayNo[$a];
                } 
                header("Location: cart.php");                
                // if ($arrayId[0]=="") {
                //     echo "<div class='empty'>
                //         <p>Empty Cart</p>
                //         <a href='catalog.php'><button>Search Catalog</button></a>
                //     </div>";
                // }
            }


            echo "<div><div class='contentCart0'> <h2>Your Cart</h2>";
            $payment = 0;
            for ($a = 1; $a < count($arrayId); $a++) {
                $resource = mysqli_query(connectDB(), "SELECT * FROM kitchentools WHERE id = " . $arrayId[$a]);
                $item = mysqli_fetch_assoc($resource);

                if ($a == 1) {
                    $_SESSION['order'] = $arrayNo[$a];
                    $_SESSION['order'] .= " ";
                    $_SESSION['order'] .= $item["name"];
                } else {
                    $_SESSION['order'] .= ", ";
                    $_SESSION['order'] .= $arrayNo[$a];
                    $_SESSION['order'] .= " ";
                    $_SESSION['order'] .= $item["name"];
                }
                $total = $item['price'] * $arrayNo[$a];
                $payment = $payment + $total;
                echo "<div class='order'>
                                <img  class= 'orderpic'  src='image/" . $item['image'] . "'/>
                                <p class= 'orderText1'>" . $item['name'] . "</p>
                                <p class= 'orderText2'>Amount : " . $arrayNo[$a] . "</p>
                                <p class= 'orderText3'>Total Price : Rp." . $total . "</p>
                                <div class='orderButton'>
                                <form action='cart.php' method='post'>
                                <button type='submit' value='" . $a . "' name='delete'><img src='graphics/delete.png'></button>
                                </form>
                                </div>
                                </div>";
            }
            echo '
                <div class="sendOrder">
                <form action="cart.php" method="post">
                    <label ><b>Name</b></label><br><br>
                    <input type="text"   name="name" required><br>
                    <label ><b>Email</b></label><br><br>
                    <input type="text"   name="email" required><br>
                    <br><label><b>Phone Number</b></label><br><br>
                    <input type="text"   name="phone" required><br>
                    <br><label ><b>Address</b></label><br><br>
                    <input type="text"   name="address" required><br>
                    <br><label ><b>Total : Rp.' . $payment . '</b></label><br><br><br>
                    <button  type="submit" name="finalize" value="update">Purchase</button>
                </form>
                </div>
            </div> ';
        }
        ?>
    </div>


    <?php
    function connectDB()
    {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'catalina';
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if ($conn) {
            return $conn;
        } else {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    ?>
</body>

</html>