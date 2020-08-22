$(document).ready(function () {
    $("form").on("submit", function (e) {
        e.preventDefault();
        if ($("#categorie").val().trim() === "") {
            alert("Merci de saisir un titre de catégorie");
            return;
        }

        if ($("#id").val() === undefined && $("#photoCouv")[0].files.length === 0) {
            alert("Pas de photo de couverture sélectionné");
            return;
        }

        var fd = new FormData();

        fd.append("categorie", $("#categorie").val().trim());

        if ($("#id").val() !== undefined) {
            fd.append("id", $("#id").val());
        }

        if (typeof $("#photoCouv") !== undefined) {
            fd.append("photoCouv", $("#photoCouv")[0].files[0]);
        }

        $.ajax({
            url: "Models/commissioned/gestionCategories/insertUpdate.php",
            type: "post",
            data: fd,
            contentType: false,
            processData: false,
            success: function (reponse) {
                if (reponse.error === true) {
                    alert(reponse.msg);
                }
                else {
                    document.location.href = "commCat";
                }
            }
        });
    });
});
