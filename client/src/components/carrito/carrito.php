
<?php
  session_start();
  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';
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
    <link rel="stylesheet" href="carrito.css" />
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
            <h1>CARRITO</h1>
            <p>C O M P R A S</p>
          </div>

          <?php if ($_SESSION) { ?>

          <div class="container_comprar_mas" id="btn_comprar_mas">
            <button class="btn_anadir_mas">Añadir más</button>
          </div>
          <div class="container">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Tipo</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Operaciones</th>
                </tr>
              </thead>
              <tbody id="fila">
              </tbody>
            </table>
          </div>
        
          <div class="elegir_productos" id="elegir_productos">
            <button type="button" class="my_btn" id="btn_elegir_producto">Elegir producto</button>
          </div>

          <div class="container_mssg_cuenta_banco_campos" id="mssg_cuenta_banco_1">
            <p>Llene todos los campos para crear una cuenta bancaria.</p>
          </div>
          <div class="container_mssg_cuenta_banco_existe" id="mssg_cuenta_banco_2">
            <p>Cuenta bancaria existente.</p>
          </div>
          <div class="container_mssg_cuenta_banco_creada" id="mssg_cuenta_banco_3">
            <p>Cuenta bancaria agregada exitosamente.</p>
          </div>

          <section id="view_hacer_factura" class="overlay">
            <div class="popup">
                <div class="view_nav">
                  <button id="close_hacer_factura" class="my_btn"></button>
                </div>
                <div class="content_hacer_factura">

                <div class="container_datos_generales">
                  <div class="datos_generales">
                    <h5>Datos generales</h5>
                    <?php if (isset($usuario['cuenta_bancaria_fk'])) {  ?>
                      <p>Dirección: <?php echo $usuario['direccion'] ?></p>
                      <p>Teléfono: <?php echo $usuario['numero_telefono'] ?></p>
                      <h5>Cuenta bancaria</h5>
                      <?php $cuenta_banco = $usuario['cuenta_bancaria_fk'] ?>
                      <p>Num.cuenta bancaria: <?php echo $cuenta_banco['numero_cuenta'] ?></p>
                    <?php } ?>
                  </div>
                </div>

                <?php if (!isset($usuario['cuenta_bancaria_fk'])) { ?>
                <div class="container">
                  <div class="pedir_cuenta_bancaria">
                    <p>! Registra una cuenta bancaria para poder comprar.</p>
                    <h3>Registrar cuenta bancaria</h3>
                  </div>
                  <form action="agregar_cuenta_bancaria.php" method="post" class="form_pedir_cuenta_bancaria">
                    <label for="tipo_cuenta_bancaria_fk">Tipo cuenta bancaria</label>
                    <select 
                    type="number" 
                    placeholder="tipo cuenta bancaria" 
                    name="tipo_cuenta_bancaria_fk" 
                    class="opcines_tipo_cuenta"
                    autocomplete="on"
                    >
                      <!--  -->
                      <?php
                        include '../../../environment/environment_api.php';
                        $tipos_cuentas = CurlHelper::perform_http_request(
                          'GET', 
                          $base . "/tipos_cuentas_bancarias"
                        );
                        $tipos_cuentas = json_decode($tipos_cuentas, true);
                        foreach ($tipos_cuentas as $tipo_cuenta) {
                      ?>
                          <option class="opc_tipo_cuenta"><?php echo $tipo_cuenta['nombre'] ?></option>
                      <?php } ?>
                      <!--  -->
                    </select>

                    <label for="nombre_banco">Banco</label>
                    <select 
                    type="number" 
                    placeholder="tipo cuenta bancaria" 
                    name="nombre_banco" 
                    class="opcines_tipo_cuenta"
                    autocomplete="on"
                    >
                        <option class="opc_tipo_cuenta">Pichincha</option>
                        <option class="opc_tipo_cuenta">Produbanco</option>
                        <option class="opc_tipo_cuenta">Banco de Guayaquil</option>
                        <option class="opc_tipo_cuenta">Banco del Pacífico</option>
                        
                    </select>
                    <label for="numero_cuenta">Número de cuenta</label>
                    <input type="number" name="numero_cuenta" id="numero_cuenta">
                    <input type="submit" value="Crear" class="my_btn btn_crear">
                  </form>
                </div>
                <?php } else {  ?>
                  <div class="container_ver_factura">
                  </div>
                  <button id="finalizar_comprar" class="my_btn_action compra">Finalzar compra</button>
                  <?php }  ?>
              </div>
            </div>
          </section>

          <section id="view_factura_realizada" class="overlay">
            <div class="popup">
              <div class="content_factura_realizada">
                <h3>Compra realizada con exito!</h3>
                <p>Ver mi <a href="../factura/factura.php" class="my_a">factura</a></p>
                <button id="listo_factura" class="my_btn btn_ver">Listo</button>
              </div>
            </div>
          </section>

          <div class="container_compra">
            <button class="my_btn_action compra" id="comprar">Comprar</button>
          </div>

          <?php } else {?>
            <div class="sms_debes_iniciar_session">
              <p>Primero debes <a href="../login/login.php">iniciar sesión</a>.</p>
            </div>
          <?php } ?>
        <div>
        <!-- finish content -->
        
        <!-- footer -->
        <?php
        include '../../components/footer/footer.php';
        ?>
        <!-- footer -->
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="carrito.js"></script>
    <script src="../../resource/js/main.js"></script>
  </body>
</html>
<!-- boton de ir haci arriva-->
