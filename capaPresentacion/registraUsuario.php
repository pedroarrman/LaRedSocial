<?php
/** Incluye la clase. */
include '../capaNegocio/usuario.php';
include '../capaNegocio/usuarioExtendido.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>

<!--
        * registraUsuario.php
        * Módulo secundario que registra un nuevo usuario.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestión de usuarios</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
    </head>
    <body>
        <header>
            <h1>Gestión de usuarios</h1>
        </header>
        <nav>
            <a href="index.php">Inicio</a> &nbsp;&nbsp;
            <?php
            if (isset($_SESSION['usuario'])) {
                echo '<a href="usuarioValidado.php">Área usuario</a> &nbsp;&nbsp;';
                echo '<a href="gestionUsuario.php">Perfil usuario</a> &nbsp;&nbsp;';
                echo '<a href="cierraSesion.php">Cerrar sesión</a> &nbsp;&nbsp;';
                echo 'Usuario: ' . $_SESSION['usuario']->getNombre();
            } else {
                echo '<a href="accesoUsuarios.php">Acceso usuarios</a>';
            }
            ?>
        </nav>
        <article>
            <h3>Registrar usuario</h3>
            <?php
            /** Si no existe la variable de sesión usuario. */
            if (!isset($_SESSION['usuario'])) {
                /** Si todos los campos del formulario tienen algún valor... */
                if (!empty($_POST['email']) && !empty($_POST['contraseña']) &&
                        !empty($_POST['nombre']) && !empty($_POST['fechaNacimiento']) &&
                        !empty($_POST['sexo'])) {
                    /** @var Usuario Instancia un objeto de la clase. */
                    $usuario = new Usuario();
                    /** @var array[]:string Valida e inicializa la propiedad del objeto. */
                    $errorEmail = $usuario->setEmail($_POST['email']);
                    /** Recorre el array de errores. */
                    foreach ($errorEmail as $error) {
                        /** Muestra posibles errores del email. */
                        echo '<h5>' . $error . '</h5>';
                    }
                    /** @var array[]:string Valida e inicializa la propiedad del objeto. */
                    $errorContraseña = $usuario->setContraseña($_POST['contraseña']);
                    /** Recorre el array de errores. */
                    foreach ($errorContraseña as $error) {
                        /** Muestra posibles errores de la contraseña. */
                        echo '<h5>' . $error . '</h5>';
                    }
                    /** Comprueba que haya errores en el email y en la contraseña. */
                    if (!$errorEmail && !$errorContraseña) {
                        /** Inicializa la propiedad del objeto nombre. */
                        $usuario->setNombre($_POST['nombre']);
                        /** @var string Adapta el formato de la fecha de dd/mm/aaaa -> aaaa-mm-dd. */
                        $fecha = explode('/', $_POST['fechaNacimiento']);
                        $usuario->setFechaNacimiento(new DateTime($fecha[2] . '-' . $fecha[1] . '-' . $fecha[0]));
                        $usuario->setSexo($_POST['sexo']);
                        
                        //var_dump($usuario);
                        /** Comprueba si existe el usuario. */
                        if (!$usuario->existeUsuario()) {
                            /** Intenta almacenar al usuario y comprueba error. */
if ($usuario->almacenaUsuario()) {
                                /** @var Usuario Crea la variable de sesión con un objeto
                                 * que pertenece a la clase Usuario. */
                                $_SESSION['usuario'] = $usuario;
                                /** El usuario se ha registrado correctamente. */
                                
                                /** Ahora creamos al usuario extendido */
                                $usuarioExtendido = new UsuarioExtendido();
                                /** Inicializa la propiedad del objeto. */
                                $usuarioExtendido->setIdUsuarioExtendido($usuario);
                                if ($usuarioExtendido->almacenaUsuarioExtendido()) {
                                    echo '<h4>El usuario ha sido almacenado con éxito</h4>';
                                    echo '<h4>...</h4>';
                                    /** Redirecciona al módulo de usuario validado. */
                                    header('refresh:2; url=registraUsuarioExtendido.php');
                                } else {
                                    /** Se ha producido un error al registrar el usuario extendido. */
                                    echo '<h5>Error en la base de datos al intentar crear al usuario</h5>';
                                }
                            } else {
                                /** Se ha producido un error al registrar el usuario. */
                                echo '<h5>Error en la base de datos al almacenar el usuario</h5>';
                            }
                        } else {
                            /** Se intenta registrar un usuario existente. */
                            echo '<h5>El usuario ya existe en la base de datos</h5>';
                        }
                    } else {
                        echo '<h5>No es posible registrar el usuario</h5>';
                    }
                } else {
                    /** Si algún campo del formulario no está inicializado... */
                    if (isset($_POST['email']) || isset($_POST['contraseña']) ||
                            isset($_POST['nombre']) || !empty($_POST['fechaNacimiento']) || !empty($_POST['sexo'])) {
                        echo "<h5>Error al dar de alta el usuario
								<br>Todos los campos son obligatorios</h5>";
                    } else {
                        /** Si se intenta acceder sin registrar un usuario... */
                        echo "<h5>Debes registrar un usuario para acceder</h5>";
                    }
                }
            } else {
                /** El usuario ya ha sido registrado. */
                echo "<h5>El usuario ya ha sido registrado</h5>";
            }
            ?>
        </article>
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
                          action=""><input type="hidden" name="lang" id="lang">
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
                        <li><img src="" alt="" title=""></li>
                        <li><img src="" alt="" title=""></li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="#"></script>
    </body>

</html>
