<script type="text/javascript" src="app.js"></script>
<?php
//Incluir archivo config para coneccion BD
require_once "config.php";

//Definimos variables e inicializamos vacias
$descripcion = "";
$precio=0;
$descripcion_err="";
$precio_err="";

//Procesamos cuando enviamos el form

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Validamos la descripcion
    $input_descripcion= trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Porfavor ingresa una descripcion:";
    } elseif(!filter_var($input_descripcion, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $descripcion_err = "Porfavor ingresa un nombre valido.";
    } else{
        $descripcion = $input_descripcion;
    }

    // Validamos el precio
    $input_precio = trim($_POST["precio"]);
    if(empty($input_precio)){
        $precio_err = "Porfavor ingrese un numero de telefono.";     
    } elseif(!ctype_digit($input_precio)){
        $precio_err = "Ingrese un numero de telefono valido.";
    } else{
        $precio = $input_precio;
    }

    //Verificamos si tenemos errores
    if(empty($descipcion_err) &&  empty($precio_err)){
        //PREPARAMOS LA SENTENCIA DE INSERT
        $sql = 'INSERT INTO SERVICIOS (DESCRIPCION, PRECIO) VALUES (?,?)';
        if($stmt = mysqli_prepare($DB_conn, $sql)){
            mysqli_stmt_bind_param($stmt,"si", $param_descripcion, $param_precio);

            //Seteamos los parametros
            $param_descripcion = $descripcion;
            $param_precio = $precio;
        
            // Intentamos ejecutar la instruccion
            if(mysqli_stmt_execute($stmt)){
                // Registro creado exitosamente, redireccionamos
                echo "<script> redireccionar(1,0); </script>";
                exit();
            } else{
                echo "<script> redireccionar(2,0); </script>";
            }
        }

        //Cerrar sentencia
        mysqli_stmt_close($stmt);
    }

    // Cerrar conexion
    mysqli_close($DB_conn);
}
?>

<?php include "header.php"; ?>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-10">
                    <h2 class="mt-5">Crear Servicio</h2>
                    <p>Porfavor complete el siguiente formulario.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <input type="text" name="descripcion" class="form-control <?php echo (!empty($descripcion_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $descripcion; ?>">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Precio</label>
                            <input type="number" name="precio" class="form-control <?php echo (!empty($precio_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $precio; ?>">
                            <span class="invalid-feedback">0</span>
                        </div>
          
                        <input type="submit" id="botones" class="btn btn-success" value="Aceptar">
                        <a href="index.php" id="botones" class="btn btn-danger ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>


 <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
</body>
</html>  