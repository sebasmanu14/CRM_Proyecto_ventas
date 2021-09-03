<?php

  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';

  if ($_POST['visible_edit'] &&
  $_POST['state_edit'] &&
  $_POST['name_edit'] &&
  $_POST['fecha_fabricacion_edit'] &&
  $_POST['fecha_vencimiento_edit'] &&
  $_POST['precio_edit'] &&
  $_POST['cantidad_edit'] &&
  $_POST['descripcion_edit'] &&
  $_POST['descripcion_edit']
  ) {
    $data = [
        "visible" => $_POST['visible_edit'],
        "estado" => $_POST['state_edit'],
        "tipo_producto_fk_nombre" => $_POST['tipo_producto_edit'],
        "nombre" => $_POST['name_edit'],
        "fecha_fabricacion" => $_POST['fecha_fabricacion_edit'],
        "fecha_vencimiento" => $_POST['fecha_vencimiento_edit'],
        "precio" => $_POST['precio_edit'],
        "cantidad" => $_POST['cantidad_edit'],
        "descripcion" => $_POST['descripcion_edit']
      ];
    $result = CurlHelper::perform_http_request(
      "PUT",
      $base."/productos/update/".$_POST['id_edit'], 
      $data
    );
    header("Location: productos.php");

  }
  header("Location: productos.php");
?>
