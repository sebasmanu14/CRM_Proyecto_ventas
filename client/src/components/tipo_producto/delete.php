<?php

  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';

  if ($_POST['id_delete'] != null) {
    $result = CurlHelper::perform_http_request(
      "DELETE",
      $base."/tipos_productos/destroy/".$_POST['id_delete'], 
    );
      header("Location: tipo_producto.php");
    }
    header("Location: tipo_producto.php");
    exit;
  ?>
  