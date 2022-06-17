<!DOCTYPE html>
<html lang="fr-FR">
<?php session_start();  ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/acceuil.css" type="text/css">
    <link rel="stylesheet" href="./styles/read.css" type="text/css">
    <link rel="stylesheet" href="./styles/nav.css" type="text/css">
    <link rel="stylesheet" href="./styles/preview.css" type="text/css">
    <title>modification d'articles</title>
</head>

<header class="p-3 color_nav text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">


            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="javascript:;" onclick="history.back()" class="nav-link"><img class="icon" src="./images/arrow.svg" alt="flèche retour"> </a></li>
                <a href="">
                    <img class="icon" src="">
                </a>
                <li><a href="./index.php" class="nav-link px-2 text-white">Acceuil</a></li>
                <li><a href="./readAll.php" class="nav-link px-2 text-white">Evènements</a></li>
                <li><a href="./index.php" class="nav-link px-2 text-white">
                        <h1 class="ml11">
                            <span class="text-wrapper">
                                <span class="line line1"></span>
                                <span class="letters">Modification de l'event</span>
                            </span>
                        </h1>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>

<body>
    <?php


    require "./controllers/ArticleManager.php";
    require "./models/Article.php";


    $manager = new ArticleManager();
    if ($_SESSION['status'] == True) {
        if ($_GET) {
            $article = $manager->get($_GET['id']);
        }

        if ($_POST) {

            $donnees = [
                "id" => $_GET["id"],
                "content" => $_POST["content"],
                "title" => $_POST["title"],
                "lien_image" => $_POST["lien_image"]
            ];

            $manager->update(new Article($donnees));
            header("Location: ./read.php?id={$_GET["id"]}");
            exit();
        }
    } ?>
    <div>
        <div>
            <img class="logo-hexa" src="./images/Logo_BDE.svg" alt="Erreur">
        </div>
        <form method="POST" class="container mt-2">
            <label>Titre</label>
            <input type="text" name="title" id="title" class="form-control mb-3" placeholder="titre de l'event" value="<?= $article->getTitle(); ?>">
            <label>Contenu</label>
            <textarea name="content" id="content" class="form-control mb-3" placeholder="Le contenu de l'event"><?= $article->getContent(); ?></textarea>
            <label>URL de l'image</label>
            <input type="url" name="lien_image" onkeyup="preview('lien_image')" id="lien_image" class="form-control" placeholder="lien de l'image " value="<?= $article->getLien_image(); ?>">
            <div id="preview"></div>
            <input type="submit" value="modifier" class=" mt-3 btn btn-primary">
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="./javascript/acceuil.js"></script>
    <script src="./javascript/nav.js"></script>
    <script src="./javascript/previewImage.js"></script>

</body>

</html>