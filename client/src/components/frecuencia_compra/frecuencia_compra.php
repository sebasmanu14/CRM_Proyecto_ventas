<?php
  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';
  $ventas = CurlHelper::perform_http_request("GET", $base . "/ventas");
  
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="../../resource/css/main.css" />
  <link rel="stylesheet" href="frecuencia_compra.css" />
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
          <h1>FRECUENCIA DE COMPRA</h1>
        </div>

        <?php
            if ($ventas) {
              $ventas = json_decode($ventas, true);
              foreach($ventas as $venta) {
                ?>
        <div class="container_factura">
          <h3 class="titulo_tabla">Venta <?php echo $venta['id'] ?></h3>
          <table class="table_list_prod">
            <tr class="heder_table">
              <tr>
                <td class="heder_iteam">Nombre del cliente</td>
                <td class="heder_iteam">Tipo de pago</td>
                <td class="heder_iteam">Fecha</td>
                <td class="heder_iteam">Total</td>
                <td class="heder_iteam">Iva</td>
                <td class="heder_iteam">Descuento</td>
              </tr>
            </tr>
            <tr class="body_table">
              <tr>
                <td class="body_iteam"><?php echo $venta['cliente_fk']['nombres'] ?></td>
                <td class="body_iteam"><?php echo $venta['tipo_pago_fk']['nombre'] ?></td>
                <td class="body_iteam"><?php echo $venta['updated_at'] ?></td>
                <td class="body_iteam"><?php echo $venta['total'] ?></td>
                <td class="body_iteam"><?php echo $venta['iva'] ?></td>
                <td class="body_iteam"><?php echo $venta['descuento'] ?></td>
              </tr>
              <tr>
              <tr class="body_table">
                <tr>
                  <table class="table_list_prod">
                    <tr class="heder_table">
                      <h4 class="titulo_tabla">Detalle de la factura</h4>
                      <tr>
                    <?php   
                      $detalles_ventas = CurlHelper::perform_http_request("GET", $base . "/detalles_venta/verDetalleVentaCliente/".$venta['id']);
                      $detalles_ventas = json_decode($detalles_ventas, true);
                      foreach ($detalles_ventas as $detalle_venta) {
                    ?>
                        <td class="heder_iteam_detalle">Precio</td>
                        <td class="heder_iteam_detalle">Producto</td>
                        <td class="heder_iteam_detalle">Cantidad</td>
                        <td class="heder_iteam_detalle">Descripcion</td>
                      </tr>
                    </tr>
                    <tr class="body_table">
                      <tr>
                        <td class="body_iteam_detalle"><?php echo $detalle_venta['producto_fk']['precio'] ?></td>
                        <td class="body_iteam_detalle"><?php echo $detalle_venta['producto_fk']['nombre'] ?></td>
                        <td class="body_iteam_detalle"><?php echo $detalle_venta['cantidad'] ?></td>
                        <td class="body_iteam_detalle"><?php echo $detalle_venta['producto_fk']['descripcion'] ?></td>
                      </tr>
                      <?php
                      }
                      ?>
                    </tr>
                  </table>
                </tr>
              </tr>
            </tr>
          </table>
        </div>
              <?php
              } }
              ?>

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
  <script src="frecuencia_compra.js"></script>
  <script src="../../resource/js/main.js"></script>
</body>
</html>
