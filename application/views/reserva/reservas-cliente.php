<style>
    body {
        background-image: url("https://mott.pe/noticias/wp-content/uploads/2016/05/Sin-duda-probarlos-podr%C3%ADa-provocarte-una-muerte-deliciosa-pero-tranquilo-estos-postres-solo-te-alegrar%C3%A1n-la-vida-4.jpg");
    }

    .column {
        border-radius: 5px;
        margin-top: 15px;
        height: auto;
    }

    .container {
        margin-top: 25px;
    }

    p {
        margin: 0;
    }

    #lista5 {
        counter-reset: li;
        list-style: none;
        *list-style: decimal;
        font: 15px 'trebuchet MS', 'lucida sans';
        padding: 0;
        margin-bottom: 4em;
        text-shadow: 0 1px 0 rgba(255, 255, 255, .5);
    }

    #lista5 ol {
        margin: 0 0 0 2em;
    }

    #lista5 {
        list-style-type: none;
        list-style-type: decimal !ie;
        /*IE 7- hack*/

        margin: 0;
        margin-left: 1em;
        padding: 0;

        counter-reset: li-counter;

    }

    #lista5>li {
        position: relative;
        margin-bottom: 1.5em;
        padding: 0.5em;
        background-image: url("https://media.istockphoto.com/vectors/abstract-blue-triangles-geometric-background-vector-illustration-vector-id681810986?k=6&m=681810986&s=612x612&w=0&h=zHhQ37vM-23b5vtcWZ7gGTv-Sd0fmV7M-0N6gTjP_nQ=");
        background-size: cover;
        border-radius: 5px;
    }

    /*#lista5>li:before {
        position: absolute;
        top: -0.3em;
        left: -0.5em;
        width: 1.8em;
        height: 1.2em;

        font-size: 2em;
        line-height: 1.2;
        font-weight: bold;
        text-align: center;
        color: #464646;
        background-color: #d0d0d0;

        transform: rotate(-20deg);
        -ms-transform: rotate(-20deg);
        -webkit-transform: rotate(-20deg);
        z-index: 99;
        overflow: hidden;

        content: counter(li-counter);
        counter-increment: li-counter;

        background-image: url("https://media.istockphoto.com/vectors/abstract-blue-triangles-geometric-background-vector-illustration-vector-id681810986?k=6&m=681810986&s=612x612&w=0&h=zHhQ37vM-23b5vtcWZ7gGTv-Sd0fmV7M-0N6gTjP_nQ=");
        background-size: cover;
    }
*/
    #datos {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    #nick {
        margin-right: 30px;
        padding: 2px;
    } 
</style>
<div class="container">
    <ol id="lista5">
        <?php foreach ($reserva as $item) : ?>
            <li>
                <div class="column">
                    <div class="col-sm-12 col-md-12 ">
                        <div id="datos" class="card-body text-center">

                            <div id="nick">
                                <h4><i class="fas fa-utensils"></i><?php echo " " . $item->nickname; ?></h4>
                            </div>
                            <div>
                                <?php if ($item->precio != NULL) : ?>

                                    <i class="far fa-money-bill-alt"></i><?php echo "  Precio " . $item->precio; ?>
                                    <hr>

                                <?php endif; ?>


                                <p><i class="fas fa-users"></i> Cantidad de Personas <?php echo $item->personas; ?></p>
                                <hr>
                                </div>
                                <div style="margin-left: 35px;">
                                <?php if ($item->turno == 'Dia') : ?>
                                    <p>
                                        <i class="fas fa-cloud-sun"></i> Turno <?php echo $item->turno; ?>
                                        <hr>
                                    </p>
                                <?php else : ?>
                                    <p>
                                        <i class="fas fa-cloud-moon"></i> Turno <?php echo $item->turno; ?>
                                        <hr>
                                    </p>
                                <?php endif; ?>
                                <?php $hoy = date('Y-m-d');

                                if ($hoy > $item->fecha_total) : ?>
                                    <p style="background-color: #F0CCC6;">
                                        <i class="far fa-calendar-alt"></i> Día <?php echo $item->fecha_total . " - Finalizada"; ?>
                                        <hr>
                                    </p>
                                <?php else : ?>
                                    <p style="background-color: #D4F0C6;">
                                        <i class="far fa-calendar-alt"></i> Día <?php echo $item->fecha_total . " - Pendiente"; ?>
                                        <hr>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
</div>