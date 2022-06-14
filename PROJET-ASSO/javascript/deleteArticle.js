function deleteArticle(id) {
    if (confirm("confirmer la suppression")) {
        window.location.href = "./delete.php?id=" + id
    }
}