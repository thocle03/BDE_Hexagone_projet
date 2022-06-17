<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/acceuil.css" type="text/css">
    <link rel="stylesheet" href="./styles/nav.css" type="text/css">
    <link rel="stylesheet" href="./styles/dropdown.css" type="text/css">
    <link rel="stylesheet" href="./styles/easteregg.css" type="text/css">
    <title>Home</title>
</head>

<header class="p-3 color_nav text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <img class="logo-hexa_3" src="./images/Logo_BDE_3.svg" alt="logo_BDE">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="./index.php" class="nav-link px-2 text-white">Acceuil</a></li>
                <li><a href="./readAll.php" class="nav-link px-2 text-white">
                        <h1 class="ml11">
                            <span class="text-wrapper">
                                <span class="line line1"></span>
                                <span class="letters">Evènements</span>
                            </span>
                        </h1>
                    </a></li>
                <li><a href="./create.php" class="nav-link px-2 text-white">création d'events</a></li>
            </ul>
            <?php if ($_SESSION) { ?>
                <a style="text-decoration: none !important;color :#fff" href="logout.php">Logout</a>
            <?php } ?>
            <a href="./login.php" class="ml-auto"><img src="./images/log_in_v3.png" style="margin-left:45% !important; width: 77px !important;"></a>
        </div>
        <input class="form-control form-control-dark" id="recherche" onkeyup="recherche()" type="text" name="recherche" placeholder="recherche ..">
    </div>
</header>

<body>

    <div class="dropdown">
        <button class="dropbtn">Filtrer</button>
        <div class="dropdown-content">
            <a href="./readAll.php"> Date </a>
            <a href="./readAllTitle.php"> Titre </a>
        </div>
    </div>

    <?php

    require "./controllers/ArticleManager.php";
    require "./models/Article.php";

    $manager = new ArticleManager();
    $articles = $manager->getAll();

    ?>

    <div class="d-flex flex-wrap justify-content-center" id="article">
        <?php
        foreach ($articles as $article) {
        ?>
            <div class="card mb-4" style="width: 70rem;">
                <img class="card-img-top" style="max-height: 350px;" src="<?= $article->getLien_image(); ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $article->getTitle(); ?></h5>
                    <p class="card-text"><?php echo substr($article->getContent(), 0, 50); ?> ...</p>
                    <p class="card-text"><small class="text-muted"> <?= $article->getCreated_at(); ?></small></p>


                    <a href="./read.php?id=<?= $article->getId() ?>">
                        <button type="button" class="btn violet btn-lg btn-block">Participer !</button> </a>

                </div>


            </div>
        <?php } ?>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="./javascript/acceuil.js"></script>
    <script src="./javascript/nav.js"></script>
    <script src="./javascript/deleteArticle.js"></script>
    <script src="./javascript/recherche.js"></script>
</body>

</html>