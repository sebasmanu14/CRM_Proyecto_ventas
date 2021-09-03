<?php 
    // GUARDAMOS SU CUENTA BANCARIA //
    session_start();
    include '../../../environment/environment_api_connection.php';
    include '../../../environment/environment_api.php';
    if (
        $_POST["tipo_cuenta_bancaria_fk"] != null && 
        $_POST["numero_cuenta"] != null && 
        $_POST["nombre_banco"] != null 
    ) {
        $data = [
            "visible" => true,
            "estado" => true,
            "tipo_cuenta_bancaria_fk" => $_POST["tipo_cuenta_bancaria_fk"],
            "numero_cuenta" => $_POST["numero_cuenta"],
            "nombre_banco" => $_POST["nombre_banco"]
        ];
        $res_cuenta_bancaria = CurlHelper::perform_http_request(
            'POST',
            $base . "/cuenta_bancaria/store",
            $data
        );
        $res_cuenta_bancaria = json_decode($res_cuenta_bancaria, true);
        if (!empty($res_cuenta_bancaria['message'])) {
            echo "<script>localStorage.setItem('cuenta_banco','2');
            </script>";
        }
        if (!empty($res_cuenta_bancaria)) {
            echo "<script>localStorage.setItem('cuenta_banco','3');
            </script>";
        }
        $res_cuenta_bancaria = json_encode($res_cuenta_bancaria, true);
        $data = [
            "id"=>$_SESSION['id_user'],
            "cuenta_bancaria_fk" => $res_cuenta_bancaria
        ];
        $res_cliente = CurlHelper::perform_http_request(
            'PUT', 
            $base . "/clientes/update/".$_SESSION['id_user'], 
            $data
        );
        echo "<script>
        window.location.replace('carrito.php');
        </script>";
    } else {
        echo "<script>localStorage.setItem('cuenta_banco','1');
        window.location.replace('carrito.php');
        </script>"; 
    }
?>
