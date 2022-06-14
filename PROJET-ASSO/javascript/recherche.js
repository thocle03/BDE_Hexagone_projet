function recherche() {
    let input = document.getElementById('recherche').value
    input = input.toLowerCase();
    let Article = document.getElementsByClassName('card');

    for (i = 0; i < Article.length; i++) {
        if (!Article[i].innerHTML.toLowerCase().includes(input)) {
            Article[i].style.display = "none";
        }
        else {
            Article[i].style.display = "list-item";
        }
    }

}