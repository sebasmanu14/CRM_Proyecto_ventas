<?php

  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';

  if ($_POST['id_edit'] != null &&
  $_POST['visible_edit'] != null &&
  $_POST['state_edit'] != null &&
  $_POST['name_edit'] != null
  ) {
    $data = [
      "id" => $_POST["id_edit"],
      "visible" => $_POST['visible_edit'],
      "estado" => $_POST['state_edit'],
      "nombre" => $_POST['name_edit']
    ];

    $result = CurlHelper::perform_http_request(
        'PUT',
        $base."/tipos_productos/update/".$_POST['id_edit'], 
        $data
      );
      header("Location: tipo_producto.php");
    }
    header("Location: tipo_producto.php");
    exit;
  ?>
  