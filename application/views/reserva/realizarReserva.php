<style>
    body {
        background: url("https://images4.alphacoders.com/646/646937.jpg");
    }

    .contenedor {
        background: white;
        border-radius: 3px;
        margin-top: 15px;
    }

    .servicios {
        padding: 10px;
    }

    #regiration_form fieldset:not(:first-of-type) {
        display: none;
    }

    .my-custom-scrollbar {
        position: relative;
        height: 400px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }
    .form-control {
        width:auto;
        display:inline-block;
    }
</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/jquery-ui.min.css">

<script src="<?php echo base_url(); ?>/public/js/scriptPagos.js"></script>
<script src="<?php echo base_url(); ?>/public/js/jquery.payform.min.js" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>/public/js/jquery-ui.min.js" charset="utf-8"></script>

<div class="container contenedor text-center" id="raiz">
    <h3>Reserva</h3>
    <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <form action="<?php echo base_url(); ?>servicio/nuevaReserva" method="post" enctype='multipart/form-data' id="regiration_form">

        <datalist id="listaServicios">
            <?php foreach ($servicio->result() as $item) : ?>
                <option value="<?php echo $item->nombre ?>">
                <?php endforeach; ?>
        </datalist>

        <!--primer pagina!-->
        <fieldset class="servicios" id="cuadroFechaF">
            <div id="cuadroHorario" class="container">
                <div class="row">
                    <div class="col-md-12" style="text-align: center">Selecciona la fecha y el turno de tu reserva: </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4" id="datepicker"></div>

                    <div class="col-md-5">
                        <p id="prueba">

                        </p>
                        <div class="form-group">
                            <label for="turno">Turno</label>
                            <select class="form-control" name="turno" id="turno" style="width: 30%">
                                <option>Dia</option>
                                <option>Noche</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cantidadPersonas">Cantidad de asistentes</label>
                            <input type="number" id="cantidadPersonas" name="cantidadPersonas" style="width: 10%">
                        </div>
                        
                        <button type="button" class="btn btn-primary" id="comprobarDisponibilidad">Seleccionar esta fecha</button>
                    </div>

                    <div class="col-md-3">
                        <p id="fechaAviso"></p>
                    </div>
                </div>
            </div>
            <hr>
            <input type="button" name="next" class="next btn btn-info cuadroServicio preOrdenSi" id="siguienteFecha" value="PreOrden" />
            <input type="button" name="nextConfirmar" class="next btn btn-info cuadroConfirmar preOrdenNo" id="siguientelala" value="Reservar mesa" />
        </fieldset>

        <!--segunda pagina!-->
        <fieldset class="servicios" id="cuadroServicioF">
            <div id="cuadroComida">
                <h4>Escoge lo que vas a comer en <strong><?php echo $userRestaurante->nickname ?></strong></h4>

                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">Comida</div>
                        <div class="col-sm-2">Cantidad</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar text-left" id="prueba3">
                                <table class="table">
                                    <tbody>
                                        <?php foreach ($servicio->result() as $item) : ?>
                                            <tr>
                                                <td><a href="#"><?php echo $item->nombre ?></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="prueba2" class="col-sm-2 col-md-2">
                        </div>
                        <div id="carritoComidas" class="col-sm-3 col-md-6">
                            <table class="table" id="carrito">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">
                                            Eliminar
                                        </th>
                                        <th>
                                            Comida
                                        </th>
                                        <th>
                                            Cantidad
                                        </th>
                                        <th>
                                            Precio(unidad)
                                        </th>
                                        <th>
                                            Precio(acumulado)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>  
                            <table class="table" style="background-color: rgb(230, 233, 239)">
                                <tfoot>
                                    <tr>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            TOTAL
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td id="precioTotal">
                                            0
                                        </td>
                                    </tr>
                                </tfoot>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <input type="button" name="previous" class="previous btn btn-default cuadroFecha" value="Anterior" />
            <input type="button" name="next" id="primerSiguiente" class="next btn btn-info cuadroPago" value="Siguiente" />
        </fieldset>

        <!--tercer pagina!-->
        <fieldset class="servicios" id="cuadroPagoF">
            <div id="cuadroPago" class="container text-left">
                <div class="container-fluid">
                    <div class="creditCardForm">
                        <div class="heading">
                            <h1>Datos de pago</h1>
                        </div>
                        <div class="payment">
                            <div class="form-group owner">
                                <label for="owner">Titular</label>
                                <input type="text" class="form-control" id="owner">
                            </div>
                            <div class="form-group CVV">
                                <label for="cvv">CVC</label>
                                <input type="text" class="form-control" id="cvv">
                            </div>
                            <div class="form-group" id="card-number-field">
                                <label for="cardNumber">Numero de la tarjeta</label>
                                <input type="text" class="form-control" id="cardNumber">
                            </div>
                            <!--
                            <div class="form-group" id="expiration-date">
                                <label>Fecha de vencimiento</label>
                                <select>
                                    <option value="01">Enero</option>
                                    <option value="02">Febrero </option>
                                    <option value="03">Marzo</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Mayo</option>
                                    <option value="06">Junio</option>
                                    <option value="07">Julio</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                                <select>
                                    <option value="19"> 2019</option>
                                    <option value="20"> 2020</option>
                                    <option value="21"> 2021</option>
                                </select>
                            </div>
                            !-->
                            <div class="form-group" id="credit_cards">
                                <img src="<?php echo base_url(); ?>public/img/visa.jpg" id="visa">
                                <img src="<?php echo base_url(); ?>public/img/mastercard.jpg" id="mastercard">
                                <img src="<?php echo base_url(); ?>public/img/amex.jpg" id="amex">
                            </div>
                            <div class="form-group" id="pay-now">
                                <button type="submit" class="btn btn-default" id="confirm-purchase">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <hr>
            <input type="button" name="previous" class="previous btn btn-default cuadroServicio" value="Anterior" />
            <input type="button" name="next" class="next btn btn-info cuadroConfirmar" value="Siguiente" id="siguientePago" onclick="datosPago()" />
        </fieldset>
        <!--cuarta pagina!-->
        <fieldset class="servicios" id="cuadroConfirmarF">
            <div id="cuadroConfirmar" class="container">
            </div>
            <div class="col-12">
                <br>
                <button type="button" onclick="finalizarReserva()" class="btn btn-primary" id="comprobarDisponibilidad">Seleccionar esta fecha</button>
                <div id="respuestaFinal"></div>
            </div>
            <hr>
            <input type="button" name="previous" class="previous btn btn-default cuadroPago" id="aCuadroPago" value="Anterior" />
            <input type="button" name="previous" class="previous btn btn-default cuadroFecha" id="aCuadroFecha" value="Anterior" />
        </fieldset>
    </form>
