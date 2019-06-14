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
</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/demo.css">

<script src="<?php echo base_url(); ?>/public/js/scriptPagos.js"></script>
<script src="<?php echo base_url(); ?>/public/js/jquery.payform.min.js" charset="utf-8"></script>

<div class="container contenedor text-center">
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
        <fieldset class="servicios">
            <div id="cuadroHorario" class="container">
                <div class="row">
                    <div class="col-md-5">Selecciona la fecha y el turno de tu reserva: </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <input type="date" id="fecha" name="fecha">
                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-control" name="turno" id="turno">
                                <option>Dia</option>
                                <option>Noche</option>
                            </select>
                        </div>
                        <input type="number" id="cantidadPersonas">
                        <p id="fechaAviso"></p>
                    </div>

                    <div  class="col-md-4" id="calendar"></div>
                
                    <div class="col-md-3"><a href="#" id="comprobarDisponibilidad">Comprobar disponibilidad</a>
                        <p id="prueba">

                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <input type="button" name="next" class="next btn btn-info" id="siguienteFecha" value="Siguiente" />
        </fieldset>

        <!--segunda pagina!-->
        <fieldset class="servicios">
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
            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
            <input type="button" name="next" id="primerSiguiente" class="next btn btn-info" value="Siguiente" />
        </fieldset>

        <!--tercer pagina!-->
        <fieldset class="servicios">
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
            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
            <input type="button" name="next" class="next btn btn-info" value="Siguiente" id="siguientePago" onclick="datosPago()" />
        </fieldset>
        <!--cuarta pagina!-->
        <fieldset class="servicios">
            <div id="cuadroConfirmar" class="container">
                <table class="table">
                    <th>Restaurante</th>
                    <td></td>
                </table>
            </div>
            <div class="col-12">
                <br>
                <p>Aca mostrare los datos antes de que confirme, lo dejo para despues</p>
                <a href="#" onclick="finalizarReserva()">Confirmar reserva</a>
                <div id="respuestaFinal"></div>
            </div>
            <hr>
            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
        </fieldset>
    </form>
</div>

<script>
    $('#calendar').datepicker({
        inline: true,
        firstDay: 1,
        showOtherMonths: true,
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
</script>

<script>

    $("#comprobarDisponibilidad").click(function() {
        var fechaIndicada = $("#fecha").val();
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
                            $("#prueba").html(data);
                            console.log($("#prueba").text());
                            if ($.trim($("#prueba").text()) == "Mesas disponibles") {
                                $("#siguienteFecha").show();
                            }else{
                                $("#siguienteFecha").hide();
                            }
                        }
                    });
                }else{
                    $("#fechaAviso").html("La cantidad de personas debe ser de al menos una.").show();
                }
            }else{
                $("#fechaAviso").html("La fecha de reserva debe ser igual o mayor a la del dia actual.").show();
            }
        }else{
            $("#fechaAviso").html("Debes indicar una fecha para comprobar su disponibilidad.").show();
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
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + url,
            data:{notengonadapamandarteahoramismo: "pablitoclavounclavito"},
            dataType: "html",
            success: function (data) {
                $("#respuestaFinal").text(data);
            }
        });
    }

    $(document).ready(function() {
        $("#siguientePago").hide();
        $("#siguienteFecha").hide();
        var current = 1,
            current_step, next_step, steps;
        steps = $("fieldset").length;
        $(".next").click(function() {
            current_step = $(this).parent();
            next_step = $(this).parent().next();
            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });
        $(".previous").click(function() {
            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);
        // Change progress bar action
        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
                .html(percent + "%");
        }
    });

    
</script>