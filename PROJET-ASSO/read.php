<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/acceuil.css" type="text/css">
    <link rel="stylesheet" href="./styles/nav.css" type="text/css">
    <link rel="stylesheet" href="./styles/read.css" type="text/css">
    <link rel="stylesheet" href="./styles/w3.css" type="text/css">
    <title>read</title>
</head>
<header class="p-3 color_nav text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <img class="logo-hexa_3" src="./images/Logo_BDE_3.svg" alt="logo_BDE">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="javascript:;" onclick="history.back()" class="nav-link"><img class="icon" src="./images/arrow.svg" alt="flèche retour"> </a></li>
                <li><a href="./index.php" class="nav-link px-2 text-white">Acceuil</a></li>
                <li><a href="./readAll.php" class="nav-link px-2 text-white">Evènements</a></li>
                <li><a href="./create.php" class="nav-link px-2 text-white">création d'events</a></li>
            </ul>
            <?php if ($_SESSION) { ?>
                <a style="text-decoration: none !important;color :#fff" href="logout.php">Logout</a>
            <?php } ?>
            <a href="./login.php" class="ml-auto"><img src="./images/log_in_v3.png" style="margin-left:45% !important; width: 77px !important;"></a>
        </div>
    </div>
</header>

<body>
    <?php
    require "./controllers/ArticleManager.php";
    require "./models/Article.php";
    $manager = new ArticleManager();
    if ($_GET) {
        $article = $manager->get($_GET['id']);
    }

    ?>
    <div>
        <header class="w3-container w3-white ">
            <div class="position_1">
                <h3><?= $article->getTitle(); ?></h3>
                <h6>dernière modification: <?= $article->getCreated_at(); ?></h6>
            </div>
        </header>
        <div class="w3-container">
            <hr>
            <div class="d-flex flex-row flex-wrap">
                <div>
                    <img src="<?= $article->getLien_image(); ?>" alt="..." class="w3-left w3-square image-size">
                </div>
                <div class="text-properties">
                    <p><?= $article->getContent(); ?></p>
                </div>
            </div>
        </div>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="margin-left : 2em; margin-top : 1%;">
            <a class="btn btn-danger" onclick="deleteArticle('<?= $article->getId() ?>')">
                <img src="./images/cross.png" alt="..." style=" max-width: 50px;" />
            </a>
            <a href="./update.php?id=<?= $article->getId() ?>" class="btn btn-warning">
                <img src="./images/pen.png" alt="..." style=" max-width: 50px;" />
            </a>
        </div>
    </div>

    <script>
        function deleteArticle(id) {
            if (confirm("confirmer la suppression")) {
                window.location.href = "./delete.php?id=" + id
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="./javascript/acceuil.js"></script>
    <script src="./javascript/nav.js"></script>
    <script src="./javascript/commentaire.js"></script>

</body>

</html>