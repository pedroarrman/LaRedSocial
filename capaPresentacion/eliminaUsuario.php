<?php
/** Incluye la clase. */
include_once '../capaNegocio/usuario.php';
//include_once '../capaNegocio/usuarioExtendido.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>
<!DOCTYPE html>
<!--
        * eliminaEmpresa.php
        * Módulo secundario que modifica o elimina un usuario.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modifica tus datos</title>
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
                <img src="../capaPresentacion/img/default.jpeg" width="150" height="150">
                <?php
//$usuarioExtendido = new UsuarioExtendido();
                ?>
            </nav>


            <!-- Contenido Principal -->
            <main>
                <div class="container">
                    <h2><?php echo $_SESSION['usuario']->getNombre(); ?></h2>
                    <!--Este es un ejemplo de cómo era el diseño de Tuenti.-->
                </div>                        
                <?php
                /** Comprueba que se ha pulsado el botón Eliminar. */
                if (isset($_POST['eliminar'])) {
                    /** @var Usuario Instancia un objeto de la clase Abonado. */
                    $usuario = new Usuario();
                    /** Inicializa los atributos del objeto. */
                    $usuario->setIdUsuario($_POST['idUsuario']);
                    $usuario->setEmail($_POST['email']);
                    $usuario->setContraseña($_POST['contraseña']);
                    $usuario->setNombre($_POST['nombre']);
                    $fechaNacimiento = DateTime::createFromFormat('d/m/Y', $_POST['fechaNacimiento']);
                    $usuario->setFechaNacimiento($fechaNacimiento);
                    $usuario->setSexo($_POST['sexo']);
                    /** Comprueba la eliminación... */
                    if ($usuario->eliminaUsuario()) {
                        /** Muestra el mensaje de eliminación. */
                        echo '<h4>El usuario está siendo eliminado...</h4>';
                        /** Redirecciona al módulo de cerrar la sesión en 4 segundos. */
                        header("refresh:2; url=cierraSesion.php");
                    } else {
                        /** Error en el archivo al eliminar el usuario. */
                        echo '<h5>Error al eliminar el usuario</h5>';
                    }
                } else {
                    /** Datos del usuario inconsistentes. */
                    echo '<h5>Debes validar un usuario para eliminarlo</h5>';
                }
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
                    <li class="copy">© LaRedSocial <?php echo date("Y"); ?></li>
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
                        <li><img src="#" alt="" title=""></li>
                        <li><img src="#" alt=""
                                 title=""></li>
                    </ul>
                </div>
            </div>
        </div>

        <script src="js/project.js"></script>
    </body>

</html>
