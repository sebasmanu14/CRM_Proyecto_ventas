<?php
  session_start();
  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <script src="https://kit.fontawesome.com/e2f5225a3c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../resource/css/main.css" />
    <link rel="stylesheet" href="compra.css" />
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
          <div class="container_logo">
            <div class="logo">
              <h1>PRODUCTOS EN VENTA</h1>
              <p>S T A R S - P R O D U C T</p>
            </div>
          </div>
            <div class="contenedor">
              <header>
                <form action="">
                  <input
                    type="text"
                    class="barra-busqueda"
                    id="barra-busqueda"
                    placeholder="Buscar por precio"
                  />
                </form>
                <div class="categorias" id="categorias">
                  <a href="#" class="activo">Todos</a>
                  <a href="#">Combo_$25.00</a>
                  <a href="#">Combo_$20.00</a>
                  <a href="#">Combo_$10.00</a>
                  <a href="#">Combo_$5.00</a>
                </div>
              </header>

              <section class="grid" id="grid">
                <?php
                  include '../../../environment/environment_api.php';
                  $productos = CurlHelper::perform_http_request(
                    'GET',
                    $base . "/productos"
                  );
                  if ($productos) {
                    $productos = json_decode($productos, true);
                    foreach ($productos as $producto) {
                ?>
                  <div
                    class="item"
                    data-categoria="<?php echo 'combo_$'.$producto['precio']?>"
                    data-etiquetas="<?php echo $producto['precio']?>"
                    data-descripcion="
                    <?php echo 'Nombre: '.$producto['nombre'] ?> <br>
                    <?php echo'Precio: '.$producto['precio']?> <br>
                    <?php echo'Disponible: '.$producto['cantidad']?> <br>
                    <?php echo'Fecha_fabricacion: '.$producto['fecha_fabricacion']?> <br>
                    <?php echo'Fecha_vencimiento: '.$producto['fecha_vencimiento']?> <br>
                    <?php echo'Descripcion: '.$producto['descripcion']?> <br>
                    "
                    data-idproducto="<?php echo $producto['id'] ?>"
                    data-iduser="<?php echo $_SESSION['id_user'] ?>"
                  >
                  <div class="item-contenido">
                        <img class="imagen_prod" src="../../resource/img/fondo_planes.jpg" alt="" />
                        <div class="detalle_producto">
                          <p>Disponible: <?php echo $producto['cantidad']?></p>
                          <p>Nombre: <?php echo $producto['nombre']?></p>
                          <p>Precio: <?php echo $producto['precio']?></p>
                        </div>
                    </div>
                  </div>
                  <?php
                      }
                    }
                  ?>
                </section>
                <section class="overlay" id="overlay">
                  <div class="contenedor-img">
                    <button id="btn-cerrar-popup"><i class="fas fa-times"></i></button>
                    <img src="" alt="" />
                  </div>
                  <p class="descripcion" style="text-align: justify"></p>
                  <?php if (!empty($_SESSION['id_user'])) { ?>
                  <button onclick="comprar()" class="my_btn btn_editar">Añadir al carrito</button>
                  <?php } else {?>
                    <div class="sms_debes_iniciar_session">
                      <p>Primero debes <a href="../login/login.php">iniciar sesión</a>.</p>
                    </div>
                  <?php }?>
                </section>
            </div>
        </div>
        <!-- finish content -->
        <!-- footer -->
        <?php
          include '../footer/footer.php';
        ?>
        <!-- footer -->

        <!-- burbuja carrito-->
        <div id="button-up">
          <input 
          class="cantidad_prod_carrito" 
          type="text"
          name="cantidad_prod_carrito" 
          id="cantidad_prod_carrito"
          value=""
          readonly
          >
          <i class="fas fa-cart-arrow-down"></i>
        </div>
        <div class="onda">
        </div>
        <!-- burbuja carrito-->

      </div>
    </div>
    <script src="https://unpkg.com/web-animations-js@2.3.2/web-animations.min.js"></script>
    <script src="https://unpkg.com/muuri@0.8.0/dist/muuri.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="compra.js"></script>
    <script src="../../resource/js/main.js"></script>
  </body>
</html>
