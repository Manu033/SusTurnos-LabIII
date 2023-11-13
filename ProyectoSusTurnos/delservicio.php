<?php
// Process delete operation after confirmation
if(isset($_POST["COD_SERVICIO"]) && !empty($_POST["COD_SERVICIO"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM SERVICIOS WHERE COD_SERVICIO = ?";
    
    if($stmt = mysqli_prepare($DB_conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_COD_SERVICIO);
        
        // Set parameters
        $param_COD_SERVICIO = trim($_POST["COD_SERVICIO"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: serviciosvista.php");
            exit();
        } else{
            echo "Algo ha ido mal. Intente nuevamente.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($DB_conn);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["COD_SERVICIO"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Eliminar Registro</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="COD_SERVICIO" value="<?php echo trim($_GET["COD_SERVICIO"]); ?>"/>
                            <p>Estas seguro que deseas eliminar esta servicio?</p>
                            <p>El servicio no se eliminará si existen servicios brindados de este tipo</p> 
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="serviciosvista.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>