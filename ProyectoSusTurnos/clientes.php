<?php include "header.php";?>
<head>
<link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-10">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left" id="detalles">Detalles de Clientes</h2>
                        <a href="./agregarcliente.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar nuevo cliente</a>
                    </div>
                    <div class="table-responsive ">
                    <?php
                    // Include config file

                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM CLIENTES";
                   // $result = mysqli_query($DB_conn, $sql)
                    
                    if($result = mysqli_query($DB_conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Apellido</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Telefono</th>";                                        
                                        echo "<th>Documento</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['COD_CLIENTE'] . "</td>";
                                        echo "<td>" . $row['NOMBRE'] . "</td>";
                                        echo "<td>" . $row['APELLIDO'] . "</td>";
                                        echo "<td>" . $row['EMAIL'] . "</td>";
                                        echo "<td>" . $row['NRO_CELULAR'] . "</td>";
                                        echo "<td>" . $row['NRO_DOCUMENTO'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="./modcliente.php?COD_CLIENTE='. $row['COD_CLIENTE'] .'" class="mr-3" title="Modificar Registro" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="./delcliente.php?COD_CLIENTE='. $row['COD_CLIENTE'] .'" title="Eliminar Registro" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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
    </div>
</body>
</html>