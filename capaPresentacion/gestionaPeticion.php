
<?php
/** Incluye la clase. */
include_once '../capaNegocio/usuario.php';
include_once '../capaNegocio/peticiones.php';
include_once '../capaNegocio/amigos.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>
<!DOCTYPE html>
<!--
    * aceptaPeticion.php
    * Módulo secundario que un usuario acepta las peticiones recibidas por otros usuarios.
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
                if (!empty($_POST['idAmistad']) && !empty($_POST['usuario1']) &&
                        !empty($_POST['usuario2']) && !empty($_POST['estado']) &&
                        !empty($_POST['fechaSolicitud'])) {

                    if (isset($_POST['aceptar'])) {

                        /** @var Instancia un objeto de la clase. */
                        $usuario1 = new Usuario();
                        $usuario2 = new Usuario();

                        /** Inicializa los atributos del objeto. */
                        $usuario1->setIdUsuario($_POST['usuario1']);
                        $usuario2->setIdUsuario($_POST['usuario2']);

                        /** Llamamos al método lee usuario */
                        $usuario1->leeUsuario();
                        $usuario2->leeUsuario();

                        /** @var Instancia un objeto de la clase. */
                        $peticiones = new Peticiones();

                        /** Inicializa los atributos del objeto. */
                        $peticiones->setIdAmistad($_POST['idAmistad']);
                        $peticiones->setIdUsuario1($usuario1);
                        $peticiones->setIdUsuario2($usuario2);
                        $peticiones->setEstado('aceptada');

                        /** @var string Adapta el formato de la fecha de dd/mm/aaaa -> aaaa-mm-dd. */
                        $fechaSolicitud = explode('/', $_POST['fechaSolicitud']);
                        $peticiones->setFechaSolicitud(new DateTime($fechaSolicitud[2] . '-' . $fechaSolicitud[1] . '-' . $fechaSolicitud[0]));
                        //var_dump($peticiones);
                        //$peticiones->leePeticion();

                        $peticiones->modificaPeticion();
                        
                        if ($peticiones->existePeticion() &&
                                $usuario1->existeUsuario() && $usuario2->existeUsuario()) {
                            /** @var Instancia un objeto de la clase. */
                            $amigos = new Amigos();

                            /** Inicializa los atributos del objeto. */
                            $amigos->setIdAmigo($peticiones);
                            $amigos->setCodUsuario1($usuario1);
                            $amigos->setCodUsuario2($usuario2);
                            /** @var string Adapta el formato de la fecha de dd/mm/aaaa -> aaaa-mm-dd. */
                            $fechaRespuesta = explode('/', $_POST['fechaRespuesta']);
                            $amigos->setFechaAmistad(new DateTime($fechaRespuesta[2] . '-' . $fechaRespuesta[1] . '-' . $fechaRespuesta[0]));

                            //var_dump($amigos);

                            /** comprobamos si el Candidato no se ha inscrito ya */
                            if (!$amigos->existeAmigo()) {
                                /** Almacena la relación ofertaCandidato y comprueba error. */
                                if ($amigos->insertaAmigo()) {
                                    /** se han hecho amigos los dos usuarios */
                                    echo '<h4>¡Has hecho un nuevo amigo!</h4>';
                                } else {
                                    /** Se ha producido un error al registrar la oferta. */
                                    echo '<h5>Error al aceptar la petición</h5>';
                                }
                            } else {
                                /** Se ha producido un error al registrar la oferta. */
                                echo '<h5>El usuario ya era amigo tuyo</h5>';
                            }
                        } else {
                            /** Se ha producido un error al registrar la oferta. */
                            echo '<h5>El usuario no existe en la base de datos</h5>';
                        }
                    } else if (isset($_POST['rechazar'])) {
                        /** @var Instancia un objeto de la clase. */
                        $usuario1 = new Usuario();
                        $usuario2 = new Usuario();

                        /** Inicializa los atributos del objeto. */
                        $usuario1->setIdUsuario($_POST['usuario1']);
                        $usuario2->setIdUsuario($_POST['usuario2']);

                        /** Llamamos al método lee usuario */
                        $usuario1->leeUsuario();
                        $usuario2->leeUsuario();

                        /** @var Instancia un objeto de la clase. */
                        $peticiones = new Peticiones();

                        /** Inicializa los atributos del objeto. */
                        $peticiones->setIdAmistad($_POST['idAmistad']);
                        $peticiones->setIdUsuario1($usuario1);
                        $peticiones->setIdUsuario2($usuario2);
                        $peticiones->setEstado('rechazada');

                        /** @var string Adapta el formato de la fecha de dd/mm/aaaa -> aaaa-mm-dd. */
                        $fechaSolicitud = explode('/', $_POST['fechaSolicitud']);
                        $peticiones->setFechaSolicitud(new DateTime($fechaSolicitud[2] . '-' . $fechaSolicitud[1] . '-' . $fechaSolicitud[0]));
                        var_dump($peticiones);
                        $peticiones->modificaPeticion();
                        echo '<h4>se ha rechazado la peticion</h4>';
                    }
                }
                ?>

                <?php
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
            <script src="#"></script>
    </body>

</html>
