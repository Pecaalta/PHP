(function($){
    $("#frm_nuevoServicio").submit(function(ev){
        ev.preventDefault();
        $.ajax({
            type: "POST",
            url: "servicio/nuevoServicio",
            data: $(this).serialize(),
            success: function () {
                console.log("pablitoclavounclavito");
                alert("papas");
            },
            error: function(){
                alert("papasds");
            }
        });
    });
})(jQuery)