<?php require('users.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 2</title>
</head>
<body>
  <h2>Control de acceso</h2>
<?php
  $name = isset($_GET['name']) ? $_GET['name'] : '';
  $pw = isset($_GET['pw']) ? $_GET['pw'] : '';
  $level = login($name, $pw, $users);
  // Se puede hacer con switch pero yo prefiero los if.
  if ($level == "banned") {
    printf("<h1>El usuario %s está bloqueado.</h1>", $name);
  } elseif ($level == "user" || $level == "admin") { 
    // los administradores tambien tienen acceso al contenido de los usuarios.
    printf("<h1>El usuario %s tiene permiso de usuario</h1>", $name);
    include('contenido.html'); 
    if ($level == "admin") { // Solo los administradores ven el menu
      printf("<h1>El usuario %s tiene permiso de administrador</h1>", $name);
      include('admin.html');
    }
  } else { // Ya solo queda el caso de que no se haya logeado.
    echo "<h1>No se ha logeado. Falla el nombre o la contraseña</h1>";
  }
?>
</body>
</html>