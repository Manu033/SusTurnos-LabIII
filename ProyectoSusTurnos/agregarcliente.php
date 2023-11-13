<script type="text/javascript" src="app.js"></script>
<?php
//Incluir archivo config para coneccion BD
require_once "config.php";

//Definimos variables e inicializamos vacias
$nombre = $apellido = $email = "";
$telefono = $documento = 0;
$nombre_err = $apellido_err = $email_err = "";
$telefono_err = $documento_err = 0;

//Procesamos cuando enviamos el form

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Validamos el nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Porfavor ingresa un nombre:";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Porfavor ingresa un nombre valido.";
    } else{
        $nombre = $input_nombre;
    }

    //Validamos el apellido
    $input_apellido = trim($_POST["apellido"]);
    if(empty($input_apellido)){
        $apellido_err = "Porfavor ingresa un apellido:";
    } elseif(!filter_var($input_apellido, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $apellido_err = "Porfavor ingresa un apellido valido.";
    } else{
        $apellido = $input_apellido;
    }

    // Validamos el email
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Por favor ingrese un email.";
    } elseif (!strpos($input_email, "@gmail.com")) {
        $email_err = "Por favor ingrese un email de Gmail válido.";
    } else {
        $email = $input_email;
    }

    // Validamos el telefono
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Porfavor ingrese un numero de telefono.";     
    } elseif(!ctype_digit($input_telefono)){
        $telefono_err = "Ingrese un numero de telefono valido.";
    } else{
        $telefono = $input_telefono;
    }

    // Validamos el documento
    $input_documento = trim($_POST["documento"]);
    if(empty($input_documento)){
        $documento_err = "Porfavor ingrese un numero de documento.";     
    } elseif(!ctype_digit($input_documento)){
        $documento_err = "Ingrese un numero de documento valido.";
    } else{
        $documento = $input_documento;
    }


    //Verificamos si tenemos errores
    if(empty($nombre_err) && empty($apellido_err) && empty($email_err) && empty($telefono_err) && empty($documento_err)){
        //CONCATENAMOS EL NOMBRE COMPLETO
        $nombre_completo = $nombre. " ". $apellido;
        //PREPARAMOS LA SENTENCIA DE INSERT
        $sql = 'INSERT INTO CLIENTES (NOMBRE_COMPLETO, NOMBRE, APELLIDO, NRO_CELULAR, NRO_DOCUMENTO, EMAIL) VALUES (?,?,?,?,?,?)';
        if($stmt = mysqli_prepare($DB_conn, $sql)){
            mysqli_stmt_bind_param($stmt,"sssiis", $param_nombre_completo, $param_nombre, $param_apellido, $param_celular, $param_documento, $param_email);

            //Seteamos los parametros
            $param_nombre_completo = $nombre_completo;
            $param_nombre = $nombre;
            $param_apellido = $apellido;
            $param_celular = $telefono;
            $param_documento = $documento;
            $param_email = $email;

            // Intentamos ejecutar la instruccion
            if(mysqli_stmt_execute($stmt)){
                echo "<script> redireccionar(1,1); </script>";
                exit();
            } else{
                echo "<script> redireccionar(2,1); </script>";
            }
        }

        //Cerrar sentencia
        mysqli_stmt_close($stmt);
    }

    // Cerrar conexion
    mysqli_close($DB_conn);
}
?>

<?php include "header.php";?>

<body>



    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-10">
                    <h2 class="mt-5">Crear Cliente</h2>
                    <p>Porfavor complete el siguiente formulario.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" name="apellido" class="form-control <?php echo (!empty($apellido_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apellido; ?>">
                            <span class="invalid-feedback"><?php echo $apellido_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="number" name="telefono" class="form-control <?php echo (!empty($telefono_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telefono; ?>">
                            <span class="invalid-feedback"><?php echo $telefono_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Documento</label>
                            <input type="number" name="documento" class="form-control <?php echo (!empty($documento_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $documento; ?>">
                            <span class="invalid-feedback"><?php echo $documento_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>


                        <input type="submit" id="botones" class="btn btn-success" value="Aceptar">
                        <a href="clientes.php" id="botones" class="btn btn-danger ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>


 <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
</body>
</html>  