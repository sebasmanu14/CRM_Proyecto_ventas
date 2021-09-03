<?php
session_start();
include '../../../environment/environment_api_connection.php';
include '../../../environment/environment_api.php';
$usuario = null;
if (isset($_SESSION['id_user'])) {
  $usuario = CurlHelper::perform_http_request(
    'GET',
    $base . "/clientes/show/". $_SESSION['id_user'],
  );
  $usuario = json_decode($usuario, true);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../../resource/css/main.css" />
    <link rel="stylesheet" href="dashboard.css" />
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

          <?php if ($usuario && !empty($_SESSION) && isset($_SESSION['id_user'])) { ?>
          <div class="container_welcome">
            <h3>START PLATINUM</h3>
            <h4>Bienvenido</h4>
            <p><?php echo $usuario['nombres'].' '.$usuario['apellidos'] ?></p>
          </div>
          <?php } ?>


          <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="1300">
                <img src="../../resource/img/carrucel/carrucel_8.png" class="d-block w-100" alt="imagen de nuestros servicios">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Servicios</h5>
                  <p>Ofrecemos los mejores planes</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1300">
                <img src="../../resource/img/carrucel/carrucel_2.jpg" class="d-block w-100" alt="imagen de nuestros servicios">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Planes</h5>
                  <p>Los mejores precio</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1300">
                <img src="../../resource/img/carrucel/carrucel_3.jpg" class="d-block w-100" alt="imagen de nuestros servicios">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Servico</h5>
                  <p>El mejor servicio</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1300">
                <img src="../../resource/img/carrucel/carrucel_4.jpg" class="d-block w-100" alt="imagen de nuestros servicios">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Servico</h5>
                  <p>Ofrecemos un servicio personalizado</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1300">
                <img src="../../resource/img/carrucel/carrucel_5.jpg" class="d-block w-100" alt="imagen de nuestros servicios">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Servico</h5>
                  <p>Ofrecemos un servicio personalizado</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1300">
                <img src="../../resource/img/carrucel/carrucel_6.jpg" class="d-block w-100" alt="imagen de nuestros servicios">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Servico</h5>
                  <p>Ofrecemos un servicio personalizado</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1300">
                <img src="../../resource/img/carrucel/carrucel_7.jpg" class="d-block w-100" alt="imagen de nuestros servicios">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Servico</h5>
                  <p>Ofrecemos un servicio personalizado</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1300">
                <img src="../../resource/img/carrucel/carrucel_1.jpg" class="d-block w-100" alt="imagen de nuestros servicios">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Servico</h5>
                  <p>Ofrecemos un servicio personalizado</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1300">
                <img src="../../resource/img/carrucel/carrucel_9.jpg" class="d-block w-100" alt="imagen de nuestros servicios">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Servico</h5>
                  <p>Ofrecemos un servicio personalizado</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1300">
                <img src="../../resource/img/carrucel/carrucel_10.jpg" class="d-block w-100" alt="imagen de nuestros servicios">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Servico</h5>
                  <p>Ofrecemos un servicio personalizado</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

          <div class="container_informacion">
            <h4>INFORMACIÓN</h4>
            <div class="container_mision_vision">
              <div class="mision">
                <h5>MISIÓN</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis dicta aperiam mollitia vitae, consequuntur error modi et, delectus velit aut est nisi eaque libero incidunt ad qui molestias consectetur veritatis.</p>
              </div>
            </div>
            <div class="container_mision_vision">
              <div class="vision">
                <h5>VISIÓN</h5>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque distinctio illo explicabo autem itaque. Facilis doloremque tempore ratione quis, praesentium repellendus. Odit iure earum tempore voluptas nobis dolor aut reiciendis?
              </div>
            </div>
          </div>
          <!-- finish content -->

        </div>
        <!-- footer -->
        <?php
          include '../../components/footer/footer.php';
        ?>
        <!-- footer -->
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
    <script src="../../resource/js/main.js"></script>
  </body>
</html>
