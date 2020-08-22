$(document).ready(function () {
    $("form").on("submit", function (e) {
        e.preventDefault();

        if ((isNaN($("#classement").val()) || ($("#classement").val() <= 0 || $("#classement").val() >= 100)) && ($("#classement").val() !== "")) {
            alert("Merci de choisir un nombre valide entre 1 et 99");
            return;
        }

        if ($("#id").val() === undefined && $("#photo")[0].files.length === 0) {
            alert("Pas de photo sélectionné");
            return;
        }

        var fd = new FormData();

        fd.append("titre", $("#titre").val().trim());
        fd.append("classement", $("#classement").val().trim());

        if ($("#id").val() != undefined) {
            fd.append("id", $("#id").val());
        }

        if (typeof $("#photo")) {
            fd.append("photo", $("#photo")[0].files[0]);
        }

        $.ajax({
            url: "Models/selectedWork/gestionPhotos/insertUpdate.php",
            type: "post",
            data: fd,
            contentType: false,
            processData: false,
            success: function (reponse) {
                if (reponse.error === true) {
                    alert(reponse.msg);
                }
                else {
                    document.location.href = "selectPhoto";
                }
            }
        });
    });
});
