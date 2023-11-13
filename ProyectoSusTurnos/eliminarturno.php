<?php
// Include config file
require_once "config.php";
 include "header.php"?>



<h1>¿SEGURO QUE DESEA BORRAR ESTE TURNO?</h1>

<?php


$sql= "DELETE FROM servicios_brindados WHERE `servicios_brindados`.`COD_SERVICIO_BRINDADO` = 12"
?>


<input type="submit" class="btn btn-primary" value="Aceptar">
<a href="buscadorserv.php" class="btn btn-secondary ml-2">Cancelar</a>

