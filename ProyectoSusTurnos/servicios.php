<?php include "header.php";?>
<body>  
    <?php   require_once "config.php"; ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Detalles de Servicios en Proceso</h2>                    
                    </div>
                    
                    <?php
                    // Include config file
                    require_once "config.php";

                    $sql2 = "CALL PROC_GET_SERVICIOS(2)";
                    if($result = mysqli_query($DB_conn, $sql2)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nombre cliente</th>";
                                        echo "<th>Servicio</th>";
                                        echo "<th>Patente</th>";
                                        echo "<th>Fecha inicio</th>";
                                        echo "<th>Precio</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['COD_SERVICIO_BRINDADO'] . "</td>";
                                        echo "<td>" . $row['NOMBRE_COMPLETO'] . "</td>";
                                        echo "<td>" . $row['DESCRIPCION'] . "</td>";
                                        echo "<td>" . $row['PATENTE'] . "</td>";
                                        echo "<td>" . $row['FECHA_INICIO'] . "</td>";
                                        echo "<td>" . $row['PRECIO'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="./modservicio.php?COD_SERVICIO='. $row['COD_SERVICIO'] .'" class="mr-3" title="Modificar Registro" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="./delservicio.php?COD_SERVICIO='. $row['COD_SERVICIO'] .'" title="Eliminar Registro" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                           
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>Ningun registro encontrado.</em></div>';
                        }
                    } else{
                        echo "Algo ha ido mal aca";
                    }
 
                    // Close connection
                    mysqli_close($DB_conn);



                    ?>    
                </div>
            </div>
        </div>
    </div>

</body>

</html>

