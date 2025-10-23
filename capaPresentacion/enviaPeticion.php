
<?php
/** Incluye la clase. */
include_once '../capaNegocio/usuario.php';
include_once '../capaNegocio/peticiones.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>
<!DOCTYPE html>
<!--
    * enviaPeticion.php
    * Módulo secundario que un usuario envia una petición a otro usuario.
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
                /** Si todos los campos del formulario tienen algún valor... */
                if (!empty($_POST['usuario1']) && !empty($_POST['usuario2']) && !empty($_POST['estado']) &&
                        !empty($_POST['fechaSolicitud'])) {

                    /** @var Amistades Instancia un objeto de la clase. */
                    $usuario1 = new Usuario();
                    $usuario2 = new Usuario();

                    /** Inicializa el valor de las propiedades. */
                    $usuario1->setIdUsuario($_POST['usuario1']);
                    $usuario2->setIdUsuario($_POST['usuario2']);

                    /** Llamamos al método lee usuario */
                    $usuario1->leeUsuario();
                    $usuario2->leeUsuario();

                    //var_dump($usuario1);

                    if ($usuario1->existeUsuario() && $usuario2->existeUsuario()) {

                        /** @var Amistades Instancia un objeto de la clase. */
                        $peticiones = new Peticiones();
                        /** Inicializa el valor de las propiedades. */
                        $peticiones->setIdUsuario1($usuario1);
                        $peticiones->setIdUsuario2($usuario2);
                        $peticiones->setEstado($_POST['estado']);
                        $fechaSolicitud = explode('/', $_POST['fechaSolicitud']);
                        $peticiones->setFechaSolicitud(new DateTime($fechaSolicitud[2] . '-' . $fechaSolicitud[1] . '-' . $fechaSolicitud[0]));
                        //var_dump($peticiones);
                        /** comprobamos si la petición no se ha enviado ya */
                        if (!$peticiones->existePeticion()) {
                            /** Almacena la peticion y comprueba error. */
                            if ($peticiones->enviarPeticion()) {
                                /** Almacena la petición de forma correcta */
                                echo '<h4>La petición ha sido enviada con éxito.</h4>';
                            } else {
                                /** Se ha producido un error al enviar la petición. */
                                echo '<h5>Error al enviar la petición.</h5>';
                            }
                        } else {
                            /** Se ha producido un error al registrar la peticion. */
                            echo '<h5>Ya habias enviado una petición al usuario.</h5>';
                        }
                    } else {
                        /** Se ha producido un error al registrar la oferta. */
                        echo '<h5>El usuario no está registrado en la web. </h5>';
                    }
                } else {
                    echo "<h5>Error al enviar la petición al usuario 
                          <br>Todos los campos son obligatorios</h5>";
                }
                header('refresh:2; url=datosPersona.php');
                ?>
            </main>            
            <?php
        } else {
            echo '<h1>Aun no has iniciado sesión</h1>';
            echo '<h2>Puedes iniciar sesión haciendo clic <a href="accesoUsuarios.php">aquí</a></h2>';
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
            </div>
        </div>
        <script src="js/project.js"></script>
    </body>

</html>
