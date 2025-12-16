<?php
/** Incluye la clase. */
/** Inicia una nueva sesión o recupera la sesión actual. */
include_once '../capaNegocio/usuario.php';
include_once '../capaNegocio/usuarioExtendido.php';

session_start();
?>
<!DOCTYPE html>
<!--
        * modificaUsuarioExtendido.php
        * Módulo secundario que modifica o elimina a un usuarioExtendido.
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
            <?php
            /** Si el campo obligatorio contiene algun valor. */
            if (!empty($_POST["idUsuarioExtendido"])) {
                if (isset($_POST["modificar"])) {
                    echo '<h4>Los datos adicionales del usuario están siendo modificados</h4>';
                    /** @var Usuario Instancia un objeto de la clase. */
                    $usuarioExtendido = new UsuarioExtendido();

                    $usuario = new Usuario();
                    /** Inicializa las propiedades del objeto . */
                    $usuario->setIdUsuario($_POST["idUsuarioExtendido"]);

                    $usuarioExtendido->setIdUsuarioExtendido($usuario);
                    $usuarioExtendido->setFoto($_POST["foto"]);
                    $usuarioExtendido->setEstado($_POST["estado"]);
                    $usuarioExtendido->setRedes($_POST["redes"]);
                    $usuarioExtendido->setInformacion($_POST["informacion"]);
                    /** Actualizar los datos del usuario extendido. */
                    if ($usuarioExtendido->modificaUsuarioExtendido()) {
                        /** Datos modificados con éxito */
                        echo '<h2>Los datos adicionales han sido modificados con éxito</h2>';
                        header('refresh:2; url=usuarioValidado.php');
                    } else {
                        echo '<h2>Los datos adicionales no han sido modificados</h2>';
                    }
                }
                ?>
                <div class="container mt-5">
                    <div class="row">
                        <!-- Formulario de Modificación -->
                        <div class="col-md-6">
                            <h4 class="mb-3">Modificar datos adicionales</h4>
                            <form action="modificaUsuarioExtendido.php" method="post">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="idUsuarioExtendido" class="form-control" value="<?php echo $usuarioExtendido->getIdUsuarioExtendido(); ?>">
                                    </div>
                                </div>                                    
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Foto:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="foto" class="form-control" value="<?php echo $usuarioExtendido->getFoto(); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">estado:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="estado" class="form-control" value="<?php echo $usuarioExtendido->getEstado(); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Redes:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="redes" class="form-control" value="<?php echo $usuarioExtendido->getRedes(); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Informacion:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="informacion" class="form-control" value="<?php echo $usuarioExtendido->getInformacion(); ?>">
                                    </div>
                                </div>                               

                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <input type="submit" class="btn btn-primary" name="modificar" value="Modificar">
                                        <input type="submit" class="btn btn-danger" name="eliminar" value="Eliminar">
                                        <input type="button" class="btn btn-secondary" value="Cancelar" onClick="location.href = 'usuarioValidado.php'">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                echo'<h4>No es posible modificar datos adicionales</h4>';
            }
            ?>
            <!-- Barra Lateral -->
            <nav>

            </nav>


            <!-- Contenido Principal -->
            <main>
                <div class="container">
                    <h2><?php echo $_SESSION['usuario']->getNombre(); ?></h2>
                    <!--Este es un ejemplo de cómo era el diseño de LaRedSocial.-->
                </div>                        
                <?php
                /** */
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
                          action="#n"><input type="hidden"
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
                        <li><img src="#" alt="" title=""></li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="#"></script>
    </body>

</html>

