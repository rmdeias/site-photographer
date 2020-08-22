$(document).ready(function () {

//zoom article au passage de la souris    
    $("article").mouseenter(function () {
        $(this).addClass("scale-article");
    });

//dézoom image article a la sortie de la souris
    $("article").mouseleave(function () {
        $(this).removeClass("scale-article");
    });

    $("img").bind("contextmenu", function (e) //désactive click droit
    {
        e.preventDefault();
        return false;
    });


});
