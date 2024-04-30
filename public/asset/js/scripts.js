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
            title: "Votre ticket est : ",
            html: "<h1><b> " + data + "</b></h1>", // Afficher la réponse texte
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
  } // fin for

  $(".action").on("click", function () {
    let ticket = this.value;
    let stat = ticket.slice(-1);
    let numTicket = ticket.substring(0, 4);
    var id = this.getAttribute("data-id");
    var title;
    switch (stat) {
      case "A":
        title = "Voulez-vous appeler le ticket " + numTicket + " ?";
        break;
      case "E":
        title = "Voulez-vous clôturer le ticket " + numTicket + " ?";
        break;

      default:
        title = "Une erreur est survenue.";
        break;
    }

    Swal.fire({
      title: title,
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: "Oui",
      denyButtonText: `Non`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $.ajax({
          url: "/editQueue", // URL de votre requête
          method: "POST", // Méthode HTTP (GET, POST, etc.)
          dataType: "json", // Type de données attendu en réponse (json, html, text, etc.)
          data: { id: id, ticket: numTicket, stat: stat }, // Données à envoyer avec la requête (optionnel)
          success: function (response) {
            if (response) {
              Swal.fire("Effectué", "", "success");
              window.location.reload();
            }
          },
          error: function (xhr, status, error) {
            Swal.fire("Erreur", "", "error");
            window.location.reload();
          },
        });
      } else if (result.isDenied) {
        Swal.fire("Changes are not saved", "", "info");
      }
    });
  });
})(window);
