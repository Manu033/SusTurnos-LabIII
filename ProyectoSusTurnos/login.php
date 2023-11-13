<?php
session_start();
require_once "config.php";
// Comprueba si el usuario ya ha iniciado sesión, si es así redirige a la página de inicio
// if (isset($_SESSION['usuario'])) {
//     header("Location: index.php");
//     exit();
// }

// Comprueba si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Comprueba que se han introducido el nombre de usuario y la contraseña
    if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {

        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        if($usuario == "admin" && $contrasena == "admin"){
            $_SESSION["user"] = "admin";
            header("Location: index.php",TRUE,301);
            die();
        
        }
        else{

            $query = "SELECT * FROM CLIENTES WHERE NRO_DOCUMENTO= '$usuario' AND CLAVE= '$contrasena'";
            $result = mysqli_query($DB_conn, $query);
            $row = mysqli_fetch_array($result);
            // Si se encuentra un usuario con estas credenciales, inicia la sesión y redirige a la página de inicio
            if (mysqli_num_rows($result) == 1) {
                $_SESSION["user"] = "admin";
                $_SESSION["cod_cliente"] = $row['COD_CLIENTE'];
                header("Location: menudeusuario.php");
                exit();
            } else {
                // Si no se encuentra un usuario con estas credenciales, muestra un mensaje de error
                echo "<script> document.getElementById('error-message').style.display = 'block'; </script>";
            }

            mysqli_close($con);

        }                   
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Inicio Sesion-Turnero</title>
	<script src="https://kit.fontawesome.com/2c7fa5bb6b.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="./imagenes/logoVentana.png">
    <link href="styleLogin.css" rel="stylesheet">
</head>
<body class="text-center">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-signin">
		<i class="fa-regular fa-calendar-days fa-4x" style="color: #ffff;"></i>
		<h1 class="h3 mb-3 font-weight-normal" style="color: #ffff;">Sus Turnos</h1>
		<label for="inputDni" class="sr-only">DNI</label>
		<input type="text" id="inputDni" class="form-control" name= "usuario" placeholder="Numero de Documento" required autofocus>
		<label for="inputClave" class="sr-only">Contraseña</label>
		<input type="password" id="inputClave" class="form-control" name= "contrasena"  placeholder="Contraseña" required>
        <div id="liveAlertPlaceholder"></div>
		<button class="btn btn-lg btn-primary btn-block" type="submit" id="liveAlertBtn">Iniciar sesion</button>
        <div>
            <a href="./formularioclientenuevo.php">Quiero ser cliente</a>
        </div>

        <div id="error-message" class="alert alert-danger" style="display: none;">
        Usuario o contraseña incorrectos.
        </div>
        
        <!-- <button type="button" class="btn btn-primary" type="submit" id="liveAlertBtn">Iniciar sesion</button> -->
		<p class="mt-5 mb-3 text-muted" >&copy;TusTurnos</p>
	</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script type="text/javascript" src="app.js"></script>
</body>
</html>