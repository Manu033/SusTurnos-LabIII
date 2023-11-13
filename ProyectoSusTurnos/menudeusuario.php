<?php
session_start();
include "headerusuario.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TusTurnos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

<?php
  require_once "config.php";
  
  $query ="SELECT SB.COD_SERVICIO_BRINDADO, CL.NOMBRE_COMPLETO, CL.NRO_DOCUMENTO, SB.FECHA_TURNO, SE.PRECIO, SB.PAGO, SB.FINALIZADO, SE.DESCRIPCION
  FROM SERVICIOS_BRINDADOS SB 
  INNER JOIN CLIENTES CL ON SB.COD_CLIENTE = CL.COD_CLIENTE
  INNER JOIN SERVICIOS SE ON SB.COD_SERVICIO = SE.COD_SERVICIO  
          WHERE SB.COD_CLIENTE =  '" .$_SESSION["cod_cliente"]."' " ;
  
  $sql = $DB_conn->query($query);
  $numeroSql = mysqli_num_rows($sql);
?>

<div class="table-responsive table_margin_usuario">
        <table class="table">
                <thead>
                        <tr style="background-color:purple; color:#FFFFFF;">
                                <th style=" text-align: center;"> Nombre Cliente </th>
                                <th style=" text-align: center;"> Documento </th>
                                <th style=" text-align: center;"> Tipo Servicio </th>
                                <th style=" text-align: center;"> Precio </th>
                                <th style=" text-align: center;"> Fecha de Turno </th>
                                <th style=" text-align: center;"> Pagado </th> 
                                <th style=" text-align: center;"> Finalizado </th> 

                        </tr>
                </thead>
                <tbody>
                <?php 
                // if($sql = $DB_conn->query($query)){
                //         $row = $sql->fetch_assoc();
                // } else {
                //        printf("Error: %s\n", $DB_conn->error);
                // }
                While($row = $sql->fetch_assoc()) {   ?>
               
                        <tr>
                        <td style="text-align: center;"><?php echo $row["NOMBRE_COMPLETO"]; ?></td>
                        <td style="text-align: center;"><?php echo $row["NRO_DOCUMENTO"]; ?></td>
                        <td style="text-align: center;"><?php echo $row["DESCRIPCION"]; ?></td>
                        <td style="text-align: center;"><?php echo $row["PRECIO"]; ?> $</td>
                        <td style=" text-align: center;"><?php echo $row["FECHA_TURNO"]; ?></td>
                        <td style=" text-align: center;"><?php if($row["PAGO"]){echo "SI";}; ?></td>
                        <td style=" text-align: center;"><?php if($row["FINALIZADO"]){echo "SI";}; ?></td>
                        <td style= "text-align:center;">
                                <?php 
                                        //echo '<a href="./cambioestado.php?COD_SERVICIO_BRINDADO='. $row['COD_SERVICIO_BRINDADO'] .'" class="mr-3" title="Modificar Registro" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                ?>
                        </td>
                        </tr>
               <?php } ?>
                </tbody>
        </table>
</div>


