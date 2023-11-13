<script type="text/javascript" src="app.js"></script>
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$descripcion = "";
$precio = "";
$descripcion_err = "";
$precio_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["COD_SERVICIO"]) && !empty($_POST["COD_SERVICIO"])){
    // Get hidden input value
    $COD_SERVICIO = $_POST["COD_SERVICIO"];
    
    // Validamos descripcion
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

    // Check input errors before inserting in database
    if(empty($precio_err) && empty($descripcion_err)){
        // Prepare an update statement
        $sql = "UPDATE SERVICIOS SET DESCRIPCION=?, PRECIO=? WHERE COD_SERVICIO=?";
         
        if($stmt = mysqli_prepare($DB_conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,"sii", $param_descripcion, $param_precio, $param_cod_servicio);
            
            //Seteamos los parametros
            $param_descripcion = $descripcion;
            $param_precio = $precio;
            $param_cod_servicio = $COD_SERVICIO;

            

            
            // Intentamos ejecutar la instruccion
            if(mysqli_stmt_execute($stmt)){
                // Registro creado exitosamente, redireccionamos
                
                echo "<script> modificado(1,0); </script>";
                
                exit();
            } else{
                echo "<script> modificado(0,0); </script>";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($DB_conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["COD_SERVICIO"]) && !empty(trim($_GET["COD_SERVICIO"]))){
        // Get URL parameter
        $COD_SERVICIO =  trim($_GET["COD_SERVICIO"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM SERVICIOS WHERE COD_SERVICIO = ?";
        if($stmt = mysqli_prepare($DB_conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_COD_SERVICIO);
            
            // Set parameters
            $param_COD_SERVICIO = $COD_SERVICIO;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
              
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $descripcion = $row["DESCRIPCION"];
                    $precio = $row["PRECIO"];
                } else{
                    // La URL no contiene un COD_SERVICIO VALIDO
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
                            <label>Descripcion</label>
                            <input type="text" name="descripcion" class="form-control <?php echo (!empty($descripcion_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $descripcion; ?>">
                            <span class="invalid-feedback"><?php echo $descripcion_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input type="text" name="precio" class="form-control <?php echo (!empty($precio_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $precio; ?>">
                            <span class="invalid-feedback"><?php echo $precio_err;?></span>
                        </div>

                        <input type="hidden" name="COD_SERVICIO" value="<?php echo $COD_SERVICIO; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="serviciosvista.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>


