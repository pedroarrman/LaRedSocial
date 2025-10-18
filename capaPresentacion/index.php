<?php
// Incluye las clases necesarias.
include_once '../capaNegocio/usuario.php';
include_once '../capaNegocio/peticiones.php';

// Inicia una nueva sesión o recupera la sesión actual.
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
    <?php if (isset($_SESSION['usuario'])): ?>
        <!-- Hoja de estilo para usuarios autenticados -->
        <link rel="stylesheet" href="css/style.css">
    <?php else: ?>
        <!-- Hoja de estilo para la pantalla de inicio de sesión -->
<link rel="stylesheet" type="text/css" href="css/banner-styles.css">
<link rel="stylesheet" type="text/css" href="css/iconochive.css">
<link rel="stylesheet" type="text/css" href="css/1_login.53821.53320.css">
<link rel="stylesheet" type="text/css" href="css/banner.css">
        <style>
            .hide {
                display: none !important;
            }

            .loadingPage .canvas,
            .loadingPage .footer {
                position: absolute;
                top: -100000px;
                left: -100000px;
                display: none;
                background: #4E7BA8 url(#) repeat-x;
            }
        </style>
    <?php endif; ?>
</head>
<body>
<?php
// Verifica si el usuario está autenticado.
if (isset($_SESSION['usuario'])) {
    ?>
    <!-- Página para usuarios autenticados -->
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

    <main>
        <h1>Bienvenido, <?php echo ($_SESSION['usuario']->getNombre()); ?></h1>
        <p>Aquí puedes visualizar tus peticiones y más.</p>
    </main>
<!-- Aquí una sección para ver las novedades de los amigos -->
    <footer>
        <div class="footerContent">
            <ul>
                <li><a href="#" title="Legal">Legal</a></li>
                <li><a href="#" title="Ayuda">Ayuda</a></li>
                <li><a href="#" title="Desarrolladores">Desarrolladores</a></li>
                <li><a href="#" title="Blog oficial">Blog</a></li>
                <li><a href="#" title="Prensa">Prensa</a></li>
                <li><a href="#" title="Anúnciate">Anúnciate</a></li>
                <li><a href="#" title="Empleo">Empleo</a></li>
                <li><a href="#" title="Acerca de">Acerca de</a></li>
                <li class="copy">
                    <a href="index.php">© LaRedSocial <?php echo date("Y"); ?></a>
                </li>
            </ul>
        </div>
    </footer>

    <script src="js/project.js"></script>
    <?php
} else {
    ?>
    <!-- Página para usuarios no autenticados -->
    <div class="login">
        <div id="login" class="body">
            <form action="validaUsuario.php" method="post">
                <fieldset>
                    <ul>
                        <li>
                            <label for="email" class="inputLabel">Email</label>
                            <span class="input">
                                <input id="email" class="email" name="email" type="text" tabindex="1">
                            </span>
                            <label for="remember" class="rememberMe">
                                <input id="remember" name="remember" type="checkbox" class="rememberMe" value="1">
                                Recordarme
                            </label>
                        </li>
                        <li>
                            <label for="input_password" class="inputLabel">Contraseña</label>
                            <span class="input">
                                <input id="input_password" class="password" name="contraseña" type="password" tabindex="2">
                            </span>
                            <a href="#" title="¿Has olvidado tu contraseña?">¿Has olvidado tu contraseña?</a>
                        </li>
                        <li class="buttons">
                            <input type="submit" id="submit_button" class="submit withLabels" value="Entrar">
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>
        <div class="getAccount">
            <div class="border">
                <a href="accesoUsuarios.php" title="Consigue una cuenta">¿Quieres una cuenta?</a>
            </div>
        </div>        
    <!-- aqui acaba el login -->    
    </div>
            <?php
        }
        ?>
        <div class="cover">
            <div class="description">
                <svg xmlns="#" xmlns:xlink="#" width="350" height="306" viewBox="0 0 350 306">
                <image id="Capa_1" data-name="Capa 1" x="13" y="11" width="324" height="284" xlink:href="#"/>
                </svg>
                <!--<h1>Lorem Ipsum</h1>
                <h2>Lorem Ipsum</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua..</p>-->
            </div>
            <div class="mainPoints">
                <ul>
                    <li class="social">
                        <h3>Lorem Ipsum</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </li>
                    <li class="local">
                        <h3>Lorem Ipsum</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </li>
                    <li class="mobile">
                        <h3>Lorem Ipsum</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </li>
                </ul>
            </div>
        </div>

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
                    <p></p>
                    <ul>
                        <li><img src="" alt="" title=""></li>
                        <li><img src="" alt=""
                                 title=""></li>
                    </ul>
                </div>
            </div>
        </div>
</body>
</html>
