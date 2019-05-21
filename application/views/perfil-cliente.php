<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.0/css/mdb.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
    </style>
        <script>
          var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
              var output = document.getElementById('output');
              output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
          };
        </script>
</head>
<body>
<div class="container">
<form action="<?php echo base_url(); ?>cliente/registro/" method="post" enctype='multipart/form-data' class="box m-t-50px row z-depth-1">
        <div class="col-12 form-group">
            <img class="logo" src="<?php echo base_url(); ?>/public/img/logo.png" alt="" srcset="">
            <h3>Cliente</h3>
        </div>
        <div class="col-4 form-group">
            <input class="form-control" type="text" name="nickname" placeholder="Nickname">
        </div>
        <div class="col-4 form-group">
            <input class="form-control" type="text" name="nombre" placeholder="Nombre">
        </div>
        <div class="col-4 form-group">
            <input class="form-control" type="text" name="apellido" placeholder="Apellido">
        </div>
        <div class="col-6 form-group">
            <input class="form-control" type="text" name="fecha_de_nacimiento" placeholder="Fecha de nacimiento">
        </div>
        <div class="col-6 form-group">
            <input class="form-control" type="text" name="email" placeholder="Email">
        </div>
        <div class="col-12">
            <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                <div id="drag_upload_file">
                  <i class="fas fa-cloud-upload-alt"></i>
                  <input type="file" id="selectfile" name="img" accept="image/*" onchange="loadFile(event)">
                  <img id="output" src="" alt="">
                </div>
            </div>
        </div>
        <div class="col-12">
            <p class="error"><?php echo $msg; ?></p>
        </div>
        <div class="col-12">
            <input class="margin-auto btn btn-primary m-b-15px" type="submit" value="Iniciar sesion">
        </div>
    </form>
</body>
</html>