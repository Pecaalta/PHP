<style>
    body {
        background-color: #8B807E;
    }

    .column {
        border-radius: 5px;
        margin-top: 15px;
        height: auto;
    }

    .container {
        margin-top: 25px;
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
        padding: 1.5em;
        background-color: white;
    }

    #lista5>li:before {
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
    }

    #datos {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
    }
</style>
<div class="container">
    <ol id="lista5">
        <?php foreach ($reserva as $item) : ?>
            <li>
                <div class="column">
                    <div class="col-sm-12 col-md-12 ">
                        <div id="datos" class="card-body text-center">
                            <div></div>
                            <div></div>
                            <h4><?php echo $item->nickname; ?></h4>
                            <h4>Cantidad de Personas: <?php echo $item->personas; ?></h4>
                            <h5><?php $hoy = date('Y-m-d');


                                if ($hoy > $item->fecha_total) : ?>
                                    <div style="background-color: #F0CCC6;">
                                        <h4>Día: <?php echo $item->fecha_total . " Finalizada"; ?></h4>
                                    </div>
                                <?php else : ?>
                                    <div style="background-color: #D4F0C6;">
                                        <h4>Día: <?php echo $item->fecha_total . " Pendiente"; ?></h4>
                                    </div>

                                <?php endif; ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
</div>