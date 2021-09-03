<?php

  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';

  if ($_POST['id_delete'] != null) {
    $result = CurlHelper::perform_http_request(
      "DELETE",
      $base."/tipos_cuentas_bancarias/destroy/".$_POST['id_delete'], 
    );
    header("Location: tipo_cuenta_bancaria.php");
  }
  header("Location: tipo_cuenta_bancaria.php");
  exit;
?>
