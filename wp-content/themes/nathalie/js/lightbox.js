// Le code JavaScript pour la lightbox

// Fonction pour ouvrir la lightbox
function openLightbox(imageUrl) {
  const lightbox = document.querySelector(".lightbox");
  const lightboxImage = lightbox.querySelector(".lightbox__container img");

  lightboxImage.src = imageUrl;
  lightbox.style.display = "flex";
}

// Fonction pour fermer la lightbox
function closeLightbox() {
  const lightbox = document.querySelector(".lightbox");
  lightbox.style.display = "none";
}

// Gestionnaires d'événements pour les icônes plein écran
const fullscreenIcons = document.querySelectorAll(".full-screen-icon");
fullscreenIcons.forEach(function (icon) {
  icon.addEventListener("click", function (e) {
    e.preventDefault();
    const imageUrl = this.getAttribute("href");
    openLightbox(imageUrl);
  });
});

// Gestionnaire d'événement pour le bouton de fermeture
const closeIcon = document.querySelector(".lightbox__close");
closeIcon.addEventListener("click", function () {
  closeLightbox();
});