</div>


<script>
    $( "#datepicker" ).datepicker({
        inline: true,
        firstDay: 1,
        showOtherMonths: true,
        minDate: new Date(),
        nextText: "Siguiente mes",
        altFormat: "yy-mm-dd",
        autoSize: true,
        dayNamesMin: [
            'Do',
            'Lu', 
            'Ma', 
            'Mi', 
            'Ju', 
            'Vi', 
            'Sa'],
        monthNames: [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre'],
            onSelect: function(date) {
                var dateTypeVar = $('#datepicker').datepicker('getDate');
                var fechaIndicada = $.datepicker.formatDate('yy-mm-dd', dateTypeVar);
                var id_restaurante = "<?php echo $userRestaurante->id ?>";
                var url = "reserva/turnoDisponible";
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>" + url,
                    data: {
                        fechaIndicada: fechaIndicada,
                        id_restaurante: id_restaurante
                    },
                    dataType: "html",
                    success: function (response) {
                        $("#prueba").html(response);
                    }
                });
            }    
});

function pepe(){
    var dateTypeVar = $('#datepicker').datepicker('getDate');
    console.log($.datepicker.formatDate('yy-mm-dd', dateTypeVar));
}
    var currentDate = $( ".datepicker" ).datepicker( "getDate" );
</script>

