<?php
  session_start();
  include '../../../environment/environment_api_connection.php';
  include '../../../environment/environment_api.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../../resource/css/main.css" />
    <link rel="stylesheet" href="login.css" />
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
            <!------------------------------------------------------------------------>
            <div class="caja__trasera">
              <div class="caja__trasera-login">
                <h3>¿Aún no tienes cuenta?</h3>
                <p>Registrate para que puedas Iniciar Sesión</p>
                <button id="btn__registrarse">Registrarse</button>
              </div>
            </div>
            <!-------------------------------------------------------------------------->
            <div class="contenedor__login">
              <form
              action="verificar.php"
              method="POST"
              id="login_form"
              >
                <h3>Iniciar Sesión</h3>
                <div class="msm_llenar_campso" id="cont_msm_llenar_campso">
                  <p>Llena todos los campos...</p>
                </div>
                <div class="msm_no_usuario" id="cont_msm_no_usuario">
                  <p>Usuario no encontrado. Registrarse, por favor!</p>
                </div>
                <div class="msm_no_usuario" id="cont_msm_pass_incorrect">
                  <p>Credenciales incorrectas!</p>
                </div>
                  <input 
                  type="text"
                  placeholder="Correo Electronico" 
                  name="correo" 
                  id="correo" 
                  required
                  autocomplete="on"
                />
                  <input 
                  type="password" 
                  placeholder="Contraseña" 
                  name="pass"
                  id="pass"
                  required
                  autocomplete="on"
                />

                <button id="login">Entrar</button>
              <div class="iniciar_sesion">
                <p>Quiero <a href="../register/register.php">registrarme</a>.</p>
              </div>
              </form>
              <!------------------------------------------------------------------------>
            </div>
          </div>
          <!-- finish content -->
          <!------------------------------------------------------------------------>

          <!-- footer -->
          <?php
            include '../footer/footer.php';
          ?>
          <!-- footer -->
      </div>
    </div>
    <!-------------------------------------------------------------------------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="login.js"></script>
    <script src="../../resource/js/main.js"></script>
    <!-------------------------------------------------------------------------------->
  </body>
</html>
