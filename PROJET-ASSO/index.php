<!DOCTYPE html>
<html lang="fr-FR">
<?php
session_start();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/acceuil.css" type="text/css">
  <link rel="stylesheet" href="./styles/nav.css" type="text/css">
  <link rel="stylesheet" href="./styles/dropdown.css" type="text/css">

  <title>Acceuil</title>
</head>

<?php
require "./controllers/UserManager.php";
require "./models/User.php";
require "./controllers/ArticleManager.php";
require "./models/Article.php";


?>

<header class="p-3 text-white color_nav">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center ">
      <img class="logo-hexa_3" src="./images/Logo_BDE_3.svg" alt="logo_BDE">
      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="./index.php" class="nav-link px-2 text-secondary">
            <h1 class="ml11">
              <span class="text-wrapper text-white">
                <span class="line line1"></span>
                <span class="letters text-white">Acceuil</span>
              </span>
            </h1>
          </a></li>
        <li><a href="./readAll.php" class="nav-link px-2 text-white"> Evènements</a></li>
        <li><a href="./create.php" class="nav-link px-2 text-white">création d'events</a></li>
      </ul>

      <div class="dropdown">
        <a href="./login.php" class="ml-auto"><img src="./images/log_in_v3.png" style="width: 77px !important;"></a>
        <?php if ($_SESSION) { ?>
          <div class="dropdown-content">
            <a style="color : black;"><?= $_SESSION['username'] ?> </a>
            <a style="color : black" href="logout.php">Logout</a>
          </div>
        <?php } ?>
      </div>

    </div>
  </div>
</header>

<body>

  <div class="center">
    <img class="logo-hexa_2" src="./images/tmp_720d74f4-c48d-488a-bd11-053166ec5736.jpg" alt="">
  </div>

  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <script src="./javascript/acceuil.js"></script>
  <script src="./javascript/nav.js"></script>
  <script src="./javascript/eye.js"></script>


</body>


</html>