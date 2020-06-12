<!DOCTYPE html>

<head>
  <title>Catalina Kitchen</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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


  <div class="containerCarousel">
    <div id="demo" class="carousel slide" data-ride="carousel">

      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
      </ul>

      <div class="carousel-inner">
        <div id="tresspass">
          <p>Start your</p>
          <p>Cooking</p>
          <p>Journey!</p>
          <a href="catalog.php"><button class="hoverable">Go</button></a>
        </div>
        <div class="carousel-item active">
          <img src="graphics/crueIngredient.jpg" alt="Los Angeles" width="1100" height="500">
        </div>
        <div class="carousel-item">
          <img src="graphics/panSpice.jpg" alt="Chicago" width="1100" height="500">
        </div>
        <div class="carousel-item">
          <img class="flip" src="graphics/ingredients.jpg" alt="New York" width="1100" height="500">
        </div>
      </div>
      <!-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a> -->
    </div>

  </div>
  <div class="contentIndex0">
    <div class="cover">
      <div class="climax">Catalina Kitchen</div>
    </div>
    <div class="intro">Welcome to</div>

    <div class="description">Your go-to-place when you want to make quality food with quality tools !</div>

    < </div> <div class="contentIndex1">
      <div class="instructiontitle">
        <p>Easy as </p>
        <p>one,two,three!</p>
      </div>

      <div class="instructionone animated img-fluid wow fadeInUp" data-wow-delay="0.2s"">
      <p class=" titleStep">1</p>
        <p class="fillerStep">Fill your cart</p>
        <img src="graphics/shoppincartInp.png" alt="">
      </div>
      <div class="instructiontwo">
        <p class="titleStep">2</p>
        <p class="fillerStep">Finalize your order</p>
        <img src="graphics/shoppincart.png" alt="">
      </div>
      <div class="instructionthree">
        <p class="titleStep">3</p>
        <p class="fillerStep">Check your email</p>
        <img src="graphics/email.png" alt="">
      </div>
  </div>
  <div class="contentIndex2">
    <a href="about.php">
      <div class="about">
        <div class="whiteShade">
          <p>More About Catalina</p>
        </div>

      </div>
    </a>
    <a href="catalog.php">
      <div class="catalog">
        <div class="whiteShade">

          <p>Start Shopping Now</p>
        </div>
      </div>
    </a>
  </div>
</body>
<footer>
  <h2>Contact Us</h2>
  <p>IG : catalina.kitchen</p>
  <p>Phone : +62 87877836056</p>
  <p>Address : Darmo Satelit Indah 4 FN 1</p>
  <p>Email : catalinakitchen@gmail.com</p>
</footer>

</html>