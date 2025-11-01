
<?php
/** Incluye la clase. */
include_once '../capaNegocio/usuario.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>
<!DOCTYPE html>
<!--
    * geste.php
    * Módulo secundario que muestra los usuarios registrados en la aplicación.
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
                <button><a href="verPeticiones.php" style="text-decoration: none; color: white;">Ver peticiones de amistad</a></button>                     

            </nav>


            <!-- Contenido Principal -->
            <main>
                <table>
                    <?php
                    $usuario = new Usuario();
                    //var_dump($usuario);
                    $usuarioActivo = $_SESSION['usuario'];
                    $arrayUsuarios = $usuario->leeUsuarios();

                    if ($arrayUsuarios) {
                        ?>


                        <tr>
                            <td> </td>
                            <td>nombre</td>
                            <td>fecha de nacimiento</td>
                            <td>sexo</td>
                            <td></td>
                        </tr>

                        <?php
                        foreach ($arrayUsuarios as $valor) {
                            //var_dump($valor);
                            if ($usuarioActivo->getidUsuario() != $valor->getidUsuario()) {
                                ?>
                                <tr>
                                <form action="datosPersona.php" method="post">
                                    <td><input type="hidden" name="idUsuario" value="<?php echo $valor->getidUsuario(); ?>" readonly class="form-control"></td>
                                    <td><input type="text" name="nombre" value="<?php echo $valor->getNombre(); ?>" readonly class="form-control"></td>
                                    <td><input type="text" name="fechaNacimiento" value="<?php echo $valor->getFechaNacimiento()->format('d/m/Y'); ?>" readonly class="form-control"></td>
                                    <td><input type="text" name="sexo" value="<?php echo $valor->getSexo(); ?>" readonly class="form-control"></td>
                                    <td><button type="submit" name="datos" class="btn btn-primary">Datos</button></td>
                                </form>
                                </tr>
                                <?php
                            }
                        }
                    } else {
                        echo "<h5>No hay usuarios registrados.</h5>";
                    }
                    ?>

                </table>
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