<script>

    var serviciosAgregados = 0;
    var datosPagoValidos = false;

    $("#comprobarDisponibilidad").click(function() {
        var dateTypeVar = $('#datepicker').datepicker('getDate');
        var fechaIndicada = $.datepicker.formatDate('yy-mm-dd', dateTypeVar);
        if(fechaIndicada != null && fechaIndicada != ""){
            var hoy = $.datepicker.formatDate('yy-mm-dd', new Date());
            if (hoy <= fechaIndicada) {
                var cantPersonas = $("#cantidadPersonas").val();
                if(cantPersonas != null && cantidadPersonas != "" && cantPersonas > 0){
                    $("#fechaAviso").hide();
                    var turnoIndicado = $("#turno").val();
                    var id_restaurante = "<?php echo $userRestaurante->id ?>";
                    var url = "reserva/fechaDisponible"
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() ?>" + url,
                        dataType: 'html',
                        data: {
                            cantPersonas: cantPersonas,
                            fechaIndicada: fechaIndicada,
                            turnoIndicado: turnoIndicado,
                            id_restaurante: id_restaurante
                        },
                        success: function(data) {
                            $("#fechaAviso").html(data).show();
                        }
                    });
                }else{
                    $("#fechaAviso").html('<p class="alert alert-danger">La cantidad de personas debe ser de al menos una.</p>').show();
                    $("#siguienteFecha").hide();
                    $("#siguientelala").hide();
                }
            }else{
                $("#fechaAviso").html('<p class="alert alert-danger">La fecha de reserva debe ser igual o mayor a la del dia actual.</p>').show();
                $("#siguienteFecha").hide();
                $("#siguientelala").hide();
            }
        }else{
            $("#fechaAviso").html('<p class="alert alert-danger">Debes indicar una fecha para comprobar su disponibilidad.</p>').show();
            $("#siguienteFecha").hide();
            $("#siguientelala").hide();
        }
    });


    $("#prueba3 a").click(function() {
        var nomSer = $(this).text();
        var id_restaurante = "<?php echo $userRestaurante->id ?>";
        console.log(nomSer);
        var url = "reserva/infoServicio"
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + url,
            data: {
                nombreServicio: nomSer,
                id_restaurante: id_restaurante
            },
            dataType: "html",
            success: function(data) {
                $('#prueba2').html(data).css("background-color", "rgb(230, 233, 239)");
            }
        });
    });




    $(document).on('click', '#enviaComida', function() {
        var idSer = document.getElementById('idComida').value;
        var cantidad = document.getElementById('cantidad').value;
        var precio = document.getElementById('precioComida').innerText;
        var nombre = document.getElementById('nombreComida').innerText;
        if (cantidad > 0) {
            var id_restaurante = "<?php echo $userRestaurante->id ?>";
            var url = "reserva/agregarComida"
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + url,
                data: {
                    idServicio: idSer,
                    cantidad: cantidad,
                    id_restaurante: id_restaurante
                },
                dataType: "html",
                success: function(data) {
                    $('#prueba2').html(data);
                    serviciosAgregados++;
                }
            });
            var precioABorrar = 0;
            if ($("#eliminarFila" + idSer).length > 0) {
                precioABorrar = $("#precio" + idSer).html();
                $("#eliminarFila" + idSer).remove();
            }
            $('#carrito > tbody:last-child').append(`<tr id="eliminarFila` + idSer + `">
                <td>
                    <a href="#" onclick="eliminarServicio(` + idSer + `)"><i class="far fa-times-circle"></i></a>
                </td>
                <td>`
                    + nombre + `
                </td>
                <td>`
                    + cantidad + `
                </td>
                <td id="precioUnidad` + idSer +`">`
                   + precio +`
                </td>
                <td id="precio` + idSer + `">`
                    + precio*cantidad + `
                </td>
            </tr>
            `);;
            var precioTotal = document.getElementById('precioTotal').innerHTML;
            precioTotal = (parseFloat(precioTotal) + precio*cantidad);
            precioTotal = (parseFloat(precioTotal) - parseFloat(precioABorrar));
            $('#precioTotal').html(precioTotal);
        } else {
            $('#errorCantidad').html("<p style='color: red'>La cantidad debe ser de al menos 1 unidad</p>");
        }
    });

    function eliminarServicio(idSer) {
        var url = "reserva/eliminarComida"
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + url,
            data: {
                idServicio: idSer
            },
            dataType: "html",
            success: function(data) {
                var idfila = "eliminarFila" + idSer;
                var precio = $("#precio" + idSer).html();
                var precioTotal = $("#precioTotal").html();
                precioTotal = (precioTotal - precio);
                $('#' + idfila).remove();
                $('#precioTotal').html(precioTotal);
                serviciosAgregados--;
            }
        });
    }

    function datosPago() {
        var tarjeta = $("#cardNumber").val();
        console.log(tarjeta);
        var titularTarjeta = $("#owner").val();
        var cvc = $("#cvv").val();
        var url = "reserva/datosPago";
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + url,
            data: {
                tarjeta: tarjeta,
                titularTarjeta: titularTarjeta,
                cvc: cvc
            },
            dataType: "html",
            success: function (data) {
                $('#erroresPago').text(data);
                $("#siguientePago").hide();
            }
        });
    }

    function finalizarReserva(){
        var url = "reserva/finalizarReserva";
        if(serviciosAgregados != 0){
            if(datosPagoValidos == true){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>" + url,
                    data:{notengonadapamandarteahoramismo: "pablitoclavounclavito"},
                    dataType: "html",
                    success: function (data) {
                        $("#raiz").html(data);
                    }
                });
            }else{
                $("#respuestaFinal").text("Agregaste comidas a la preorden y aun no has pagado.");
            }
        }else{
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + url,
                data:{notengonadapamandarteahoramismo: "pablitoclavounclavito"},
                dataType: "html",
                success: function (data) {
                    $("#raiz").html(data);
                }
            });
        }
    }

    $(document).ready(function() {
        $("#siguientePago").hide();
        $("#siguienteFecha").hide();
        $("#siguientelala").hide();

        var current = 1;
        var preOrden = false;

        $(".cuadroConfirmar").click(function() {
            $("#cuadroFechaF").hide();
            $("#cuadroServicioF").hide();
            $("#cuadroPagoF").hide();
            $("#cuadroConfirmarF").show();
            current = 4;
            setProgressBar(current);
        });
        $(".cuadroServicio").click(function() {
            $("#cuadroFechaF").hide();
            $("#cuadroServicioF").show();
            $("#cuadroPagoF").hide();
            $("#cuadroConfirmarF").hide();
            current = 2;
            setProgressBar(current);
        });
        $(".cuadroPago").click(function() {
            $("#cuadroFechaF").hide();
            $("#cuadroServicioF").hide();
            $("#cuadroPagoF").show();
            $("#cuadroConfirmarF").hide();
            current = 3;
            setProgressBar(current);
        });
        $(".cuadroFecha").click(function() {
            $("#cuadroFechaF").show();
            $("#cuadroServicioF").hide();
            $("#cuadroPagoF").hide();
            $("#cuadroConfirmarF").hide();
            current = 1;
            setProgressBar(current);
        });
        // Change progress bar action
        function setProgressBar(curStep) {
            var percent = parseFloat(100 / 4) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
                .html(percent + "%");
        }
        $(".preOrdenSi").click(function() {
            preOrden = true;
            console.log(preOrden)
            $("#aCuadroFecha").hide();
            $("#aCuadroPago").show();
        });
        $(".preOrdenNo").click(function() {
            preOrden = false;
            console.log(preOrden)
            $("#aCuadroFecha").show();
            $("#aCuadroPago").hide();
        });
    });

    
</script>