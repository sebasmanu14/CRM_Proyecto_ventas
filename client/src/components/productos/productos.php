<?php
session_start();
include '../../../environment/environment_api_connection.php';
include '../../../environment/environment_api.php';
$productos = CurlHelper::perform_http_request("GET", $base . "/productos");

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
  <link rel="stylesheet" href="productos.css" />
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
          <h1>PRODUCTOS</h1>
        </div>
        
        <table class="table_list_prod">
          <tr class="heder_table">
            <div class="container_create">
              <button id="opc_create" class="my_btn btn_crear">crear</button>
            </div>
            <tr>
              <td class="heder_iteam">número</td>
              <td class="heder_iteam">tipo de producto</td>
              <td class="heder_iteam">nombre</td>
              <td class="heder_iteam">precio</td>
              <td class="heder_iteam">cantidad</td>
              <td class="heder_iteam">descripción</td>
              <td class="heder_iteam">operaciones</td>
            </tr>
          </tr>
          <tr class="body_table">
            <?php
            if ($productos) {
              function see($id){
                include '../../../environment/environment_api.php';
                $action_see = "GET";
                $url_see = $base . "/roles" . "/show" . "/" . $id;
                return $result_see = CurlHelper::perform_http_request(
                  $action_see, $url_see, $parameters=''
                );
              }
            
              $productos = json_decode($productos, true);
              foreach($productos as $producto) {
              ?>
              <tr>
                <td class="body_iteam"><?php echo $producto['id'] ?></td>
                <td class="body_iteam"><?php echo $producto['tipo_producto_fk'] ?></td>
                <td class="body_iteam"><?php echo $producto['nombre'] ?></td>
                <td class="body_iteam"><?php echo $producto['precio'] ?></td>
                <td class="body_iteam"><?php echo $producto['cantidad'] ?></td>
                <td class="body_iteam"><?php echo $producto['descripcion'] ?></td>
                <td class="body_iteam">
                  <button onclick="see(<?php echo $producto['id'] ?>)" id="opc_see" class="my_btn btn_ver">ver</button>
                  <button onclick="edit(<?php echo $producto['id'] ?>)" id="opc_edit" class="my_btn btn_editar">editar</button>
                  <button onclick="cleanUp(<?php echo $producto['id'] ?>)" id="opc_delete" class="my_btn btn_eliminar">borrar</button>
                </td>
              </tr>
              <?php
              } }
            ?>
          </tr>
        </table>
      </div>

      <!-- start create -->
      <div id="view_create" class="overlay">
        <div class="popup">
          <div class="view_nav">
            <button id="close_create" class="my_btn"></button>
          </div>
          <div class="content_creat">
            <h3>Crear</h3>
            <form action="crear.php" method="post" class="form_create">
              <label for="name_creat">nombre</label>
              <input type="text" name="name_creat" id="name_creat">
              <label for="tipo_producto_creat">tipo de producto</label>
              <select 
              type="text"
              name="tipo_producto_creat" 
              class="opcines_tipo_producto"
              autocomplete="on"
              >
                <!--  -->
                <?php
                  include '../../../environment/environment_api.php';
                  $url = $base . "/tipos_productos";
                  $tipos_productos = CurlHelper::perform_http_request(
                    'GET', 
                    $url
                  );
                  $tipos_productos = json_decode($tipos_productos, true);
                  foreach ($tipos_productos as $tipo_producto) {
                ?>
                  <option class="opc_tipo_producto"><?php echo $tipo_producto['nombre'] ?></option>
                <?php 
                }
                ?>
                <!--  -->
              </select>
              <label for="fecha_fabricacion_creat">fecha fabricación</label>
              <input type="date" name="fecha_fabricacion_creat" id="fecha_fabricacion_creat">
              <label for="fecha_vencimiento_creat">fecha de vencimiento</label>
              <input type="date" name="fecha_vencimiento_creat" id="fecha_vencimiento_creat">
              <label for="precio_creat">precio</label>
              <input type="number" step="any" name="precio_creat" id="precio_creat">
              <label for="cantidad_creat">cantidad</label>
              <input type="number" name="cantidad_creat" id="cantidad_creat">
              <label for="descripcion_creat">descripción</label>
              <input type="text" name="descripcion_creat" id="descripcion_creat">
              <input type="submit" class="my_btn btn_crear" value="Crear">
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
            <input type="number" name="id_see" id="id_see" readonly>
            <label for="visible_see">visible</label>
            <input type="number" name="visible_see" id="visible_see" readonly>
            <label for="state_see">estado</label>
            <input type="number" name="state_see" id="state_see" readonly>
            <label for="tipo_producto_see">tipo de producto</label>
            <input type="text" name="tipo_producto_see" id="tipo_producto_see" placeholder="type product" readonly>
            <label for="name_see">nombre</label>
            <input type="text" name="name_see" id="name_see" placeholder="type product" readonly>
            <label for="fecha_fabricacion_see">fecha fabricación</label>
            <input type="datetime" name="fecha_fabricacion_see" id="fecha_fabricacion_see" placeholder="type product" readonly>
            <label for="fecha_vencimiento_see">fecha vencimiento</label>
            <input type="datetime" name="fecha_vencimiento_see" id="fecha_vencimiento_see" placeholder="type product" readonly>
            <label for="precio_see">precio</label>
            <input type="number" name="precio_see" id="precio_see" placeholder="type product" readonly>
            <label for="cantidad_see">cantidad</label>
            <input type="number" name="cantidad_see" id="cantidad_see" placeholder="type product" readonly>
            <label for="descripcion_see">descripción</label>
            <input type="text" name="descripcion_see" id="descripcion_see" placeholder="type product" readonly>
            <label for="created_at_see">fecha de creación</label>
            <input type="datetime" name="created_at_see" id="created_at_see" readonly>
            <label for="updated_at_see">fecha última actualización</label>
            <input type="datetime" name="updated_at_see" id="updated_at_see" readonly>
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
              <input type="number" style="display: none;" name="id_edit" id="id_edit">
              <label for="visible_edit">visible</label>
              <input type="number" name="visible_edit" id="visible_edit">
              <label for="state_edit">estado</label>
              <input type="number" name="state_edit" id="state_edit">
              <label for="tipo_producto_creat">tipo de producto</label>
              <select 
              type="text"
              name="tipo_producto_edit" 
              class="opcines_tipo_producto"
              autocomplete="on"
              >
                <option class="opc_tipo_producto"></option>
                <!--  -->
                <?php
                  include '../../../environment/environment_api.php';
                  $url = $base . "/tipos_productos";
                  $tipos_productos = CurlHelper::perform_http_request(
                    'GET', 
                    $url
                  );
                  $tipos_productos = json_decode($tipos_productos, true);
                  foreach ($tipos_productos as $tipo_producto) {
                ?>
                  <option class="opc_tipo_producto"><?php echo $tipo_producto['nombre'] ?></option>
                <?php 
                }
                ?>
                <!--  -->
              </select>
              <label for="name_edit">nombre</label>
              <input type="text" name="name_edit" id="name_edit" placeholder="type product">
              <label for="fecha_fabricacion_edit">fecha fabricación</label>
              <input type="datetime" name="fecha_fabricacion_edit" id="fecha_fabricacion_edit" placeholder="type product">
              <label for="fecha_vencimiento_edit">fecha vencimiento</label>
              <input type="datetime" name="fecha_vencimiento_edit" id="fecha_vencimiento_edit" placeholder="type product">
              <label for="precio_edit">precio</label>
              <input type="number" step="any" name="precio_edit" id="precio_edit" placeholder="type product">
              <label for="cantidad_edit">cantidad</label>
              <input type="number" name="cantidad_edit" id="cantidad_edit" placeholder="type product">
              <label for="descripcion_edit">descripción</label>
              <input type="text" name="descripcion_edit" id="descripcion_edit" placeholder="type product">
              <label for="created_at_edit" style="display: none;">fecha de creación</label>
              <input type="datetime" style="display: none;" name="created_at_edit" id="created_at_edit">
              <label for="updated_at_edit" style="display: none;">fecha última actualización</label>
              <input type="datetime" style="display: none;" name="updated_at_edit" id="updated_at_edit">
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
              <input class="name_delete" type="text" name="name_delete" id="name_delete" readonly>
              <input 
              id="id_delete" 
              name="id_delete" 
              type="number" 
              style="visibility: hidden; width: 100%;"
              >
              <input class="my_btn btn_eliminar" type="submit" value="Borrar">
            </form>
          </div>
        </div>
      </div>

      <!-- finish delete -->

      <!-- finish content -->
  
      <!-- footer -->
      <?php
      include '../footer/footer.php';
      ?>
      <!-- footer -->
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <script src="productos.js"></script>
  <script src="../../resource/js/main.js"></script>
</body>
</html>
