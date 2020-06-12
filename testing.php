<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial;
    }

    /* The grid: Four equal columns that floats next to each other */
    .column {
      float: left;
      width: 25%;
      padding: 10px;
    }

    /* Style the images inside the grid */
    .column img {
      opacity: 0.8;
      cursor: pointer;
    }

    .column img:hover {
      opacity: 1;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* The expanding image container */
    .container {
      position: relative;
      font-size: 2vw;
    }

    /* Expanding image text */
    #imgtext {
      position: absolute;
      bottom: 15px;
      left: 15px;
      color: white;
      font-size: 20px;
    }

    /* Closable button inside the expanded image */
    .closebtn {
      position: absolute;
      top: 10px;
      right: 15px;
      color: white;
      font-size: 35px;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <div style="text-align:center">
    <h2>Tabbed Image Gallery</h2>
    <p>Click on the images below:</p>
  </div>

  <!-- The four columns -->
  <?php
  $resource = mysqli_query(connectDB(), "SELECT * FROM kitchentools WHERE id = 1");
  $item = mysqli_fetch_assoc($resource);
  echo '
    
<div class="container">
 
<img id="expandedImg" style="width:100%" src="image/' . $item['image'] . '">
</div>
<div class="row">
  <div class="column">
    <img src="image/' . $item['image'] . '" alt="Nature" style="width:100%" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="image/' . $item['image'] . '" alt="Snow" style="width:100%" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img src="image/' . $item['image'] . '" alt="Mountains" style="width:100%" onclick="myFunction(this);">
  </div>
</div>';
  ?>


  <script>
    function myFunction(img) {
      var expandImg = document.getElementById("expandedImg");
      var imgText = document.getElementById("imgtext");
      expandImg.src = img.src;
      imgText.innerHTML = imgs.alt;
      expandImg.parentElement.style.display = "block";
    }
  </script>

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
</html>