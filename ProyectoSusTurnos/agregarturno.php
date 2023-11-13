<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&family=Ubuntu&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="../../LibreriasWebDeveloper/fontawesome-free-6.1.2-web/css/all.css"> -->
  <script src="https://kit.fontawesome.com/2c7fa5bb6b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/style.css">
  

</head>
<?php 
    include "header.php";
    ?>
<body>

  <!-- <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Mecanico</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="./index.html"><button class="btn btn-outline-success  nav-link" type="button"><i class="fa-solid fa-house"></i> Inicio</button></a>
          </li>
          <li class="nav-item">
            <a href="./agregarcliente.html"><button class="btn btn-sm btn-outline-secondary nav-link" type="button"><i class="fa-solid fa-user"></i> Agregar cliente</button></a>
        </li>
          <li class="nav-item">
           <a href="./agregarturno.html"><button class="btn btn-sm btn-outline-secondary nav-link" type="button"><i class="fa-solid fa-pen-to-square"></i> Agregar turno</button></a> 
          </li>
        <li class="nav-item dropdown">
            <button class="btn btn-sm btn-outline-secondary nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-pen-to-square"></i> TURNOS</button>

          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./turnospendientes.html">Turnos pendientes</a></li>
            <li><a class="dropdown-item" href="./turnosenproceso.html">Turnos en proceso</a></li>
            <li><a class="dropdown-item" href="./turnosfinalizados.html">Turnos finalizados</a></li>
          </ul>
        </li>
        </ul>
      </div>
    </div>
  </nav> -->

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-10">
                    <h2 class="mt-5">Agendar turno</h2>
                    <p>Porfavor complete el siguiente formulario.</p>
                    <form action="/create.php" method="post">
                            
                        <div class="form-group"> <!-- State Button -->
                            <label for="COD_CLIENTE" class="control-label">Cliente</label>
                            <select class="form-control" id="COD_CLIENTE">
                                <option value="AL">Franco Lehmann</option>
                                <option value="AK">Manuel Carrizo</option>
                                <option value="AZ">Mapsi Perez</option>
                              
                            </select>                    
                        </div>

                        <div class="form-group">
                            <label>Observaciones</label>
                            <input type="text" name="apellido" class="form-control "></textarea>
                            <span class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label>Patente</label>
                            <input type="text" name="apellido" class="form-control "></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group"> <!-- State Button -->
                            <label for="COD_ESTADO" class="control-label">Estado del turno</label>
                            <select class="form-control" id="COD_ESTADO">
                                <option value="AL">PENDIENTE</option>
                                <option value="AK">PROCESO</option>
                                
                              
                            </select>                    
                        </div>

                        <br>

                        <div>
                        <label for="start">Fecha de inicio:</label>
                        <input type="date" id="start" name="trip-start" value="2022-01-01" min="2022-01-01" max="2030-12-31">
                        </div>

                        <br>

                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script></body>
</html>
