<?php

  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';

  if ($_POST['id_delete'] != null) {
    $result = CurlHelper::perform_http_request(
      "DELETE",
      $base."/tipo_pago/destroy/".$_POST['id_delete'], 
    );
    header("Location: tipo_pago.php");
  }
  header("Location: tipo_pago.php");
  exit;
?>
