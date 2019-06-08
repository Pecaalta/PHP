<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReserBar</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.0/css/mdb.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

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
        .logo {
            display: block;
            width: 200px;
            max-width: 100%;
            margin: 50px auto 0;
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
            background-color: #EEE; 
            border: #999 1px dashed;
            width: 100%; 
            height: 200px;
            padding: 8px;
            font-size: 18px;
            border-radius: 5px;
            overflow: hidden;
        }
        #drag_upload_file {
            width:50%;
            margin:0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
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
</head>
<body>
<div class="container">
    <form action="<?php echo base_url(); ?>registro/post_cliente" method="post" enctype='multipart/form-data' class="box m-t-50px row z-depth-1">
        <div class="col-12 form-group">
            <img class="logo" src="<?php echo base_url(); ?>/public/img/logo.png" alt="" srcset="">
            <h3>Restaurante</h3>
        </div>
        <div class="col-4 form-group">
            <input class="form-control" type="text" name="nickname" placeholder="Nickname" require>
        </div>
        <div class="col-4 form-group">
            <input class="form-control" type="text" name="nombre" placeholder="Nombre" require>
        </div>
        <div class="col-4 form-group">
            <input class="form-control" name="rut" type="text" placeholder="RUT" require>
        </div>

        <div class="col-6 form-group">
            <input class="form-control" name="telefono" type="text" placeholder="Teléfono" require>
        </div>
        <div class="col-6 form-group">
            <input class="form-control" type="email" name="email" placeholder="Email" require>
        </div>

        <div class="col-8 form-group">
            <input class="form-control" name="direccion" type="text" placeholder="Dirección" require>
        </div>
        <div class="col-4 form-group">
            <select class="form-control" name="zona" require>
                <option value="" selected disabled>Zona</option>
                <?php foreach ($zonas as $zona):?>
                    <option value="<?php echo $zona['id']; ?>"><?php echo $zona['nombre']; ?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="col-6 form-group">
            <input class="form-control" type="password" name="password" placeholder="Contraseña" require>
        </div>
        <div class="col-6 form-group">
            <input class="form-control" type="password" name="repassword" placeholder="Repetir Contraseña" require>
        </div>
        

        <div class="col-12">
            <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                <div id="drag_upload_file">
                  <i class="fas fa-cloud-upload-alt"></i>
                  <input type="file" id="selectfile" name="img" accept="image/*" onchange="loadFile(event)" require>
                  <img id="output" src="" alt="">
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div id="mapid" style="width: 100%; height: 400px;"></div>
            <input type="hidden" id="lat" name="lat" >
            <input type="hidden" id="lng" name="lng" >

        </div>

        

        <div class="col-12">
            <p id="error" class="error"><?php echo $msg; ?></p>
        </div>
        <div class="col-12">
            <input class="margin-auto btn btn-primary m-b-15px" type="submit" value="Registrarse">
        </div>
    </form>
</body>
</html>





<script>

var mymap = L.map('mapid').locate({setView: true, maxZoom: 16}).setView([51.505, -0.09], 13);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		id: 'mapbox.streets'
	}).addTo(mymap);
	var restaurante = null;
	var popup = L.popup();

	function onMapClick(e) {
        document.getElementById('lat').value = e.latlng.lat; 
        document.getElementById('lng').value = e.latlng.lng; 

		if(restaurante == null) {
            popup
                .setLatLng(e.latlng)
                .setContent("Aqui estaria tu restaurante ")
                .openOn(mymap);
			restaurante = L.marker(e.latlng).addTo(mymap);
		} else {
			restaurante.setLatLng(e.latlng); 
		}
	}

	mymap.on('click', onMapClick);

</script>
