<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear perfil</title>
</head>
<body>
<?php
  $errors = []; //Como pueden fallar varias cosas, voy a almacenar todos los errores en un array.

  // Se comprueba el nombre de usuario.
  if (empty($_POST['name'])) {
    $errors[] = "No ha enviado el nombre del usuario.";
  }

  // Se comprueba la fecha de nacimiento.
  if (empty($_POST['birthday'])) {
    $errors[] = "No ha enviado la fecha de nacimiento.";
  } else {
    $birthday = date_create_from_format('Y-m-d', $_POST['birthday']);
    if (!$birthday) {
      $errors[] = "La fecha " . $_POST['birthday'] . " no es válida. Se espera el formato YYYY-mm-dd";
    } else {
      $now = new DateTime();
      if ($now<$birthday) {
        $errors[] = "No se puede crear un usuario que aún no ha nacido.";
      } 
    }
  }

  // Se comprueba la foto
  if (empty($_FILES['photo']['name'])) {
    $errors[] = "No se ha enviado la foto del usuario.";
  } else {
    $tmpName = $_FILES['photo']['tmp_name'];
    if (!is_uploaded_file($tmpName)) {
      $errors[] = "No se pudo subir la imagen.";
    } else {
      // Comprobamos el formato
      $allowFormats = ['image/jpeg', 'image/gif', 'image/png'];
      if (!in_array($_FILES['photo']['type'], $allowFormats)) {
        $errors[] = "Está enviando un archivo de formato '" 
          . $_FILES['photo']['type']
          . "'. Debe enviar JPEG, GIF o PNG";
      } 
    }
  }

  if (count($errors)>0) { // Si hay algún error.
    // Se muestran los errores
    echo "<h1>Datos erróneos: </h1>";
    echo "<ul>";
    foreach($errors as $error) {
      echo "<li>" . $error . "</li>";
    }
    echo "</ul>";
  } else {
    // No hay errores, obtenemos los datos y calculamos edad.
    $name = $_POST['name'];
    $diff = $now->diff($birthday);
    $age = $diff->format("%Y");  
    // Movemos la imagen a la carpeta 'profiles'
    $fileName = $_FILES['photo']['name'];
    // Obtenemos la extension
    $parts = explode('.',$fileName);
    $extension = $parts[count($parts)-1];
    $finalName = $name . "." . $extension;
    move_uploaded_file($tmpName, 'profiles/' . $finalName);
?>
  <p>Nombre: <?=$name?> </p>
  <p>Edad: <?=$age?> </p>
  <p>
    <img src="profiles/<?=$finalName?>" alt="foto de <?=$name?>">
  </p>
<?php
  }

?>
</body>
</html>