<script type="text/javascript" src="app.js"></script>
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values

$fecha_turno = "";
$pagado=0;
$finalizado=0;
$fecha_turno_err = "";

// Processing form data when form is submitted
if(isset($_POST["COD_SERVICIO_BRINDADO"]) && !empty($_POST["COD_SERVICIO_BRINDADO"])){
    // Get hidden input value
    $COD_SERVICIO_BRINDADO = $_POST["COD_SERVICIO_BRINDADO"];
    $fecha_turno = trim($_POST["fecha_turno"]);
    $pagado = trim($_POST["pagado"]);
    $finalizado = trim($_POST["finalizado"]);
   

    // Check input errors before inserting in database
    if(empty($cod_estado_err) && empty($fecha_finalizacion_err)){
        // Prepare an update statement
        $sql = "UPDATE SERVICIOS_BRINDADOS SET FECHA_TURNO=?, PAGO=?, FINALIZADO=? WHERE COD_SERVICIO_BRINDADO=?";
         
        if($stmt = mysqli_prepare($DB_conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,"siii", $param_fecha_turno, $param_pago, $param_finalizado, $param_cod_servicio_brindado);
            
            //Seteamos los parametros
            $param_fecha_turno = $fecha_turno;
            $param_pago = $pagado;
            $param_finalizado=$finalizado;
            $param_cod_servicio_brindado = $COD_SERVICIO_BRINDADO;


            
            // Intentamos ejecutar la instruccion
            if(mysqli_stmt_execute($stmt)){
                // Registro modificado exitosamente, redireccionamos
                echo "<script> modificado(1,3); </script>";
            } else{
                echo "<script> modificado(0,3); </script>";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($DB_conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["COD_SERVICIO_BRINDADO"]) && !empty(trim($_GET["COD_SERVICIO_BRINDADO"]))){
        // Get URL parameter
        $COD_SERVICIO_BRINDADO =  trim($_GET["COD_SERVICIO_BRINDADO"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM SERVICIOS_BRINDADOS WHERE COD_SERVICIO_BRINDADO = ?";
        if($stmt = mysqli_prepare($DB_conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_COD_SERVICIO_BRINDADO);
            
            // Set parameters
            $param_COD_SERVICIO_BRINDADO = $COD_SERVICIO_BRINDADO;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
              
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $fecha_turno = $row["FECHA_TURNO"];
                    $pagado = $row["PAGO"];
                    $finalizado = $row["FINALIZADO"];
                } else{
                    // La URL no contiene un COD_SERVICIO_BRINDADO VALIDO
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
        // La URL no contiene un COD_SERVICIO_BRINDADO
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
                <div class="col-md-12">
                    <h2 class="mt-5">Actualizar Estado del servicio</h2>
                    <p>Porfavor complete el siguiente formulario.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group">
                            <label>Fecha del Turno</label>
                            <input type="date" name="fecha_turno" class="form-control <?php echo (!empty($fecha_turno_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fecha_turno; ?>">
                            <span class="invalid-feedback"><?php echo $fecha_turno;?></span>
                        </div>
                        <div class="form-group">
                            <label>Pago</label>
                            <input type="checkbox" id="pagado" name="pagado" value="1<?php echo isset($_POST['pagado']) ? $_POST['pagado'] : ''; ?>" style="border: #bababa 1px solid; color: #000000;">
                           <!-- <input type="checkbox" id="pagado" name="pagado"  value="1<?php/* echo $_POST["pagado"]; */?>" style="border: #bababa 1px solid; color:#000000;" >-->
                        </div>
                        <div class="form-group">
                            <label>Finalizado</label>
                            <input type="checkbox" id="finalizado" name="finalizado" value="1<?php echo isset($_POST['finalizado']) ? $_POST['finalizado'] : ''; ?>" style="border: #bababa 1px solid; color: #000000;">
                            <!--<input type="checkbox" id="finalizado" name="finalizado"  value="1<?php /*echo $_POST["finalizado"]; */?>" style="border: #bababa 1px solid; color:#000000;" >-->
                        </div>


                        <input type="hidden" name="COD_SERVICIO_BRINDADO" value="<?php echo $COD_SERVICIO_BRINDADO; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="buscadorserv.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>



