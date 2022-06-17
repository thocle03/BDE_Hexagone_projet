<?php
session_start();
require("./controllers/ArticleManager.php");
// require("./controllers/UserManager.php");

$manager = new ArticleManager();
if ($_SESSION['status'] == True) {
    if ($_GET) {
        $manager->delete($_GET['id']);
    }
}
else {
    echo "<script> alert('you must be admin to do that') </script>";
}
echo "<script> window.location.href='index.php'</script>";