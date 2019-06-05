<h3>Informacion Servicio:</h3>
      <div>
        <?php foreach($servicio as $item):?>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne1">
                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne<?php echo $item->id ?>" aria-expanded="true" aria-controls="collapseOne1">
                            <h5 class="mb-0"><?php echo $item->nombre; ?> <i class="fas fa-angle-down rotate-icon"></i></h5>
                        </a>
                    </div>

                    <div id="collapseOne<?php echo $item->id ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                        <div class="card-body" id="block_container">
                            <div id="bloc1">
                                <img src="<?php echo base_url() . '/uploads/servicios/' . $item->imagen; ?>" height="150" width="150"  alt="avatar image">
                            </div>
                            <div id="bloc2">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-info mr-4 pr-3"></i>
                                        <?php echo $item->descripcion; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="md-v-line"></div><i class="fas fa-dollar-sign mr-4 pr-3"></i>
                                        <?php echo $item->precio; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        <?php endforeach;?>
      </div>