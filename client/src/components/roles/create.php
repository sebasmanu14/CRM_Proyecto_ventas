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
      $base . "/roles/store", 
      $data
    );
    header("Location: roles.php");
  }
  header("Location: roles.php");
  exit;
?>
