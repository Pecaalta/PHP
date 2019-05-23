

<div class="row">
    <div class="col-sm-12 col-md-4">
        <?php foreach ($img as $oImg):?>
        <img src="./uploads/<?php echo $oImg['img'] ?>" alt="">
        <?php endforeach;?>
    </div>
    <div class="col-sm-12 col-md-8">
        <ul>
            <li>Nick <?php echo $user["nickname"] ?></li>
            <li>Nombre <?php echo $user["nombre"] ?></li>
            <li>Email <?php echo $user["email"] ?></li>
            <li>Apellido <?php echo $user["apellido"] ?></li>
            <li>Fecha de Naciminto<?php echo $user["fecha_de_nacimiento"] ?></li>
        </ul>
    </div>
</div>

</body>
</html>