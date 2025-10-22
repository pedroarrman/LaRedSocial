<?php
/** Incluye la clase. */
include_once '../capaNegocio/usuario.php';
include_once '../capaNegocio/usuarioExtendido.php';
include_once '../capaNegocio/amigos.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>
<!DOCTYPE html>
<!--
 * datosPersona.php
 * Módulo secundario que visualiza los datos de un usuario.
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
            if (!empty($_POST['nombre']) && !empty($_POST['fechaNacimiento']) &&
                    !empty($_POST['sexo'])) {
                /** @var Usuario Instancia un objeto de la clase. */
                $usuario = new Usuario();
                /** Inicializa el valor de las propiedades. */
                $usuario->setIdUsuario($_POST['idUsuario']);
                $usuario->setNombre($_POST['nombre']);
                $fechaNacimiento = explode('/', $_POST['fechaNacimiento']);
                $usuario->setFechaNacimiento(new DateTime($fechaNacimiento[2] . '-' . $fechaNacimiento[1] . '-' . $fechaNacimiento[0]));
                $usuario->setSexo($_POST['sexo']);
                //var_dump($usuario);

                $usuarioExtendido = new UsuarioExtendido();
                /** Inicializa los atributos del objeto. */
                $usuarioExtendido->setIdUsuarioExtendido($usuario);
                $arrayUsuarioExtendido = $usuarioExtendido->leeUsuarioExtendido();
                ?>
                <nav>

                    <?php
                    
                    $amigos = new Amigos();
                    
                    //HACER UN MÉTODO PARA ADIVINAR SI SON AMIGOS A TRAVÉS DE 
                    //LOS ID DE USUARIO Y MOSTRARLO EN PANTALLA
                    
                    foreach ($arrayUsuarioExtendido as $valor) {
                        ?>
                        <!-- Barra Lateral -->
                        <img src="<?php echo $valor->getFoto(); ?>" width="150" height="150">
                        <h2>Redes</h2>
                        <p><?php echo $valor->getRedes(); ?></p>
                        <h2>Información</h2>
                        <p><?php echo $valor->getInformacion(); ?></p>
                        <br>
                    </nav>

                    <!--Contenido Principal-->
                    <main>
                        <div class = "container">
                            <h2><?php echo $usuario->getNombre(); ?></h2>
                            <h5>Fecha de Nacimiento: <?php echo $usuario->getFechaNacimiento()->format('d/m/Y'); ?></h5>
                            <h5>Sexo: <?php echo $usuario->getSexo(); ?></h5>
                            <!--Este es un ejemplo de cómo era el diseño de LaRedSocial.-->
                            <p>Estado: <?php echo $valor->getEstado(); ?></p>
                            <!-- AQUI VA UN FORMULARIO PARA ENVIAR PETICION DE AMISTAD -->
                            <form action="enviaPeticion.php" method="post">
                                <table>
                                    <tr>
                                        <td><input type="hidden" name="usuario1" size="1" value="<?php echo $_SESSION['usuario']->getIdUsuario() ?>"></td>
                                        <td><input type="hidden" name="usuario2" size="1" value="<?php echo $usuario->getIdUsuario() ?>"></td>
                                        <td><input type="hidden" name="estado" size="20" value="pendiente"></td>
                                        <td><input type="hidden" name="fechaSolicitud" value="<?php echo date("d/m/Y") ?>"</td>
                                    </tr>
                                    <tr>
                                    <input class="boton" type="submit" value="enviar" name="Enviar solicitud de amistad">
                                    </tr>
                                </table>
                            </form>                     
                        </div>

                        <div class="container">
                            <h2>Tablón</h2>
                            <p>Contenido adicional puede ir aquí.</p>
                        </div>
                    </main>            
                    <?php
                }
            }
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
