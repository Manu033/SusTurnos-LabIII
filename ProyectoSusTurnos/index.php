<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
include "header.php";
?>
<body>
    <div class="container_info d-flex " id="divpendientes" onclick= "window.location = 'buscadorserv.php'">
        
        <div class="cuadrado_proceso cuadrado" id="divproceso" onclick= "window.location = 'buscadorserv.php'">
            <p class="titulo_turnos">Turnos Sin Finalizar: </p>
            <p class="num_turnos" id="proceso">0</p>
        </div>
        <div class="cuadrado_proceso cuadrado" id="divproceso" onclick= "window.location = 'buscadorserv.php'">
            <p class="titulo_turnos">Turnos Sin Cobrar: </p>
            <p class="num_turnos" id="sincobrar">0</p>
        </div>

        
    </div>

    <div class="container_info d-flex " id="divpendientes" onclick= "window.location = 'buscadorserv.php'">
        
    <div class="cuadrado_finalizado cuadrado" id="divfinalizado" onclick= "window.location = 'buscadorserv.php'">
            <p class="titulo_turnos">Turnos Finalizados: </p>
            <p class="num_turnos" id="finalizado">0</p>
        </div>

        <div class="cuadrado_finalizado cuadrado" id="divfinalizado" onclick= "window.location = 'buscadorserv.php'">
            <p class="titulo_turnos">Turnos Cobrados: </p>
            <p class="num_turnos" id="cobrado">0</p>
        </div>
    </div>

    <?php
    //Incluir archivo config para coneccion BD
    require_once "config.php";
    //Consulta de estados y carga de valores
   /* $sql = "SELECT * FROM SERVICIOS_BRINDADOS WHERE COD_ESTADO = 3";
    if ($result = mysqli_query($DB_conn, $sql)){
        echo '<script type="text/javascript">'
   , '$("#pendientes").html( "'. mysqli_num_rows($result).'");'
   , '</script>';
    }*/   

    $sql1 = "SELECT * FROM SERVICIOS_BRINDADOS WHERE FINALIZADO = 0";
    if ($result = mysqli_query($DB_conn, $sql1)){
        echo '<script type="text/javascript">'
   , '$("#proceso").html( "'. mysqli_num_rows($result).'");'
   , '</script>';
    }   

    $sql2 = "SELECT * FROM SERVICIOS_BRINDADOS WHERE FINALIZADO = 1";
    if ($result = mysqli_query($DB_conn, $sql2)){
        echo '<script type="text/javascript">'
   , '$("#finalizado").html( "'. mysqli_num_rows($result).'");'
   , '</script>';
    }   
    $sql3 = "SELECT * FROM SERVICIOS_BRINDADOS WHERE PAGO = 0";
    if ($result = mysqli_query($DB_conn, $sql3)){
        echo '<script type="text/javascript">'
   , '$("#sincobrar").html( "'. mysqli_num_rows($result).'");'
   , '</script>';
    }  
    $sql4 = "SELECT * FROM SERVICIOS_BRINDADOS WHERE PAGO = 1";
    if ($result = mysqli_query($DB_conn, $sql4)){
        echo '<script type="text/javascript">'
   , '$("#cobrado").html( "'. mysqli_num_rows($result).'");'
   , '</script>';
    }  

    ?>
    <div>
    <?php include "buscadorservindex.php"; ?>
    </div>
     <?php include "footer.php"; ?> 
    
   

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script> -->
</body>
</html>
