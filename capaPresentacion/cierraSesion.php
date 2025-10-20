<?php
// Incluye la clase.
include '../capaNegocio/usuario.php';
/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>

<!--
        * cierraSesion.php
        * Módulo secundario que cierra la sesión.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cerrar Sesion</title>
        <link rel="stylesheet" href="css/style.css"> 
    </head>
    <body>
        <?php
        /** Comprueba que la sesión esté iniciada. */
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
                <div class="container">			
                    <h3>Cierra sesión</h3>
                </div>
                <?php
                echo "<h4>La sesión actual ha sido cerrada</h4>";
                echo '<h4>Adiós ' . $_SESSION['usuario']->getNombre() . '</h4>';
                /** Elimina todas las variables de sesión. */
                $_SESSION = array();
                /** Finaliza la sesión actual. */
                session_destroy();
            } else {
                /** El usuario no ha sido validado. */
                echo "<h5>El usuario no ha sido validado</h5>";
            }
            ?>
        </main>
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
                <div class="mod footerRibbon">
                    <p>Páginas oficiales</p>
                    <ul>
                        <li><img src="#" alt="#" title=""></li>
                        <li><img src="#" alt="#"
                                 title=""></li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="js/project.js"></script>
    </body>

</html>
