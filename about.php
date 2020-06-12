<?php
session_start();
            // $_SESSION['idCollect'] = "";
            // $_SESSION['noCollect'] = "";
?>
<!DOCTYPE html>

<head>
    <title>About Catalina</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.png">

    <link rel="stylesheet" href="style.css">
</head>

<body>
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

    <div class="contentAbout0">
        <video class="trailer" controls>
            <source src="advertise/Trailer.mp4" type="video/mp4">
        </video>
        <p class="videoTitle">Trailer</p>
    </div>
    <div class="contentAbout1">
        <div class="display2"></div>
        <div class="display1"></div>

        <div class="text1">Providing Quality Kithcenwares </div>
        <div class="text2">We obtain kitchenware from overseas to make sure you can perform your cooking/baking needs with quality tools.</div>
    </div>
    <div class="contentAbout2">
        <?php
        if (isset($_POST["mail"])) {
            $to = "rayy0001@student.ciputra.ac.id";
            $from = $_POST['email'];
            $subject = $_POST['title'];
            $message = $_POST["message"];
            $header = "From: " . $from;
            mail($to, $subject, $message, $header);
            $sql = "INSERT INTO contact(email,title,message) VALUES ('" . $from . "','" . $subject . "','" . $message . "')";
            if (mysqli_query(connectDB(), $sql)) {
            }
            echo " <script>alert('Message has been sent');</script>";
        }

        ?>
        <div class=background></div>
        <div class="LeaveMsg">
        <p>Leave a message</p>
        </div>
        <div class="image">

        </div>
        
        <div class="emailForm">
            <form action="about.php" method="post">
                <p>Email</p>
                <input class="input" type="text" name="email" /><br>
                <p>Title</p>
                <input class="input" type="text" name="title" /><br>
                <p>Message</p>
                <textarea name="message" class="input" rows="3"> </textarea><br>
                <button class="Submit" type="submit" name="mail"><img src="graphics/email.png" alt=""></button>
            </form>
        </div>
    </div>

</body>
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
<footer>
  <h2>Contact Us</h2>
  <p>IG : catalina.kitchen</p>
  <p>Phone : +62 87877836056</p>
  <p>Address : Darmo Satelit Indah 4 FN 1</p>
  <p>Email : catalinakitchen@gmail.com</p>
</footer>
</html>