<?php

  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';

  if ($_POST['id_delete'] != null) {
    $result = CurlHelper::perform_http_request(
      "DELETE",
      $base."/roles/destroy/".$_POST['id_delete'], 
    );
    header("Location: roles.php");
  }
  header("Location: roles.php");
  exit;
?>
