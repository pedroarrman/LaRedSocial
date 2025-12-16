
<?php
/** Incluye la clase. */
include_once '../capaNegocio/usuario.php';
include_once '../capaNegocio/peticiones.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>
<!DOCTYPE html>
<!--
    * verPeticiones.php
    * Módulo secundario que un usuario visualiza las peticiones recibidas por otros usuarios.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mi perfil</title>
        <link rel="stylesheet" href="css/style.css"> 
        <!-- Favicons -->
        <link href="#" rel="icon">
        <link href="#" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link rel="preconnect" href="#">
        <link rel="preconnect" href="#" crossorigin>
        <link href="#" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/main.css" rel="stylesheet">
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
                /** AQUI HAY QUE INDICAR QUE SI EL ID DE USUARIO DEL USUARIO ACTIVO COINCIDE 
                 * CON EL ID USUARIO DEL IDUSUARIO2 MUESTRE LA OPCIÓN ACEPTA PETICIÓN */
                $peticiones = new Peticiones();

                $usuario1 = new Usuario();
                $usuario2 = new Usuario();

                $arrayPeticiones = $peticiones->leePeticiones();
                if ($arrayPeticiones) {
                    ?>
                    <div class="tabla">
                        <div class="cabecera">
                            <div class="col text-center">id Peticion</div>
                            <div class="col text-center">usuario1</div>
                            <div class="col text-center">usuario2</div>
                            <div class="col text-center">estado</div>
                            <div class="col text-center">fechaSolicitud</div>
                        </div> 
                        <?php
                        foreach ($arrayPeticiones as $valor) {
                            ?>                        
                            <form action="gestionaPeticion.php" method="post" class="w-100">
                                <input type="hidden" name="idAmistad" value="<?php echo $valor->getIdAmistad(); ?>" readonly>

                                <div class="informacion">
                                    <div class="col">
                                        <input type="text" name="usuario1" value="<?php echo $valor->getIdUsuario1()->getIdUsuario(); ?>" readonly class="form-control">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="usuario2" value="<?php echo $valor->getIdUsuario2()->getIdUsuario(); ?>" readonly class="form-control">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="estado" value="<?php echo $valor->getEstado() ?>" readonly class="form-control">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="fechaSolicitud" value="<?php echo $valor->getFechaSolicitud()->format('d/m/Y'); ?>" readonly class="form-control">
                                    </div>
                                    <div class="col">
                                        <input type="hidden" name="fechaRespuesta" value="<?php echo date("d/m/Y"); ?>" readonly class="form-control">
                                    </div>
                                    <div class="col d-flex justify-content-start">
                                        <button type="submit" name="aceptar" class="btn btn-primary">Aceptar</button>
                                    </div>
                                    <div class="col d-flex justify-content-start">
                                        <button type="submit" name="rechazar" class="btn btn-primary">Rechazar</button>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                    }
                    ?>
                </form>
            </div>
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
                        <li class="copy">© LaRedSocial <?php echo date("Y"); ?><</li>
                        <form method="post" id="lang_form"
                              action=""><input type="hidden"
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
