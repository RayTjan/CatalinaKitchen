<?php

session_start();
?>
<!DOCTYPE html>

<head>
    <title>Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="favicon.png">

    <link rel="stylesheet" href="style.css">
</head>

<body id="AdminBody">
    <div>

        <?php

        if (!isset($_SESSION['uname']) || !isset($_SESSION['pass']) || $_SESSION['uname'] != "Ray" || $_SESSION['pass'] != "nein") {
            echo "<div class='empty'>
                <p>Please Login First</p>
                <a href='login.php'><button>LOGIN</button></a>
            </div>";
            session_destroy();
            exit();
        }

        echo "<h1>Welcome Admin " . $_SESSION['uname'] . "</h1>
              <a href='index.php'><button>LOGOUT</button></a>
        ";

        ?>
    </div>
    <div class='col-xs-12 col-md-12 botbor'>
        <h3>OrderList</h3>
        <?php
        if(isset($_POST['ordar'])){
            if($_POST['ordar']=="save"){
            $id = $_POST['id'];
            $stat = $_POST['stat'];
            $sqlStat = "UPDATE cart SET status='$stat' WHERE id= '$id'";
            if (connectDB()->query($sqlStat) === TRUE) {
            }
            }
            else{
                $id = $_POST['id'];
                $sql = "DELETE FROM cart WHERE id='$id'";
    
                if (connectDB()->query($sql) === TRUE) {
                }
            }
        }
        $query2 = "SELECT id,name,email,codes,amounts,address,phoneNumber,status FROM cart";
        $query = "SELECT id,code, name,image,image2,image3,stock,price,details FROM kitchentools";
        $result = mysqli_query(connectDB(), $query2);
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class='itembox'>
            <button onclick="document.getElementById('<?= $row['id'] ?>').style.display='block'" style="width:auto;" class="adminbox innerproduct">
                <img width='120vw' height='120vw' src='graphics/checklist.png'>
                <p><?= $row['name'] ?></p>
            </button>
            <div id="<?= $row['id'] ?>" class="modal product">
                <form class="modal-content animate" action="admin.php" method="post" enctype="multipart/form-data">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('<?= $row['id'] ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
                    </div>
                    <?php
                    echo '
                <div class="container AdminOrder"  enctype="multipart/form-data">
                    <label for="psw"><b>Name : ' . $row['name'] . '</b></label><br>
                    <br><label for="psw"><b>Email : ' . $row['email'] . '</b></label><br>
                    <br><label for="psw"><b>Address : ' . $row['address'] . '</b></label><br>
                    <br><label for="psw"><b>Phone : ' . $row['phoneNumber'] . '</b></label><br>';
                    
                    $arrayId = explode(",", $row['codes']);
                    $arrayNo = explode(",", $row['amounts']);
                    $payment=0;
                    for ($a = 1; $a < count($arrayId); $a++) {
                        $resource = mysqli_query(connectDB(), "SELECT * FROM kitchentools WHERE id = " . $arrayId[$a]);
                        $item = mysqli_fetch_assoc($resource);
                        $total = $item['price'] * $arrayNo[$a];
                        $payment = $payment + $total;
                        echo "<div class='order'>
                                 <br><img    src='image/" . $item['image'] . "'/><br>
                                <p>" . $item['name'] . "</p>
                                <p>Amount : " . $arrayNo[$a] . "</p>
                                <p>Price : Rp." . $total . "</p>
                            </div>";
                    }
                    echo'
                    <br><label for="psw"><b>Total : ' . $payment . '</b></label><br>
                    <br><label for="psw"><b>State : </b></label>
                    ';?>
                    <select  name="stat">
                    <option <?php if ($row['status'] == 'New' ) echo 'selected' ; ?> value="'New'">New</option>
                    <option <?php if ($row['status'] == 'Pending' ) echo 'selected' ; ?> value='Pending'>Pending</option>
                    <option <?php if ($row['status'] == 'Sending' ) echo 'selected' ; ?> value='Sending'>Sending</option>
                    <option <?php if ($row['status'] == 'Finished' ) echo 'selected' ; ?> value='Finished'>Finished</option>
                    <option <?php if ($row['status'] == 'Cancelled' ) echo 'selected' ; ?> value='Cancelled'>Cancelled</option>
                    </select>
                    <br> <br>
                    <button class="Subutton" type="submit" name="ordar" value="save"> Save</button>
                    <button class="Subutton" type="submit" name="ordar" value="del"> Delete</button>
                    <input type="hidden"  name="id" value="<?= $row['id'] ?>">
                </div>
                </form>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <div class='col-xs-12 col-md-12 botbor'>
        
        <h3>Messages</h3>
        
        <?php
        if (isset($_POST['deleteMsg'])) {
            $id = $_POST['deleteMsg'];
            $sql = "DELETE FROM contact WHERE id='$id'";
            if (connectDB()->query($sql) === TRUE) {
            }
        }
        $queryMsg = "SELECT id,email,title,message FROM contact";
        $result = mysqli_query(connectDB(), $queryMsg);
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class='itembox'>
            <button onclick="document.getElementById('<?= $row['id'] ?>').style.display='block'" style="width:auto;" class="adminbox innerproduct">
                <img width='120vw' height='120vw' src='graphics/email.png'>
                <p><?= $row['title'] ?></p>
            </button>
            <div id="<?= $row['id'] ?>" class="modal product">
                <form class="modal-content animate" action="admin.php" method="post" enctype="multipart/form-data">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('<?= $row['id'] ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
                    </div>
                    <?php
                    echo '
                <div class="container AdminOrder"  enctype="multipart/form-data">
                    <label for="psw"><b>Name : ' . $row['email'] . '</b></label><br>
                    <br><label for="psw"><b>Email : ' . $row['title'] . '</b></label><br>
                    <br><label for="psw"><b>Address : ' . $row['message'] . '</b></label><br><br>
                    <button class="Subutton" type="submit" name="deleteMsg" value="' . $row['id'] . '"> Resolve</button>
                </div>
                ';
                    ?>
                </form>
            </div>
        </div>
        <?php
        }
        ?>
        
    </div>
    <div>
        <h3>Catalog list</h3>

        <?php
        if (isset($_POST['new'])) {

            $fileName1 = $_FILES['image']['name'];
            $tempName = $_FILES['image']['tmp_name'];

            $dirUpload = "image/";

            $uploaded = move_uploaded_file($tempName, $dirUpload . $fileName1);
            $fileName2 = $_FILES['image2']['name'];
            $tempName = $_FILES['image2']['tmp_name'];

            $dirUpload = "image/";

            $uploaded = move_uploaded_file($tempName, $dirUpload . $fileName2);
            $fileName3 = $_FILES['image3']['name'];
            $tempName = $_FILES['image3']['tmp_name'];

            $dirUpload = "image/";

            $uploaded = move_uploaded_file($tempName, $dirUpload . $fileName3);

            $code       = $_POST['code'];
            $name      = $_POST['name'];
            $stock    = $_POST['stock'];
            $price    = $_POST['price'];
            $details    = $_POST['details'];
            $sql = "INSERT INTO kitchentools(code,name,image,image2,image3,stock,price,details) VALUES ('" . $code . "','" . $name . "','" . $fileName1 . "','" . $fileName2 . "','" . $fileName3 . "','" . $stock . "','" . $price . "','" . $details . "')";
            if (mysqli_query(connectDB(), $sql)) {
            }
        }
        if (isset($_POST['decision'])) {
            $conn = connectDB();
            if ($_POST['decision'] == "update") {
                $id        = $_POST['id'];
                $code       = $_POST['code'];
                $name      = $_POST['name'];
                $stock    = $_POST['stock'];
                $price    = $_POST['price'];
                $details    = $_POST['details'];
                $img1 = $_FILES['image']['name'];
                $img2 = $_FILES['image2']['name'];
                $img3 = $_FILES['image3']['name'];
                if ($img1 != "") {
                    $fileName1 = $_FILES['image']['name'];
                    $tempName = $_FILES['image']['tmp_name'];

                    $dirUpload = "image/";

                    $uploaded = move_uploaded_file($tempName, $dirUpload . $fileName1);
                    $sqlImg1 = "UPDATE kitchentools SET image='$fileName1' WHERE id= '$id'";
                    if ($conn->query($sqlImg1) === TRUE) {
                    }
                }
                if ($img2 != "") {
                    $fileName2 = $_FILES['image2']['name'];
                    $tempName = $_FILES['image2']['tmp_name'];

                    $dirUpload = "image/";

                    $uploaded = move_uploaded_file($tempName, $dirUpload . $fileName2);
                    $sqlImg2 = "UPDATE kitchentools SET image2='$fileName2' WHERE id= '$id'";
                    if ($conn->query($sqlImg2) === TRUE) {
                    }
                }
                if ($img3 != "") {
                    $fileName3 = $_FILES['image3']['name'];
                    $tempName = $_FILES['image3']['tmp_name'];

                    $dirUpload = "image/";

                    $uploaded = move_uploaded_file($tempName, $dirUpload . $fileName3);
                    $sqlImg3 = "UPDATE kitchentools SET image3='$fileName3' WHERE id= '$id'";
                    if ($conn->query($sqlImg3) === TRUE) {
                    }
                }

                $sql = "UPDATE kitchentools SET code='$code', name='$name', stock='$stock', price='$price', details='$details'  WHERE id= '$id'";

                if ($conn->query($sql) === TRUE) {
                }
            } else {
                $id = $_POST['id'];

                $sql = "DELETE FROM kitchentools WHERE id='$id'";

                if (connectDB()->query($sql) === TRUE) {
                }
            }
        }
        $result = mysqli_query(connectDB(), $query);
        ?>
        <div class='itembox'>
            <button onclick="document.getElementById('empty').style.display='block'" style="width:auto;" class="item innerproduct">
                <img width='120vw' height='120vw' src='image/plus.png'>
            </button>
            <div id="empty" class="modal product">
                <form class="modal-content animate" action="admin.php" method="post" enctype="multipart/form-data">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('empty').style.display='none'" class="close" title="Close Modal">&times;</span>
                    </div>
                    <?php
                    echo '
                <div class="container"  enctype="multipart/form-data">
                    <label for="uname"><b>Code</b></label><br>
                    <input type="text"  placeholder="code" name="code" required>
                    <br><label for="psw"><b>Name</b></label><br>
                    <input type="text"  placeholder="name" name="name" required>
                    <br><label for="psw"><b>Image</b></label><br>
                    <input type = "file"  name="image" required>
                    <br><label for="psw"><b>Image2</b></label><br>
                    <input type = "file" name="image2" required>
                    <br><label for="psw"><b>Image3</b></label><br>
                    <input type = "file"  name="image3" required>
                    <br><label for="psw"><b>Stock</b></label><br>
                    <input type="text"  placeholder="stock" name="stock" required>
                    <br><label for="psw"><b>Price</b></label><br>
                    <input type="text"  placeholder="price" name="price" required>
                    <br><label for="psw"><b>Details</b></label><br>
                    <textarea name="details" cols="50" rows="3"> </textarea>
                    <button class="Subutton" type="submit" name="new" value="add"> Save</button>
                </div>
                ';
                    ?>
                </form>
            </div>
        </div>
        <?php
        echo "</div>";
        while ($row = mysqli_fetch_array($result)) {
            $dummy = $row['id'];
            echo "<div class='itembox'>";
            //<?php $row['id']
            //<?php $dummy
        ?>
            <button onclick="document.getElementById('<?= $row['id'] ?>').style.display='block' " style="width:auto;" class="item innerproduct">
                <?php
                echo "<img width='120vw' height = '120vw' src='image/" . $row['image'] . "'>"
                ?>
            </button>
            <?php
            $price = $row['price'];
            $dot = ".";
            // <p>Rp. ". substr_replace($price,$dot,count_chars($price)-3,0) ."</p><br>
            echo "<p class='adminText'>" . $row['name'] . "</p>
            <p class='adminText'>Rp." . $row['price'] . "</p><br>
            </div>";
            ?>
            <div id="<?= $row['id'] ?>" class="modal product' . $row['id'] . '">

                <form class="modal-content animate" action="admin.php" method="post" enctype="multipart/form-data">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('<?= $row['id'] ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
                    </div>
                    <?php
                    echo '
                <div class="container"  >
                    <label for="uname"><b>Code</b></label><br>
                    <input type="text" value="' . $row['code'] . '" name="code" required>
                    <br><label for="psw"><b>Name</b></label><br>
                    <input type="text" value="' . $row['name'] . '" name="name" required>
                    <br><p>(Please select new image file to replace)</p>
                    <label for="psw"><b>Image </b></label><br><br>
                    <img width="120vw" height = "auto" src="image/' . $row['image'] . '">
                    <input type="file"  name="image" >
                    <br><label for="psw"><b>Image2</b></label><br><br>
                    <img width="120vw" height = "auto" src="image/' . $row['image2'] . '">
                    <input type="file"  name="image2" >
                    <br><label for="psw"><b>Image3</b></label><br><br>
                    <img width="120vw" height = "auto" src="image/' . $row['image3'] . '">
                    <input type="file"  name="image3" >
                    <br><label for="psw"><b>Stock</b></label><br>
                    <input type="text"  value="' . $row['stock'] . '" name="stock" required>
                    <br><label for="psw"><b>Price</b></label><br>
                    <input type="text"  value="' . $row['price'] . '" name="price" required>
                    <br><label for="psw"><b>Details</b></label><br>
                    <textarea name="details" cols="50" rows="3">' . $row['details'] . ' </textarea>
                    <button class="Subutton danger" type="submit" name="decision" value="delete"> Delete</button>
                    <button class="Subutton" type="submit" name="decision" value="update"> Save</button>
                    <input type="hidden"  name="id" value=' . $row['id'] . '>
                </div>
                '
                    ?>
                </form>
            </div>
    </div>
    <script>
        var modal = document.getElementById('<?= $row['id'] ?>');
        var modal = document.getElementsByClassName('empty');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
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

</body>

</html>