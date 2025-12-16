
<?php
/** Incluye la clase. */
include_once '../capaNegocio/usuario.php';
include_once '../capaNegocio/peticiones.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>
<!DOCTYPE html>
<!--
    * registraUsuarioExtendido.php
    * Módulo secundario que un usuario visualiza las peticiones recibidas por otros usuarios.
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

            <!-- Barra Lateral -->
            <nav>

            </nav>


            <!-- Contenido Principal -->
            <main>


                <?php
                /** Ahora creamos al usuario extendido */
                $usuarioActivo = $_SESSION['usuario']->getIdUsuario();

                $usuarioExtendido = new UsuarioExtendido();
                /** Inicializa la propiedad del objeto. */
                $usuarioExtendido->setIdUsuarioExtendido($usuarioActivo);
                if ($usuarioExtendido->almacenaUsuarioExtendido()) {
                    echo '<h4>El usuario ha sido almacenado con éxito</h4>';
                    echo '<h4>Accediendo al área privada del usuario...</h4>';
                    /** Redirecciona al módulo de usuario validado. */
                    header('refresh:2; url=usuarioValidado.php');
                } else {
                    /** Se ha producido un error al registrar el usuario extendido. */
                    echo '<h5>Error en la base de datos al intentar crear al usuario</h5>';
                }
                /** Hasta aquí sería la lógica de la sesión */
            }
            ?>
            <div class="footer">
                <div class="footerContent">
                    <ul>
                        <li><a href=""
                               title="Legal">Legal</a></li>
                        <li><a href="" title="Ayuda">Ayuda</a>
                        </li>
                        <li><a href=""
                               title="Desarrolladores">Desarrolladores</a></li>
                        <li><a href="" title="Blog oficial">Blog</a>
                        </li>
                        <li><a href="" title="Prensa">Prensa</a>
                        </li>
                        <li><a href="" onclick=""
                               title="Anúnciate">Anúnciate</a></li>
                        <li><a href="" onclick=""
                               title="Empleo">Empleo</a></li>
                        <li><a href="" onclick=""
                               title="Acerca de">Acerca de</a></li>
                        <li class="copy"><a href="index.php">© LaRedSocial <?php echo date("Y"); ?></a></li>
                        <form method="post" id="lang_form"
                              action="#"><input type="hidden"
                                                                                                                  name="lang" id="lang">
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
