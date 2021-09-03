<?php
  include '../../../environment/environment_api.php';
  $productos = CurlHelper::perform_http_request(
    'GET',
    $base . "/productos"
  );
  $usuario = null;
  if (isset($_SESSION['id_user'])) {
    $usuario = CurlHelper::perform_http_request(
      'GET',
      $base . "/clientes/show/". $_SESSION['id_user'],
    );
    $usuario = json_decode($usuario, true);
  }
?>

<!-- navegation -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <nav class="nav">
    <a href="../dashboard/dashboard.php">
      <img
      class="logo_nav"
      src="../../resource/img/logo.png"
      alt="logo de la empresa"
      />
    </a>
    <ul class="nav justify-content-end">
      <li class="nav-item"><a href="../dashboard/dashboard.php" class="my_a">Dashboard</a></li>
      <li class="nav-item"><a href="../compra/compra.php" class="my_a">Compra</a></li>
      <li class="nav-item"><a href="../carrito/carrito.php" class="my_a">Carrito</a></li>
      <?php if (isset($usuario) && !empty($_SESSION) && isset($_SESSION['id_user']) && $usuario['rol_fk'] == '1') { ?>
      <li class="nav-item"><a href="../frecuencia_compra/frecuencia_compra.php" class="my_a">frecuencia compra</a></li>
      <?php } ?>
      <?php if (isset($usuario) && !empty($_SESSION) && isset($_SESSION['id_user']) && $usuario['rol_fk'] == '1') { ?>
      <li class="nav-item dropdown">
        <a class="dropdown-toggle my_a" data-bs-toggle="dropdown" >Crear datos</a>
        <ul class="dropdown-menu">
          <li><a class="my_a_dropdown" href="../roles/roles.php">Roles</a></li>
          <li><a class="my_a_dropdown" href="../tipo_pago/tipo_pago.php">Tipo de pago</a></li>
          <li><a class="my_a_dropdown" href="../tipo_cuenta_bancaria/tipo_cuenta_bancaria.php">Tipo cuenta bancaria</a></li>
          <li><a class="my_a_dropdown" href="../tipo_producto/tipo_producto.php">Tipo produto</a></li>
          <li><a class="my_a_dropdown" href="../productos/productos.php">Productos</a></li>
        </ul>
      </li>
      <?php } ?>

      <li class=" dropdown">
        <a class="dropdown-toggle my_a" data-bs-toggle="dropdown" >
          <?php 
            if (isset($usuario) && !empty($_SESSION) && isset($_SESSION['id_user'])) {echo $usuario['nombres'];}else {echo 'Usuario';}
          ?>
        </a>
        <ul class="dropdown-menu">
        <?php if (!isset($_SESSION['id_user'])) { ?>
          <li><a class="my_a_dropdown" href="../register/register.php">Register</a></li>
          <li><a class="my_a_dropdown" href="../login/login.php">Login</a></li>
        <?php } else { ?>
          <li><a  class="my_a_dropdown" href="../navegation/logout.php" id="btn_logout">Logout</a></li>
        <?php } ?>
        </ul>
      </li>
    </ul>
  </nav>
  <?php if($productos == null) { ?>
    <div class="container_error_server">
      <h6>! Error</h6>
      <p>No hay conexión con el servidor.</p>
    </div>
  <?php } ?>

<script src="../navegation/navegation.js"></script>
<!-- navegation -->
