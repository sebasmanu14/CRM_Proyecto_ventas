<?php

  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';

  if ($_POST['tipo_producto_creat'] != null &&
  $_POST['name_creat'] != null &&
  $_POST['fecha_fabricacion_creat'] != null &&
  $_POST['fecha_vencimiento_creat'] != null &&
  $_POST['precio_creat'] != null &&
  $_POST['cantidad_creat'] != null &&
  $_POST['descripcion_creat'] != null) {
    $data = [
      "visible" => true,
      "estado" => true,
      "tipo_producto_fk_nombre" => $_POST['tipo_producto_creat'],
      "nombre" => $_POST['name_creat'],
      "fecha_fabricacion" => $_POST['fecha_fabricacion_creat'],
      "fecha_vencimiento" => $_POST['fecha_vencimiento_creat'],
      "precio" => $_POST['precio_creat'],
      "cantidad" => $_POST['cantidad_creat'],
      "descripcion" => $_POST['descripcion_creat']
    ];

    $result = CurlHelper::perform_http_request(
      'POST',
      $base . "/productos/store", 
      $data
    );
    header("Location: productos.php");
    exit;
  }
  header("Location: productos.php");
  exit;
?>
