function preview() {
    let urlInput = document.getElementById('lien_image'); // Stocke l'élément input de l'URL
    let imageUrl = urlInput.value; // On stocke la valeur de l'input dans la variable imageUrl
    if (imageUrl) {
        let preview = document.getElementById("preview"); // Stocke le bouton preview
        preview.innerHTML = "<img class = 'preview 'src=" + imageUrl + " alt='preview image'>"; // On affiche après le bouton preview
    }
}