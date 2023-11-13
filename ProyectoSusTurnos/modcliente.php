<script type="text/javascript" src="app.js"></script>
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = "";
$apellido = "";
$email = "";
$nro_celular=0;
$nro_documento = 0;
$nombre_err = "";
$apellido_err = "";
$email_err = "";
$nro_celular_err ="";
$nro_documento_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["COD_CLIENTE"]) && !empty($_POST["COD_CLIENTE"])){
    // Get hidden input value
    $COD_CLIENTE = $_POST["COD_CLIENTE"];
    
    // Validate nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Porfavor ingresa un nombre:";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Porfavor ingresa un nombre valido.";
    } else{
        $nombre = $input_nombre;
    }
    
    // Validate apellido
    $input_apellido = trim($_POST["apellido"]);
    if(empty($input_apellido)){
        $apellido_err = "Porfavor ingresa un apellido.";     
    } else{
        $apellido = $input_apellido;
    }
    
    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Porfavor ingrese un email.";     
    } else{
        $email = $input_email;
    }

    // Validate telefono
    $input_telefono = trim($_POST["nro_celular"]);
    if(empty($input_telefono)){
        $nro_celular_err = "Porfavor ingrese un numero de telefono.";     
    } elseif(!ctype_digit($input_telefono)){
        $nro_celular_err = "Ingrese un numero de telefono valido.";
    } else{
        $nro_celular = $input_telefono;
    }
    
    // Validate nro documento
    $input_nro_documento = trim($_POST["nro_documento"]);
    if(empty($input_nro_documento)){
        $nro_documento_err = "Porfavor ingrese un tipo de contacto.";     
    } elseif(!ctype_digit($input_nro_documento)){
        $nro_documento_err = "Ingrese un numero de contacto valido.";
    } else{
        $nro_documento = $input_nro_documento;
    }

    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($apellido_err) && empty($email_err) && empty($nro_celular_err) && empty($nro_documento_err)){
        //CONCATENAMOS EL NOMBRE COMPLETO
        $nombre_completo = $nombre. " ". $apellido;
        // Prepare an update statement
        $sql = "UPDATE CLIENTES SET NOMBRE_COMPLETO=?, NOMBRE=?, APELLIDO=?, NRO_CELULAR=?, NRO_DOCUMENTO=?, EMAIL=? WHERE COD_CLIENTE=?";
         
        if($stmt = mysqli_prepare($DB_conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,"sssiisi", $param_nombre_completo, $param_nombre, $param_apellido, $param_celular, $param_documento, $param_email, $param_COD_CLIENTE);
            
            //Seteamos los parametros
            $param_nombre_completo = $nombre_completo;
            $param_nombre = $nombre;
            $param_apellido = $apellido;
            $param_celular = $nro_celular;
            $param_documento = $nro_documento;
            $param_email = $email;
            $param_COD_CLIENTE = $COD_CLIENTE;

            

            
            // Intentamos ejecutar la instruccion
            if(mysqli_stmt_execute($stmt)){
                // Registro creado exitosamente, redireccionamos
                echo "<script> modificado(1,1); </script>";
                exit();
            } else{
                echo "<script> modificado(0,1); </script>";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($DB_conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["COD_CLIENTE"]) && !empty(trim($_GET["COD_CLIENTE"]))){
        // Get URL parameter
        $COD_CLIENTE =  trim($_GET["COD_CLIENTE"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM CLIENTES WHERE COD_CLIENTE = ?";
        if($stmt = mysqli_prepare($DB_conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_COD_CLIENTE);
            
            // Set parameters
            $param_COD_CLIENTE = $COD_CLIENTE;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
              
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nombre = $row["NOMBRE"];
                    $apellido = $row["APELLIDO"];
                    $email = $row["EMAIL"];
                    $nro_celular = $row["NRO_CELULAR"];
                    $nro_documento = $row["NRO_DOCUMENTO"];
                } else{
                    // La URL no contiene un COD_CLIENTE VALIDO
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Algo ha ido mal. Intente nuevamente aca.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($DB_conn);
    }  else{
        // La URL no contiene un COD_CLIENTE
        header("location: error.php");
        exit();
    }
}

?>

<?php include "header.php"; ?>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-10">
                    <h2 class="mt-5">Modificar Registro</h2>
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
                            <span class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="number" name="nro_celular" class="form-control <?php echo (!empty($nro_celular_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nro_celular; ?>">
                            <span class="invalid-feedback"><?php echo $nro_celular_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Documento</label>
                            <input type="number" name="nro_documento" class="form-control <?php echo (!empty($nro_documento_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nro_documento; ?>">
                            <span class="invalid-feedback"><?php echo $nro_documento_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"></span>
                        </div>

                        <input type="hidden" name="COD_CLIENTE" value="<?php echo $COD_CLIENTE; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="clientes.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>


