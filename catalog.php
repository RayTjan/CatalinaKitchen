<?php

session_start();
?>
<!DOCTYPE html>

<head>
    <title>Catalina Catalog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="shortcut icon" href="favicon.png">

    <link rel="stylesheet" href="style.css">
</head>

<body >
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
    <div>

        <?php

        if (!isset($_SESSION['idCollect'])) {
            $_SESSION['idCollect'] = "";
        }
        if (!isset($_SESSION['noCollect'])) {
            $_SESSION['noCollect'] = "";
        }
        if (isset($_POST["purchase"])) {
            $_SESSION['idCollect'] .= ",";
            $_SESSION['idCollect'] .= $_POST["purchase"];
            $_SESSION['noCollect'] .= ",";
            $_SESSION['noCollect'] .= $_POST["amount"];
        }
        $query = "SELECT id,code, name,image,image2,image3,stock,price,details FROM kitchentools";
        $result = mysqli_query(connectDB(), $query);

        ?>
        <div class="contentCatalog0">
            <p>Catalina Catalog</p>
            <p class="note">Click on the image for more details</p>
        </div>
        <div class="contentCatalog1">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $dummy = $row['id'];
                echo "<div class='  product'>";
                //<?php $row['id']
                //<?php $dummy
            ?>  
                <div class="itembox ">
                    <button onclick="document.getElementById('<?= $row['id'] ?>').style.display='block' " class="item innerproduct">
                        <?php
                        echo "<div class='tag'>
                <img width='150vw' height = '150vw' src='image/" . $row['image'] . "'>
                <p >" . $row['name'] . "</p>
                <p >Rp." . $row['price'] . "</p>
                </div>"
                        ?>
                    </button><?php
                                echo "</div></div>";
                                ?>
                    <div id="<?= $row['id'] ?>" class="modal product' . $row['id'] . '">

                        <form class="modal-content animate" action="catalog.php" method="post">
                            <span onclick="document.getElementById('<?= $row['id'] ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
                            <div class="imgcontainer">
                                <div class="containerNav">
                                    <img id="view<?= $row['id'] ?>" alt="Avatar" src="image/<?= $row['image'] ?>" class="showcase">
                                </div>
                                <div class="row">
                                    <div class="column">
                                        <img src="image/<?= $row['image'] ?>"  style="width:100%" onclick="mySelect(this,<?= $row['id'] ?>);">
                                    </div>
                                    <div class="column">
                                        <img src="image/<?= $row['image2'] ?>" style="width:100%" onclick="mySelect(this,<?= $row['id'] ?>);">
                                    </div>
                                    <div class="column">
                                        <img src="image/<?= $row['image3'] ?>" style="width:100%" onclick="mySelect(this,<?= $row['id'] ?>);">
                                    </div>
                                </div>



                            </div>
                            <?php
                            echo '
                <div class="container">
                    <label for="uname"><b>Code &nbsp:&nbsp ' . $row['code'] . '</b></label><br>
                    <br><label for="psw"><b>Name &nbsp:&nbsp ' . $row['name'] . '</b></label><br>
                    <br><label for="psw"><b>Stock &nbsp:&nbsp ' . $row['stock'] . '</b></label><br>
                    <br><label for="psw"><b>Price &nbsp:&nbsp Rp. ' . $row['price'] . '</b></label><br>
                    <br><label for="psw"><b>Details</b></label><br>
                    <p>' . $row['details'] . '</p>
                    <br><label for="psw"><b>Amount</b></label><br>
                    <input type="number" value = "1" name="amount" min="1" required>
                    <br>
                    <button class="Subutton" type="submit" name="purchase" value="' . $row['id'] . '"> Add to Cart</button>
                </div>
                '
                            ?>
                        </form>
                    </div>
                </div>

            <?php
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
        <script>
            function mySelect(imgs, identity) {
                //   alert(identity);
                document.getElementById("view" + identity).src = imgs.src;
                expandImg.parentElement.style.display = "block";
            }
        </script>
</body>
<footer>
    <h2>Contact Us</h2>
    <p>IG : catalina.kitchen</p>
    <p>Phone : +62 87877836056</p>
    <p>Address : Darmo Satelit Indah 4 FN 1</p>
    <p>Email : catalinakitchen@gmail.com</p>
</footer>

</html>