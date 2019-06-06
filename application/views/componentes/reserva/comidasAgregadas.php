<table class="table">
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
        <?php foreach($carrito as $item):?>
            <tr id="eliminarFila<?php echo $item['id'] ?>">
                <td>
                    <a href="#" id="quitarComida<?php echo $item['nombre'] ?>" onclick="eliminarServicio(<?php echo $item['id'] ?>)"><i class="far fa-times-circle"></i></a>
                </td>
                <td>
                    <?php echo $item['nombre']?>
                </td>
                <td>
                    <?php echo $item['cantidad']?>
                </td>
                <td id="precioUnidad<?php echo $item['id'] ?>">
                    <?php echo ($item['precio'])?>
                </td>
                <td id="precio<?php echo $item['id'] ?>">
                    <?php echo ($item['precio']*$item['cantidad'])?>
                </td>
            </tr>
        <?php endforeach;?>    
    </tbody>
    <tfoot style="background-color: rgb(230, 233, 239)">
        <tr>
            <td>
                TOTAL
            </td>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
            <td id="precioTotal">
                <?php
                    $precioTotal = 0;
                    foreach($carrito as $item){
                        $precioTotal = $precioTotal + ($item['precio']*$item['cantidad']);
                    }
                    echo $precioTotal;
                ?>
            </td>
        </tr>
    </tfoot>
</table>