<?php
    session_start();
    // ==================================================================== //
    // VERIFICAMOS DATOS DEL USUARIO PARA REGISTRARLO O RECORDALE SU CUENTA //
    // ==================================================================== //
    if (
        $_POST["rol_fk"] && 
        $_POST["nombres"] && 
        $_POST["apellidos"] && 
        $_POST["email"] && 
        $_POST["clave"] && 
        $_POST["direccion"] && 
        $_POST["numero_telefono"] && 
        $_POST["numero_identificacion"] 
    ) {
        include '../../../environment/environment_api_connection.php';
        include '../../../environment/environment_api.php';
        // ================================================================= //
        // GUARDAMOS SU CUENTA BANCARIA, SI ES QUE HAY DATOS EN ESOS CAMPOS //
        // ================================================================ //
        if (
            !empty($_POST["tipo_cuenta_bancaria_fk"]) && 
            !empty($_POST["numero_cuenta"]) && 
            !empty($_POST["nombre_banco"])
        ) {
            // datos de la cuenta bancaria del usuario
            $data = [
                "visible" => true,
                "estado" => true,
                "tipo_cuenta_bancaria_fk" => $_POST["tipo_cuenta_bancaria_fk"],
                "numero_cuenta" => $_POST["numero_cuenta"],
                "nombre_banco" => $_POST["nombre_banco"]
            ];
            $result = CurlHelper::perform_http_request(
                'POST',
                $base . "/cuenta_bancaria/store",
                $data
            );
            //===============================//
            // SI EXISTE ESA CUENTA BANCARIA //
            //===============================//
            if (isset($result['id'])) {
                echo "<script>
                localStorage.setItem('register', '5');
                window.location.replace('../compra/compra.php');
                </script>";
            }
            if (isset($result['message'])) {
                echo "<script>
                    localStorage.setItem('register', '4');
                    
                    </script>";
            }
            // datos del usuario
            $data = [
                "visible" => true,
                "estado" => true,
                "rol_fk" => $_POST["rol_fk"],
                "nombres" => $_POST["nombres"],
                "apellidos" => $_POST["apellidos"],
                "correo" => $_POST["email"],
                "clave" => $_POST["clave"],
                "direccion" => $_POST["direccion"],
                "numero_telefono" => $_POST["numero_telefono"],
                "numero_identificacion" => $_POST["numero_identificacion"],
                "cuenta_bancaria_fk" => $result
            ];
            $result = CurlHelper::perform_http_request(
                'POST', 
                $base . "/clientes/store", 
                $data
            );
            $result = json_decode($result, true);
            //==================================================//
            // CUANDO EL USUARIO NO EXISTE, SE CREARÁ EL USUARIO //
            //==================================================//
            if (isset($result['id'])) {
                $_SESSION['id_user'] = $result['id'];
                echo "<script>
                localStorage.setItem('register', '3');
                window.location.replace('../compra/compra.php');
                </script>";
            }
            //============================//
            // CUAND EL USUARIO YA EXISTE //
            //============================//
            if (isset($result['nombres'])) {
                echo "<script>
                    localStorage.setItem('register', '2');
                    window.location.replace('register.php');
                    </script>";
            }
        }
        $data = [
            "visible" => true,
            "estado" => true,
            "rol_fk" => $_POST["rol_fk"],
            "nombres" => $_POST["nombres"],
            "apellidos" => $_POST["apellidos"],
            "correo" => $_POST["email"],
            "clave" => $_POST["clave"],
            "direccion" => $_POST["direccion"],
            "numero_telefono" => $_POST["numero_telefono"],
            "numero_identificacion" => $_POST["numero_identificacion"]
        ];
        
        $result = CurlHelper::perform_http_request(
            'POST', 
            $base . "/clientes/store", 
            $data
        );
        $result = json_decode($result, true);
        //===================================================//
        // CUANDO EL USUARIO NO EXISTE, SE CREARÁ EL USUARIO //
        //===================================================//
        if (isset($result['id'])) {
            $_SESSION['id_user'] = $result['id'];
            echo "<script>
            window.location.replace('../compra/compra.php');
            </script>";
        }
        //=============================//
        // CUANDO EL USUARIO YA EXISTE //
        //=============================//
        if (isset($result['nombres'])) {
            echo "<script>
            localStorage.setItem('register', '2');
            window.location.replace('register.php');
            </script>";
        }
    } else {
        //=============================================//
        // CUANDO EL USUARIO NO LLENE TODOS LOS CAMPOS //
        //=============================================//
        echo "<script>
        localStorage.setItem('register', '1');
        window.location.replace('register.php');
        </script>";
    }
    ?>
