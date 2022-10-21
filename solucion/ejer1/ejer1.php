<?php require('data/data_provincias.php'); ?>
<?php require('data/data_municipios.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ejercicio 1</title>
</head>
<body>
  <h1>Pueblos de España</h1>
  <?php 
  if (!isset($_POST['id_provincia'])) {
    // No se ha elegido aún la provincia. Se muestra el formulario de provincia
  ?>
    <form action="ejer1.php" method="post">
      <p>
        <label for="">
          PROVINCIA: 
          <select name="id_provincia" id="">
            <option selected disabled>Elige una provincia</option>
            <?php
            foreach($PROVINCIAS as $key => $name) {
              printf("<option value=\"%s\">%s</option>",$key, $name);
            }
            ?>
          </select>
        </label>
      </p>
      <p>
        <input type="submit" value="Enviar">
      </p>
    </form>
<?php  
  } else {
      // Tenemos una provincia 
      $idProvincia =  $_POST['id_provincia'];
      //comprobamos si también tenemos municipio.
      if (!isset($_POST['id_municipio'])) {
        // No se ha elegido aún el municipio. 
        //Se muestra la provincia
      echo "<h1>PROVINCIA: " . $PROVINCIAS[$idProvincia] . "</h1>";
      // Mostramos el formulario de municipios para esa provincia.
      // Enviamos también el id de la provincia como campo oculto.
  ?>
      <form action="ejer1.php" method="post">
        <p>
          <input type="hidden" name="id_provincia" value="<?=$idProvincia?>">
          <label for="">
            MUNICIPIOS: 
            <select name="id_municipio" id="">
              <option selected disabled>Elige un municipio</option>
              <?php
              foreach($MUNICIPIOS[$idProvincia] as $key => $name) {
                printf("<option value=\"%s\">%s</option>",$key, $name);
              }
              ?>
            </select>
          </label>
        </p>
        <p>
          <input type="submit" value="Enviar">
        </p>
      </form>    
  <?php 
      } else {
        // En este último caso, tenemos provincia y municipio seleccionado.
        $idMunicipio = $_POST['id_municipio'];
        // Mostramos la frase
        printf("<h1> El municipio de %s con código %s pertenece a %s", 
          $MUNICIPIOS[$idProvincia][$idMunicipio],
          $idMunicipio,
          $PROVINCIAS[$idProvincia]);
      } 
    }
?>
</body>
</html>