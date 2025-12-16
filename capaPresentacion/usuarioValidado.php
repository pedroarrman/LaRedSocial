<?php
/** Incluye la clase. */
include_once '../capaNegocio/usuario.php';
include_once '../capaNegocio/usuarioExtendido.php';
include_once '../capaNegocio/peticiones.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>
<!DOCTYPE html>
<!--
        * usuarioValidado.php
        * Módulo donde el usuario logeado ve su perfil.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mi perfil</title>
        <link rel="stylesheet" href="css/style.css"> 

    </head>
    <body>
        <?php
        if (isset($_SESSION['usuario'])) {
            ?>
            <!-- Cabecera -->
            <header>
                <ul>
            <li><b>LaRedSocial</b></li>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="usuarioValidado.php">Perfil</a></li>
            <li><a href="mensajes.php">Mensajes</a></li>
            <li><a href="gente.php">Gente</a></li>
            <li><a href="videos.php">Videos</a></li>
            <li><a href="busqueda.php">Búsqueda</a></li>
            <li><a href="miCuenta.php">Mi Cuenta</a></li>
            <li><a href="cierraSesion.php">Salir</a></li>
                </ul>
            </header>
            <?php
            $usuario = new Usuario();

            $usuario->setIdUsuario($_SESSION['usuario']->getIdUsuario());

            /** @var UsuarioExtendido Instancia un objeto de la clase. */
            $usuarioExtendido = new UsuarioExtendido();
            /** Inicializa los atributos del objeto. */
            $usuarioExtendido->setIdUsuarioExtendido($usuario);
            $arrayUsuarioExtendido = $usuarioExtendido->leeUsuarioExtendido();
            if ($arrayUsuarioExtendido) {
                //var_dump($arrayUsuarioExtendido);
                foreach ($arrayUsuarioExtendido as $valor) {
                    ?>
                    <!-- Barra Lateral -->
                    <nav>
                        <img src="<?php echo $valor->getFoto(); ?>" width="150" height="150">
                        <h2>Redes</h2>
                        <p><?php echo $valor->getRedes(); ?></p>
                        <h2>Información</h2>

                        <p><?php echo $valor->getInformacion(); ?></p>
                    </nav>

                    <!-- Contenido Principal -->
                    <main>
                        <div class="container">
                            <h2><?php echo $_SESSION['usuario']->getNombre(); ?></h2>
                            <h5>Fecha de Nacimiento: <?php echo $_SESSION['usuario']->getFechaNacimiento()->format('d/m/Y'); ?></h5>
                            <h5>Sexo: <?php echo $_SESSION['usuario']->getSexo(); ?></h5>
                            <!--Este es un ejemplo de cómo era el diseño de Tuenti.-->
                            <p>Estado: <?php echo $valor->getEstado(); ?></p>
                            <button><a href="modificaUsuario.php" style="text-decoration: none; color: white;">Modifica tu información personal</a></button>                     
                            <button><a href="modificaDatos.php" style="text-decoration: none; color: white;">Modifica tus datos adicionales</a></button>                     

                        </div>

                        <div class="container">
                            <h2>Tablón</h2>
                            <p>Contenido adicional puede ir aquí.</p>
                        </div>                       
                    </main>            
                    <?php
                }
            } else {
                /** hay un problema con el usuarioExtendido */
                echo '<h1>Error al recuperar los datos del usuario</h1>';
            }
        } else {
            echo '<h1>Aun no has iniciado sesión</h1>';
            echo '<h2>Puedes iniciar sesión haciendo clic <a href="accesoUsuarios.php">aquí</a></h2>';
        }
        ?>


        <div class="footer">
            <div class="footerContent">
                <ul>
                    <li><a href="#"
                           title="Legal"></a></li>
                    <li><a href="#" title="Ayuda"></a>
                    </li>
                    <li><a href="#"
                           title="Desarrolladores"></a></li>
                    <li><a href="#" title="Blog oficial"></a>
                    </li>
                    <li><a href="#" title="Prensa"></a>
                    </li>
                    <li><a href="#" onclick=""
                           title="Anúnciate"></a></li>
                    <li><a href="#" onclick=""
                           title="Empleo"></a></li>
                    <li><a href="#" onclick=""
                           title="Acerca de"></a></li>
                    <li class="copy">© LaRedSocial <?php echo date("Y"); ?></li>
                    <form method="post" id="lang_form"
                          action="#"><input type="hidden" name="lang" id="lang">
                        <li class="language"></li>
                        <li class="language"><a href="#"
                                                onclick="change_language('lang_form', 'lang', 'ca_ES'); return false;"></a>
                        </li>

                        <li class="language"><a href="#"
                                                onclick="change_language('lang_form', 'lang', 'ca_ES'); return false;"></a>
                        </li>

                        <li class="language"><a href="#"
                                                onclick="change_language('lang_form', 'lang', 'ca_ES'); return false;"></a>
                        </li>

                        <li class="language"><a href="#"
                                                onclick="change_language('lang_form', 'lang', 'ca_ES'); return false;"></a>
                        </li>

                    </form>
                </ul>

            </div>
        </div>
        <script src="#"></script>
    </body>

</html>
