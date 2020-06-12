<?php
session_start();
if (isset($_POST['uname']) && isset($_POST['pass'])) {
        if ($_POST['uname'] == "Ray" && $_POST['pass'] == "nein") {
            
            $_SESSION['uname'] = $_POST["uname"];
            $_SESSION['pass'] = $_POST["pass"];
            header("Location: admin.php");

            // echo"<script type='text/javascript'>location.href = 'admin.php';</script>";
        } else {
            $signIn =false;
        }
    }
?>
<!DOCTYPE html>

<head>
    <title>Admin Only!</title>
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
</head>

<body id="login">
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
    <?php
    $signIn = true;
    
    if($signIn ==true){
        echo '
    <div class="LoginContent">
        <h1>Admin Login</h1>
        <form action="login.php" method="POST" enctype="multipart/form-data">
            Username: <input type="text" name="uname" /><br>
            Password: <input type="text" name="pass" /><br>
            <input type="submit" name="fin" value="Submit" />
        </form>
    </div>';
    }
    else{
        echo' <script>
        .alert("Dont Come Back");</script>';
        header("Location: index.php");
    }
    ?>
</body>

</html>