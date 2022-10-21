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
  $errors = "";
  if (empty($_POST['name'])) {
    $error .= "<li>No ha enviado el nombre del usuario</li>";
  } 
  if (empty($_POST['birthday'])) {
    $error .= "<li>No ha enviado la fecha de nacimiento</li>";
  } 

?>
</body>
</html>