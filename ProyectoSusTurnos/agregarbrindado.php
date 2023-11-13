<script type="text/javascript" src="app.js"></script>
<?php
//Incluir archivo config para coneccion BD
require_once "config.php";

//Definimos variables e inicializamos vacias
$cliente = $servicio = 0;
$observaciones = "";
$fecha_turno = "";
$cliente_err = $servicio_err = 0;
$fecha_turno_err = "";

//Procesamos cuando enviamos el form

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //No validamos ya que no puede errar en un selector
    $cliente = trim($_POST["cliente"]);
    $servicio = trim($_POST["servicio"]);
    $observaciones = trim($_POST["observaciones"]);
    $fecha_turno = trim($_POST["fecha_turno"]);

     

    //Verificamos si tenemos errores
    if (empty($nombre_err) && empty($apellido_err) && empty($email_err) && empty($telefono_err) && empty($documento_err)) {
        // Preparamos la sentencia de INSERT
        $sql = 'INSERT INTO SERVICIOS_BRINDADOS (COD_CLIENTE, COD_SERVICIO, FECHA_TURNO, OBSERVACIONES) VALUES (?,?,?,?)';
        if ($stmt = mysqli_prepare($DB_conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "iiss", $param_cod_cliente, $param_cod_servicio, $param_fecha_turno, $param_observaciones);
    
            // Seteamos los parametros
            $param_cod_cliente = $cliente;
            $param_cod_servicio = $servicio;
            if ($fecha_turno == '') {
                $param_fecha_turno = NULL;
            } else {
                $param_fecha_turno = $fecha_turno;
            }
            $param_observaciones = $observaciones;
    
        // Intentamos ejecutar la instruccion
        if(mysqli_stmt_execute($stmt)){
            // Registro modificado exitosamente, redireccionamos
            echo "<script> modificado(1,3); </script>";
        } else{
            echo "<script> modificado(0,3); </script>";
        }
        }
    
        // Cerrar sentencia
        mysqli_stmt_close($stmt);
    }
}

?>

    <?php include "header.php"; ?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-10">
                    <h2 class="mt-5">Crear turno</h2>
                    <p>Porfavor complete el siguiente formulario.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">



                        <div class="form-group" id= "clientes1">
                            <label> Cliente <select name="cliente" class = "form-control <?php echo (!empty($cliente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cliente; ?>" >
                            <?php
                            $sql = "SELECT * FROM CLIENTES";
                            $ejecutar = mysqli_query($DB_conn, $sql);

                            ?>
                            <?php foreach($ejecutar as $opciones): ?>

                                <option value="<?php echo $opciones['COD_CLIENTE']?>"> <?php echo $opciones['NOMBRE_COMPLETO'] ?></option>
                            <?php endforeach ?>
                            </select></label>
                        </div>

                        <div class="form-group" id= "servicio">
                            <label> Servicio <select name="servicio" class = "form-control <?php echo (!empty($servicio_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $servicio; ?>" >
                            <?php
                            $sql = "SELECT * FROM SERVICIOS";
                            $ejecutar = mysqli_query($DB_conn, $sql);

                            ?>
                            <?php foreach($ejecutar as $opciones): ?>

                                <option value="<?php echo $opciones['COD_SERVICIO']?>"> <?php echo $opciones['DESCRIPCION'] ?></option>
                            <?php endforeach ?>
                            </select></label>
                        </div>

                        <div class="form-group">
                            <label>Fecha de turno</label>
                            <input type="datetime-local" name="fecha_turno" class="form-control <?php echo (!empty($fecha_turno_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fecha_turno; ?>">
                            <span class="invalid-feedback"></span>
                        </div>
                                                    
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="observaciones" maxlength="50" class="form-control <?php echo (!empty($observaciones_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $observaciones; ?>"></textarea> 
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