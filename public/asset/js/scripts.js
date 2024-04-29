(function (window, undefined) {
  "use strict";

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

  const buttons = document.getElementsByClassName("button");

  for (const button of buttons) {
    button.addEventListener("click", function () {
      // const value = this.value;
      const value = button.getAttribute("value");
      const dataId = button.getAttribute("data-id");

      // Données à envoyer
      const data = new FormData();
      data.append("value", value);
      data.append("ticket", dataId);

      // Options de la requête
      const options = {
        method: "POST",
        body: data,
      };

      // Effectuer la requête AJAX
      fetch("/addQueue", options)
        .then((response) => {
          if (!response.ok) {
            throw new Error("Une erreur s'est produite lors de la requête.");
          }
          return response.text(); // Si vous attendez une réponse JSON
        })
        .then((data) => {
          // Traiter la réponse si nécessaire
          Swal.fire({
            title: data,
            text: " est votre ticket", // Afficher la réponse texte
            icon: "success", // Icône de succès
          });
        })
        .catch((error) => {
          Swal.fire({
            title: "Erreur",
            text: "Une erreur s'est produite lors de la requête.",
            icon: "error",
          });
        });
    });
  }
})(window);
