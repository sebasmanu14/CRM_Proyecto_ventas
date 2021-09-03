<?php
  // see all roles
  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';
  $tipos_cuentas_bancarias = CurlHelper::perform_http_request("GET", $base . "/tipos_cuentas_bancarias");

  session_start();
  if (isset($_SESSION['id_user'])) {
    $result = CurlHelper::perform_http_request(
      'GET',
      $base . "/clientes/show/". $_SESSION['id_user'],
    );
    $result = json_decode($result, true);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="../../resource/css/main.css" />
  <link rel="stylesheet" href="tipo_cuenta_bancaria.css" />
  <link rel="icon" href="../../resource/img/logo.png" type="image/x-icon">
  <title><?php echo basename(__FILE__); ?></title>
</head>
<body>
  <div class="loader-page"></div>
  <div class="container_page">
    <div class="content_page">
      <!-- navegation -->
      <?php
        include '../navegation/navegation.php';
        ?>
      <!-- navegation -->
      
      <!-- start content -->
      <div class="content_general">
        <div class="container_titulo">
          <h1>TIPO CUENTAS BANCARIAS</h1>
        </div>
        <table class="table_list_prod">
          <tr class="heder_table">
            <div class="container_create">
              <button id="opc_create" class="my_btn btn_crear">crear</button>
            </div>
            <tr>
              <td class="heder_iteam">número</td>
              <td class="heder_iteam">nombre</td>
              <td class="heder_iteam">operaciones</td>
            </tr>
          </tr>
          <tr class="body_table">
          <?php
          if ($tipos_cuentas_bancarias) {
            function see($id){
              include '../../../environment/environment_api.php';
              return $result_see = CurlHelper::perform_http_request(
                'GET',
                $base."/roles"."/show"."/".$id
              );
            }
          
            $tipos_cuentas_bancarias = json_decode($tipos_cuentas_bancarias, true);
            foreach($tipos_cuentas_bancarias as $tipos_cuenta_bancaria) {
            ?>
            <tr>
              <td class="body_iteam"><?php echo $tipos_cuenta_bancaria['id'] ?></td>
              <td class="body_iteam"><?php echo $tipos_cuenta_bancaria['nombre'] ?></td>
              <td class="body_iteam">
                <button onclick="see(<?php echo $tipos_cuenta_bancaria['id'] ?>)" id="opc_see" class="my_btn btn_ver">ver</button>
                <button onclick="edit(<?php echo $tipos_cuenta_bancaria['id'] ?>)" id="opc_edit" class="my_btn btn_editar">editar</button>
                <button onclick="cleanUp(<?php echo $tipos_cuenta_bancaria['id'] ?>)" id="opc_delete" class="my_btn btn_eliminar">borrar</button>
              </td>
            </tr>
            <?php
            } }
            ?>
          </tr>
        </table>
  
        <div>
          <div id="valores" style="visibility: hidden;" readonly></div>
          <!-- start create -->
          <div id="view_create" class="overlay">
            <div class="popup">
              <div class="view_nav">
                <button id="close_create" class="my_btn"></button>
              </div>
              <div class="content_creat">
                <h3>Crear</h3>
                <form action="crear.php" method="post" class="form_create">
                  <label for="name">nombre</label>
                  <input type="text" name="name" id="name">
                  <input type="submit" class="my_btn btn_crear" value="send">
                </form>
              </div>
            </div>
          </div>
          <!-- finish create -->
    
          <!-- start see -->
          <div id="view_see" class="overlay">
            <div class="popup">
              <div class="view_nav">
                <button id="close_see" class="my_btn"></button>
              </div>
              <div class="content_see">
                <h3>Detalles</h3>
                <label for="id_see">id</label>
                <input type="number" name="data_see" id="id_see" readonly>
                <label for="visible_see">visible</label>
                <input type="number" name="data_see" id="visible_see" readonly>
                <label for="state_see">state</label>
                <input type="number" name="data_see" id="state_see" readonly>
                <label for="name_see">name</label>
                <input type="text" name="data_see" id="name_see" readonly>
                <label for="created_at_see">created at</label>
                <input type="datetime" name="data_see" id="created_at_see" readonly>
                <label for="updated_at_see">updated at</label>
                <input type="datetime" name="data_see" id="updated_at_see" readonly>
                <button id="listo_see" class="my_btn btn_ver">Listo</button>
              </div>
            </div>
          </div>
          <!-- finish see -->
          
          <!-- start edit -->
          <div id="view_edit" class="overlay">
            <div class="popup">
              <div class="view_nav">
                <button id="close_edit" class="my_btn"></button>
              </div>
              <div class="content_edit">
                <h3>Editar</h3>
                <form action="actualizar.php" method="post" class="form_create">
                  <label for="id_edit" style="display: none;">id</label>
                  <input class="input_edit" type="number" style="display: none;" name="id_edit" id="id_edit">
                  <label for="visible_edit">visible</label>
                  <input class="input_edit" type="number" name="visible_edit" id="visible_edit">
                  <label for="state_edit">state</label>
                  <input class="input_edit" type="number" name="state_edit" id="state_edit">
                  <label for="name_edit">name</label>
                  <input class="input_edit" type="text" name="name_edit" id="name_edit">
                  <input type="submit" class="my_btn btn_editar" value="send">
                </form>
              </div>
            </div>
          </div>
          <!-- finish edit -->
          
          <!-- start delete -->
          <div id="view_delete" class="overlay">
            <div class="popup">
              <div class="view_nav">
                <button id="close_delete" class="my_btn"></button>
              </div>
              <div class="content_delete">
                <h3>¿Seguro quieres eliminar?</h3>
                <form action="eliminar.php" method="post">
                  <input 
                  class="name_delete" 
                  type="text" 
                  name="name_delete" 
                  id="name_delete"
                  readonly
                  >
                  <input 
                  id="id_delete" 
                  name="id_delete" 
                  type="number" 
                  style="visibility: hidden; width: 100%;"
                  >
                  <input type="submit" class="my_btn btn_eliminar" value="Borrar">
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- finish delete -->
      </div>
      <!-- finish content -->
      <!-- footer -->
      <?php
      include '../footer/footer.php';
      ?>
    <!-- footer -->
  </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <script src="tipo_cuenta_bancaria.js"></script>
  <script src="../../resource/js/main.js"></script>
</body>
</html>
<!--

http://localhost/proyect/client/src/components/rol/index.php

-->
