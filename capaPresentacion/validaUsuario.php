<?php
/** Incluye la clase. */
include '../capaNegocio/usuario.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();

/** Si hemos marcado la casilla de verificación... */
if (isset($_POST['recordar'])) {
    /** Crea las cookies. */
    setcookie('email', $_POST['email'], time() + (60 * 60 * 24 * 90));
    setcookie('contraseña', $_POST['contraseña'], time() + (60 * 60 * 24 * 90));
    setcookie('recordar', 'on', time() + (60 * 60 * 24 * 90));
} else {
    /** En caso contrario, borra las cookies. */
    setcookie('email', '', time() - 3600);
    setcookie('contraseña', '', time() - 3600);
    setcookie('recordar', '', time() - 3600);
}
?>

<!--
        * validaUsuario.php
        * Módulo secundario que valida o autentifica un usuario.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestión de usuarios</title>
        <link rel="stylesheet" type="text/css" href="css/banner-styles.css">
        <link rel="stylesheet" type="text/css" href="css/iconochive.css">
        <link rel="stylesheet" type="text/css" href="css/login.15285.15366.css">
        <link rel="stylesheet" type="text/css" href="css/banner.css">
        <style>
            .hide {
                display: none !important;
            }

            .loadingPage .canvas,
            .loadingPage .footer {
                position: absolute;
                top: -100000px;
                left: -100000px;
                display: none;
                background: #4E7BA8 url(#) repeat-x;
            }
        </style>
    </head>
    <body>
        <?php
        /** Si no existe la variable de sesión usuario. */
        if (!isset($_SESSION['usuario'])) {
            /** Si todos los campos del formulario tienen algún valor... */
            if (!empty($_POST['email']) && !empty($_POST['contraseña'])) {
                /** @var Usuario Instancia un objeto de la clase. */
                $usuario = new Usuario();
                /** Inicializa los atributos del objeto. */
                /** @var array[]:string Valida e inicializa la propiedad del objeto. */
                $errorEmail = $usuario->setEmail($_POST['email']);
                /** Recorre el array de errores. */
                foreach ($errorEmail as $error) {
                    /** Muestra posibles errores del email. */
                    echo '<h5>' . $error . '</h5>';
                }
                /** @var array[]:string Valida e inicializa la propiedad del objeto. */
                $errorContraseña = $usuario->setContraseña($_POST['contraseña']);
                /** Recorre el array de errores. */
                foreach ($errorContraseña as $error) {
                    /** Muestra posibles errores de la contraseña. */
                    echo '<h5>' . $error . '</h5>';
                }
                /** Comprueba que haya errores en el email y en la contraseña. */
                if (!$errorEmail && !$errorContraseña) {
                    /** Valida el email y la contraseña del usuario. */
                    if ($usuario->validaUsuario()) {
                        /** @var Usuario Crea la variable de sesión con un objeto
                         * que pertenece a la clase Usuario. */
                        $_SESSION['usuario'] = $usuario;
                        /** El usuario se ha validado correctamente. */
                        echo '<h4>El usuario ha sido validado con éxito</h4>';
                        echo '<h4>Accediendo al área privada del usuario...</h4>';
                        /** Redirecciona al módulo de usuario validado. */
                        header('refresh:2; url=usuarioValidado.php');
                    } else {
                        /** No es posible validar el usuario. */
                        echo "<h5>Error al validar el usuario
								<br>El email o la contraseña del usuario no son
								correctos</h5>";
                    }
                } else {
                    echo '<h5>No es posible validar el usuario</h5>';
                }
            } else {
                /** Si algún campo del formulario no está inicializado... */
                if (isset($_POST['email']) || isset($_POST['contraseña'])) {
                    header('refresh:2; url=index.php');
                } else {
                    echo "<h5>Debes validar un usuario para acceder</h5>";
                }
            }
        } else {
            /** El usuario ya ha sido validado. */
            echo "<h5>El usuario ya ha sido validado</h5>";
        }
        ?>

    </body>
</html>
