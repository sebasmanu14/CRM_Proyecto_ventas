<?php

  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';

  if ($_POST['name'] != null) {
    $data = [
      "visible" => true,
      "estado" => true,
      "nombre" => $_POST['name'],
    ];

    $result = CurlHelper::perform_http_request(
      'POST',
      $base . "/tipo_pago/store", 
      $data
    );
    header("Location: tipo_pago.php");
  }
  header("Location: tipo_pago.php");
  exit;
?>
