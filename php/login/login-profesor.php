<?php


include '../../config/global.php';
include '../conexion.php';
include '../validaciones.php';

if (isset($_POST)) {
    if (!empty($_POST["correoProfesor"]) AND !empty($_POST["claveProfesor"])) {
        
        if (validarCorreo($_POST["correoProfesor"]) AND validarPassword($_POST["claveProfesor"])) {
            
            $correo = $_POST["correoProfesor"];

            $stmt = $conexion -> prepare("SELECT COUNT(*) FROM personal_escolar WHERE correo = ?");
            $stmt -> bind_param("s", $correo);
            $stmt -> execute();
            $stmt -> store_result();

            if ($stmt -> num_rows() > 0) {

                $clave = $_POST["claveProfesor"];
                
                $login = $conexion -> prepare("SELECT cvePersona, contra FROM profesor NATURAL JOIN personal_escolar NATURAL JOIN usuario WHERE correo = ?");
                $login -> bind_param("s", $correo);
                $login -> execute();
                $resultados = $login -> get_result();

                if ($dato = $resultados -> fetch_object()) {
                    
                    if (password_verify($clave, $dato->contra)) {
                        
                        $_SESSION["cvePersona"] = $dato -> cvePersona;
                        $_SESSION["user_profesor"] = true;

                        $respuesta = array(
                            "status" => true,
                            "acceso" => '<div class="alert alert-info text-center">
                                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                            <span class="fw-bold" role="status">Accediendo...</span>
                                        </div>'
                        );

                    } else {
                        $respuesta = array(
                            "status" => false,
                            "titulo" => "CREDENCIALES INCORRECTAS",
                            "texto"  => "Correo/Contraseña incorrecta",
                            "tipo"   => "warning",
                            "icon"   => $ruta_raiz."/plugins/toasts/icons/icon_warning.png",
                        );
                    }
                    
                }

            } else {
                $respuesta = array(
                    "status" => false,
                    "titulo" => "CREDENCIALES INCORRECTAS",
                    "texto"  => "Correo/Contraseña incorrecta",
                    "tipo"   => "warning",
                    "icon"   => $ruta_raiz."/plugins/toasts/icons/icon_warning.png",
                );
            }
            
        } else {
            $respuesta = array(
                "status" => false,
                "titulo" => "ADVERTENCIA",
                "texto"  => "Datos no validos",
                "tipo"   => "error",
                "icon"   => $ruta_raiz."/plugins/toasts/icons/icon_error.png",
            );
        }
        
    } else {
        $respuesta = array(
            "status" => false,
            "titulo" => "ADVERTENCIA",
            "texto"  => "Debes completar todo el formulario",
            "tipo"   => "warning",
            "icon"   => $ruta_raiz."/plugins/toasts/icons/icon_warning.png",
        );
    }

    $json = json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    print_r($json);

}