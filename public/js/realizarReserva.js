var contador = 1;

$( "#add" ).click(function() {
 
    var newElement = '<div class="col-4 form-group"> <input class="form-control" type="number" name="jepeto" placeholder="Presdsdcio"></div>';
    $( "#cuadroComida" ).append( $(newElement) );
    contador = contador + 1;
    $("#prueba").text(contador);
 
});