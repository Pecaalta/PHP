<style>
    body {
        background: url("https://www.aquateknica.com/wp-content/uploads/2018/02/color-alimentos-1024x576.jpg");
        background-size: cover;
    }


    .card {
        cursor: pointer;
        border-radius: 5px;
        margin-top: 10px;
        width: 282px;
        height: auto;
    }

    .card-img-veiw img {
        min-width: 100%;
        min-height: 100%;
        border-radius: 5px;
    }

    .card-img-veiw {
        height: 200px;
        overflow: hidden;
    }

    .msgNoElement {
        text-align: center;
        width: 100%;
        padding: 50px 0;
        color: #999;
    }

    .badge {
        height: 2rem;
        padding: .5rem 1rem;
        font-size: 1rem;
        margin: 1rem 0.5rem;
    }

    .badge .close {
        font-size: 1rem;
        margin: 0 0rem 0 0.75rem;
        cursor: pointer;
    }

    .card-footer {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        background: none;
        margin: 0 20px;
    }

    .precio {
        color: #007aff;
        font-weight: 900;
    }

    .fluid-container {
        display: flex;
        flex-wrap: wrap;
    }

    .fluid-container>div {
        margin: 10px;
    }
</style>


<!--<a href="<?php echo base_url() . 'restaurante/principal/' . $id; ?>">
        <button mat-button>Volver a Servicios</button>
        </a>-->
<div class="fluid-container">
    <?php foreach ($servicio as $item) : ?>


        <div>
            <div class="card">
                <div class="card-img-veiw">
                    <img id="imgServicio" class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/img%20(27).jpg" alt="Sample image">
                </div>
                <div class="card-body text-center">
                    <h4 class="text-center font-weight-bold card-title mb--5"><?php echo $item->nombre; ?></h4>
                    <h5><?php echo $item->nickname; ?></h5>
                </div>
                <div class="card-footer">
                    <a data-toggle="modal" onclick="dataEdit()" data-target="#EditModal" class="container btn btn-primary">Comentar</a>
                </div>

            </div>
        </div>




        <script>
            function dataComentar(id, nombre, descripcion, precio, imagen) {
                $("#editdescripcion").val(descripcion);
                $("#editprecio").val(precio);
            }
        </script>


        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <form class="modal-content" action="<?php echo base_url(); ?>servicio/enviar_comentario" method="post" enctype='multipart/form-data' id="frm_nuevoServicio">
                    <div class="modal-header">
                        <h4 class="modal-title w-100" id="EditModal">Comentar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-8">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 form-group">
                                        <label>Valoración</label>
                                        <select name="valoracion">
                                            <option hidden select></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <textarea id="editdescripcion" class="textDescripcion form-control" type="text" name="comentar" placeholder="Comentario"></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Enviar Comentario</button>
                    </div>
                </form>
            </div>
        </div>



    <?php endforeach; ?>
</div>