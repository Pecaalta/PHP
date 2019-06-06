<style>
    body{
        background: url("https://wallpapercave.com/wp/mGD11sD.jpg");
    }
    .contenedor{
        background: white;
        border-radius: 3px;
        margin-top: 15px;
        padding-top: 15px;
    }
    .servicios{
        padding: 10px;
    }
</style>
   <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
crossorigin=""></script>
<style>
    html, body {
        width: 100%;
        height: 100%;
        margin: 0;
        background: url("<?php echo base_url(); ?>/public/img/bg.jpg")
    }
    .box {
        border-radius: 7px;
        padding: 0 20px;
        background: #fff;
    }

    .m-b-15px {
        margin-bottom: 15px;
    }
    .m-t-50px {
        margin-top: 50px;
    }
    .margin-auto {
        margin: 10px auto 30px;
        display: block;
    }
    h3 {
        text-align: center;
        margin-bottom: 50px;    
        font-size: 20px;
        color: #666;
        text-transform: uppercase;
    }


    #drop_file_zone {
        background-color: #fff; 
    border: 1px solid #ced4da;
        width: 100%; 
        height: 100%;
        padding: 8px;
        font-size: 18px;
        border-radius: 5px;
        overflow: hidden;
    }
    #drag_upload_file {
        margin:0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        position: relative;
    }
    #drag_upload_file i {
        text-align: center;
        font-size: 5rem;
    }
    #drag_upload_file #selectfile {
        opacity: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
        cursor: pointer;
    }
    #output {
        max-width: 100%;
        max-height: 100%;
        position: absolute;
        z-index:1;
    }
    .error {
        text-align: center;
        margin: 5px;
    }

    .table {
        width:100%;
        max-width: 500px;
        margin: 10px auto;
        border: 1px solid #ced4da;
    }
    .table td {
        vertical-align: middle;
    }
    .view-list {
        width: 80px;
        height: 80px;
        border-radius: 3px;
    }
    .delete {
        padding: 5px;
        width: 30px;
        height: 30px;
    }
    #mapid {
        border: 1px solid #ced4da;
        overflow: hidden;
        border-radius: 3px;
    }
</style>
    <script>
      var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function(){
          var output = document.getElementById('output');
          output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        if (event.target.files[0].size > 200) document.getElementById('error').value = "Imagen demaciada pesada" ;
        
      };
    </script>

<div class="container contenedor text-center  z-depth-1">
    <form class="row" action="" method="post" enctype='multipart/form-data' id="frm_actualizarDatos">
   
        <div class="col-sm-12 col-md-8">
            <div class="row">

                <div class="col-12 form-group">
                    <input class="form-control" type="password" value="" name="actpassword" placeholder="Contraseña actual" require>
                </div>
                <div class="col-4 form-group">
                    <input class="form-control" type="text" value="<?php echo isset($user['nickname']) ? $user['nickname'] : ''; ?>" name="nickname" placeholder="Nickname" require>
                </div>
                <div class="col-4 form-group">
                    <input class="form-control" type="text" value="<?php echo isset($user['nombre']) ? $user['nombre'] : ''; ?>" name="nombre" placeholder="Nombre" require>
                </div>
                <div class="col-4 form-group">
                    <input class="form-control" value="<?php echo isset($user['rut']) ? $user['rut'] : ''; ?>" name="rut" type="text" placeholder="RUT" require>
                </div>

                <div class="col-6 form-group">
                    <input class="form-control" value="<?php echo isset($user['telefono']) ? $user['telefono'] : ''; ?>" name="telefono" type="text" placeholder="Teléfono" require>
                </div>
                <div class="col-6 form-group">
                    <input class="form-control" type="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" name="email" placeholder="Email" require>
                </div>

                <div class="col-8 form-group">
                    <input class="form-control" value="<?php echo isset($user['direccion']) ? $user['direccion'] : ''; ?>" name="direccion" type="text" placeholder="Dirección" require>
                </div>
                <div class="col-4 form-group">
                    <select class="form-control" value="<?php echo isset($user['zona']) ? $user['zona'] : ''; ?>" name="zona" require>
                        <option value="" selected disabled>Zona</option>
                        <?php foreach ($zonas as $zona):?>
                            <option value="<?php echo $zona['id']; ?>"><?php echo $zona['nombre']; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="col-6 form-group">
                    <input class="form-control" type="password" value="" name="password" placeholder="Contraseña" require>
                </div>
                <div class="col-6 form-group">
                    <input class="form-control" type="password" value="" name="repassword" placeholder="Repetir Contraseña" require>
                </div>
        
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row" style="height: 100%; padding: 0 15px 15px 0">
                <div class="col-12" id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                    <div id="drag_upload_file">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <input type="file" id="selectfile"  name="img" accept="image/*" onchange="loadFile(event)" require>
                    <img id="output" src="<?php echo isset($user['avatar']) ? base_url() . $user['avatar'] : ''; ?>"  alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div id="mapid" style="width: 100%; height: 400px;"></div>
            <input type="hidden" id="lat" value="<?php echo isset($user['lat']) ? $user['lat'] : ''; ?>" name="lat" >
            <input type="hidden" id="lng" value="<?php echo isset($user['lng']) ? $user['lng'] : ''; ?>" name="lng" >
        </div>

        <div class="col-12">
            <input class="margin-auto btn btn-primary m-b-15px" type="submit" value="Editar">
        </div>
    </form>
</div>

<script>

    var lat = document.getElementById('lat').value; 
    var lng = document.getElementById('lng').value; 
    
	var mymap = L.map('mapid').setView([lat, lng], 13);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		id: 'mapbox.streets'
	}).addTo(mymap);
        
	var popup = L.popup();
    popup
        .setLatLng({ 'lat': lat, 'lng': lng})
        .setContent("Aqui estaria tu restaurante ")
        .openOn(mymap);
    var restaurante = L.marker({ 'lat': lat, 'lng': lng}).addTo(mymap);
	function onMapClick(e) {
        document.getElementById('lat').value = e.latlng.lat; 
        document.getElementById('lng').value = e.latlng.lng; 
        restaurante.setLatLng(e.latlng); 
	}

	mymap.on('click', onMapClick);

</script>
