<?php

//Definición de la clase
class Profiles {
    // recupera el registro identificado por $id
    function getProfile($id) {
        // Escribe aqui la funcionalidad
        echo "Buscamos el perfil con id: $id"."<br>";

        require('conexion.php');
        echo "<br>";
        $sql = "SELECT * FROM usuarios WHERE id_user = '$id'";
        $result = mysqli_query($conexion, $sql);
        $usuarios = array();
        while($row = mysqli_fetch_assoc($result)){
            $nombre=$row['name'];
            $genero=$row['gender'];
            $preferencias=$row['preferences'];
            
            $usuarios[] = array('name'=> $nombre, 'gender'=> $genero, 'preferences'=> $preferencias);
        }

        $json_string = json_encode($usuarios);
        echo $json_string;
        echo "<br>";

        echo 'GET';
    }

    // guarda o modifica el registro identificado por $id
    function setProfile($id, $data) {
        // Escribe aqui la funcionalidad
        echo "Guardamos el perfil con id: $id y data: $data"."<br>";

        $p = json_decode($data);

        echo $p->nombre."<br>";
        echo $p->genero."<br>";
        $stringPreferences = "[";
        for($i = 0; $i < count($p->preferencias); $i++){
            $stringPreferences .= '"'.$p->preferencias[$i].'"';
            if($i < count($p->preferencias) - 1){
                $stringPreferences .= ", ";
            }
        }
        $stringPreferences .= "]";
        echo $stringPreferences."<br>";

        require('conexion.php');
        echo "<br>";
        $sql = "INSERT INTO usuarios (id_user, name, gender, preferences) VALUES ('$id', '$p->nombre', '$p->genero', '$stringPreferences')";
        $result = mysqli_query($conexion, $sql);
        mysqli_fetch_assoc($result);

        echo 'SET';
    }

  //Muestra todos los perfiles guardados
    function availables() {
        // Escribe aqui la funcionalidad
        echo "Listamos todos los perfiles disponibles"."<br>";

        require('conexion.php');
        $sql = "SELECT * FROM usuarios";
        $result = mysqli_query($conexion, $sql);
        $usuarios = array();
        while($row = mysqli_fetch_assoc($result)){
            $id=$row['id_user'];
            $nombre=$row['name'];
            
            $usuarios[] = array('id_user'=> $id, 'name'=> $nombre);
        }
        $json_string = json_encode($usuarios);
        echo $json_string;
        echo "<br>";

        echo 'AVAILABLES';
    }
}

$profile = new Profiles();

echo 'Archivo examen_p2.php';

//Voy a recibir 3 tipos de enlaces con/sin datos mediante un REQUEST
//examen_p2.php
//examen_p2.php?id=prueba
//examen_p2.php?id=prueba&data={'prueba':'true'}

//Validamos si existen datos en el REQUEST
if($_REQUEST['id'] && $_REQUEST['data']){
    echo "<br>";
    echo "Existe ID y DATA"."<br>";
    $id = $_REQUEST['id'];
    $data = $_REQUEST['data'];
    $profile->setProfile($id, $data);
} else if($_REQUEST['id']){
    echo "<br>";
    echo "Existe solo ID"."<br>";;
    $id = $_REQUEST['id'];
    $profile->getProfile($id);
} else {
    echo "<br>";
    echo "No existe ID ni DATA, mostramos perfiles disponibles"."<br>";
    $profile->availables();
}

/*Formatos de los datos que se esperan

$_REQUEST['id'] = 'antonioz';

$_REQUEST['data'] = "{
    name: 'Antonio Zarate',
    preferences: [
        'Terror',
        'Romance'
    ]
}
*/

/*
 
- ejemplo del contenido del parametro id
$_REQUEST['id'] = 'antonioz';

- ejemplo del contenido del parametro data
$_REQUEST['data'] = "
{
  name: 'Antonio Zarate',
  gender: 'Masculino',
  preferences: [
    'Terror',
    'Romance'
  ]
}
";


Funcionamiento esperado :

- examen_p2.php

  resultado:
  
  [
    { 'prueba1': 'Prueba 1' },
    { 'prueba2': 'Prueba 2' },
    { 'prueba3': 'Prueba 3' },
  ]
  

- examen_p2.php?id=prueba

  resultado:

  {
    name: 'Prueba',
    gender: 'Femenino',
    preferences: [
      'Romance'
    ]
  }

- examen_p2.php?id=prueba&data={'prueba':'true'}

  resultado:

  'true'

- si se manada con error en el formato de los parametros

  resultado:

  'false'
  


http://localhost/examen_p2/prueba.php?id=antonioz&data={ "nombre": "Antonio Zarate", "genero": "Masculino", "preferencias": ["Terror","Romance"] }

http://localhost/examen_p2/prueba.php?id=antonioz&data={ "nombre": "Antonio Zarate", "genero": "Masculino", "preferencias": ["Terror","Romance"] }


*/
