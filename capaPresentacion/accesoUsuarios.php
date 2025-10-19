<?php
/** Incluye la clase. */
include '../capaNegocio/usuario.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>

<!--
        * accesoUsuarios.php
        * Módulo secundario que muestra la página de acceso para los usuarios.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Consigue una cuenta</title>
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
    </head>
    <body>


        <?php
        if (isset($_SESSION['usuario'])) {
            echo '<a href="usuarioValidado.php">Área usuario</a> &nbsp;&nbsp;';
            echo '<a href="gestionUsuario.php">Perfil usuario</a> &nbsp;&nbsp;';
            echo '<a href="cierraSesion.php">Cerrar sesión</a> &nbsp;&nbsp;';
            echo 'Usuario: ' . $_SESSION['usuario']->getNombre();
        }
        ?>

        <?php
        /** Si no existe la variable de sesión usuario. */
        if (!isset($_SESSION['usuario'])) {
            ?>
            <div class="canvas password" style="margin-top: -258px;">
                <h1><a href=" " title="LaRedSocial">LaRedSocial</a>
                </h1>
                <div class="body">
                    <form action="registraUsuario.php" method="post">

                        <h2>Solicitar una cuenta</h2>
                        <fieldset>
                            <ul>

                                <li><label for="email">Email</label><span class="input"><input class="email" id="email" name="email"
                                                                                               type="text" value="" title="El email debe ser una dirección de correo válida."
                                                                                               size="40"></span></li>
                                <li><label for="Contraseña">Contraseña</label><span class="input"><input class="email" id="email" name="contraseña"
                                                                                                         type="text" value="" title="La contraseña debe estar compuesta por caracteres alfanuméricos, tenga una longitud entre 4 y 15 caracteres y contenga al menos una letra mayúscula."
                                                                                                         size="15"></span></li>           
                                <li><label for="Nombre">Nombre</label><span class="input"><input class="email" id="email" name="nombre"
                                                                                                 type="text" value="" title="La contraseña debe estar compuesta por caracteres alfanuméricos, tenga una longitud entre 4 y 15 caracteres y contenga al menos una letra mayúscula."
                                                                                                 size="50"></span></li> 
                                <li><label for="Nombre">Fecha de nacimiento </label><span class="input"><input class="email" id="email" name="fechaNacimiento"
                                                                                                               type="text" value="" title="La fecha de nacimiento debe seguir el formato DD/MM/AAAA."
                                                                                                               size="50"></span></li>
                                <li><label for="Nombre">Sexo </label><span class="input"><select name="sexo" class="email">
                                                    <option value="H">Hombre</option>
                                                    <option value="M">Mujer</option>
                                                    <option value="O">Otro</option>
                                                </select></span></li> 
                                <li class="buttons"><input type="submit" id="submit_request_new_password_form" class="submit"
                                                           value="Registrar"><input type="reset" 
                                                           value="Cancelar"></li>
                            </ul>
                        </fieldset>
                    </form>
                </div>
                <ul id="options" class="wantsEnter">
                    <li class="first"><a href="index.php"
                                         title="Volver">Volver</a></li>
                </ul>
            </div>    

            <?php
        } else {
            /** El usuario no ha sido validado. */
            echo "<h5>El usuario ya ha sido validado</h5>";
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
                    <li class="copy">© LaRedSocialElTuenti <?php echo date("Y"); ?></li>
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
    </body>
</html>
