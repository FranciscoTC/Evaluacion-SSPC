<?php

//Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "generosliterarios");
if(mysqli_connect_errno()){
	echo 'Conexión fallida: ', mysqli_connect_error();
    echo '<br>';
} else{
    echo 'Conexión exitosa...'.'<br>';
}

?>