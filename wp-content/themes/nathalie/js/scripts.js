// Ouvrir la modale au clic sur le bouton Contact
jQuery("#menu-item-contact a").on("click", function (e) {
  e.preventDefault();
  jQuery("#modal-contact").fadeIn();
});

// Fermer la modale au clic sur le bouton de fermeture
jQuery(".modal-close").on("click", function () {
  jQuery("#modal-contact").fadeOut();
});

// Pré-remplir le champ RÉF. PHOTO
jQuery("#wpforms-137-field_2").val("valeur par défaut");
// Le code JavaScript pour la lightbox//
