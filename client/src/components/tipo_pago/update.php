<?php

  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';

  if ($_POST['visible_edit'] &&
  $_POST['state_edit'] &&
  $_POST['name_edit']
  ) {
    $data = [
      "visible" => $_POST['visible_edit'],
      "estado" => $_POST['state_edit'],
      "nombre" => $_POST['name_edit']
    ];
    $result = CurlHelper::perform_http_request(
      "PUT",
      $base."/tipo_pago/update/".$_POST['id_edit'], 
      $data
    );
    header("Location: tipo_pago.php");
  }
  header("Location: tipo_pago.php");
  exit;
?>
