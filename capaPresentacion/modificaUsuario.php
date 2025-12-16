<?php
/** Incluye la clase. */
include_once '../capaNegocio/usuario.php';

/** Inicia una nueva sesión o recupera la sesión actual. */
session_start();
?>
<!DOCTYPE html>
<!--
        * modificaUsuario.php
        * Módulo secundario que modifica o elimina a un usuario.
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
                <img src="<?php ?>" width="150" height="150">                            
            </nav>


            <!-- Contenido Principal -->
            <main>
                <div class="container">
                    <h2><?php echo $_SESSION['usuario']->getNombre(); ?></h2>
                    <!--Este es un ejemplo de cómo era el diseño de Tuenti.-->
                </div>                        
                <?php
                /** aquí habría que discriminar en si se ha pulsado modificar datos o si se ha pulsado modificar datos adicionales. */
                /** Si todos los campos del formulario tienen algún valor... */
                if (!empty($_POST['email']) && !empty($_POST['contraseña']) &&
                        !empty($_POST['nombre']) && !empty($_POST['fechaNacimiento']) && !empty($_POST['sexo'])) {
                    /** Si se ha seleccionado el botón Modificar. */
                    if (isset($_POST['modificar'])) {
                        echo '<h4>El usuario está siendo modificado</h4>';
                        /** @var Usuario Instancia un objeto de la clase. */
                        $usuario = new Usuario();

                        $usuario->setIdUsuario($_POST['idUsuario']);
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
                            $usuario->setSexo($_POST['sexo']);
                            /** @var string Adapta el formato de la fecha de dd/mm/aaaa -> aaaa-mm-dd. */
                            $fechaNacimiento = DateTime::createFromFormat('d/m/Y', $_POST['fechaNacimiento']);
                            $usuario->setFechaNacimiento($fechaNacimiento);

                            /** Si no se ha modificado el email del usuario... */
                            if ($_POST['email'] == $_POST['email_original']) {
                                /** Intenta modificar los datos del usuario. */
                                if ($usuario->modificaUsuario($_POST['email_original'])) {
                                    /** Actualiza los valores en la varible de sesión. */
                                    $_SESSION['usuario']->setContraseña($_POST['contraseña']);
                                    $_SESSION['usuario']->setNombre($_POST['nombre']);
                                    $_SESSION['usuario']->setSexo($_POST['sexo']);
                                    $_SESSION['usuario']->setFechaNacimiento($fechaNacimiento);

                                    /** Datos del usuario modificados correctamente. */
                                    echo '<h4>Los datos del usuario han sido modificados con éxito</h4>';
                                    echo '<h4><a href="modificaUsuario.php">Volver</a></h4>';
                                } else {
                                    /** Error al modificar los datos del candiato. */
                                    echo '<h5>Error al modificar los datos del usuario</h5>';
                                    /** Se reestablecen los valores iniciales de las propiedades. */
                                    $usuario->setEmail($_POST['email_original']);
                                    $usuario->setContraseña($_POST['contraseña_original']);
                                }
                            } else {
                                /** Si se ha modificado el email del usuario se ha de
                                  comprobar si existe algún usuario con ese email. */
                                if (!$usuario->existeUsuario()) {
                                    /** No existe ningún usuario con ese email. */
                                    if ($usuario->modificaUsuario($_POST['email_original'])) {
                                        /** Actualiza los valores en la varible de sesión. */
                                        $_SESSION['usuario']->setEmail($_POST['email']);
                                        $_SESSION['usuario']->setContraseña($_POST['contraseña']);
                                        $_SESSION['usuario']->setNombre($_POST['nombre']);
                                        $_SESSION['usuario']->setSexo($_POST['sexo']);
                                        $_SESSION['usuario']->setFechaNacimiento($fechaNacimiento);
                                        /** Datos del usuario modificados correctamente. */
                                        echo '<h4>Los datos del usuario han sido modificado con éxito</h4>';
                                        echo '<input class="boton" type="submit"
                                       value="Volver">';
                                    } else {
                                        /** Error al modificar los datos del usuario. */
                                        echo '<h5>Error al modificar los datos del usuario</h5>';
                                        /** Se reestablecen los valores iniciales de las propiedades. */
                                        $usuario->setEmail($_POST['email_original']);
                                        $usuario->setContraseña($_POST['contraseña_original']);
                                    }
                                } else {
                                    /** Ya existe un usuario con ese email. */
                                    echo '<h5>No es posible modificar los datos del usuario
									<br>Existe otro usuario con el mismo email</h5>';
                                    $usuario->setEmail($_POST['email_original']);
                                    $usuario->setContraseña($_POST['contraseña_original']);
                                }
                            }
                        } else {
                            /** Error en el email o en la contraseaña. */
                            echo '<h5>No es posible modificar el usuario</h5>';
                        }
                    }
                    /** Si se ha seleccionado el botón Eliminar. */
                    if (isset($_POST['eliminar'])) {
                        /** Comprueba si se ha cambiado algún dato del formulario. */
                        if (($_POST['email'] == $_POST['email_original']) &&
                                ($_POST['contraseña'] == $_POST['contraseña_original']) &&
                                ($_POST['nombre'] == $_SESSION['usuario']->getNombre()) &&
                                ($_POST['sexo'] == $_SESSION['usuario']->getSexo()) &&
                                ($_POST['fechaNacimiento'] == $_SESSION['usuario']->getFechaNacimiento()->format('d/m/Y'))) {
                            echo '<h4>El usuario está siendo eliminado</h4>';
                            /** Muestra un formulario de confirmación. */
                            ?>
                            <div class="container mt-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <form action="eliminaUsuario.php" method="post">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title">¿Estás seguro de querer eliminar tu cuenta?</h5>
                                                    <input type="hidden" name="idUsuario" value="<?php echo $_POST['idUsuario']; ?>">
                                                    <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
                                                    <input type="hidden" name="contraseña" value="<?php echo $_POST['contraseña']; ?>">
                                                    <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
                                                    <input type="hidden" name="sexo" value="<?php echo $_POST['sexo']; ?>">
                                                    <input type="hidden" name="fechaNacimiento" value="<?php echo $_POST['fechaNacimiento']; ?>">
                                                    <button class="btn btn-danger" type="submit" name="eliminar">Eliminar</button>
                                                    <button class="btn btn-secondary" type="button" onClick="javascript:window.history.back();">Cancelar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                <?php
            } else {
                echo '<h5>No es posible eliminar el usuario
							<br>Se han modificado sus datos</h5>';
            }
        }
    } else {
        /** Si algún campo del formulario no está inicializado... */
        if (isset($_POST['email']) || isset($_POST['contraseña']) ||
                isset($_POST['nombre']) || isset($_POST['sexo']) ||
                isset($_POST['fechaNacimiento'])) {
            echo "<h5>Todos los campos son obligatorios</h5>";
            echo '<nav><a href="javascript:window.history.back();">
							Volver a la página anterior</a></nav>';
        } else {
            /** Muestra el formulario de gestión de sus datos. */
            //var_dump($_SESSION['usuario']);
            ?>
                        <div class="container mt-5">
                            <div class="row">
                                <!-- Formulario de Modificación -->
                                <div class="col-md-6">
                                    <h4 class="mb-3">Modificar Usuario</h4>
                                    <form action="modificaUsuario.php" method="post">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">IdUsuario:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="idUsuario" class="form-control" value="<?php echo $_SESSION['usuario']->getIdUsuario(); ?>">
                                            </div>
                                        </div>                                    
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Email:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['usuario']->getEmail(); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Contraseña:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="contraseña" class="form-control" value="<?php echo $_SESSION['usuario']->getContraseña(); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nombre:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nombre" class="form-control" value="<?php echo $_SESSION['usuario']->getNombre(); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Sexo:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="sexo" class="form-control" value="<?php echo $_SESSION['usuario']->getsexo(); ?>">
                                            </div>
                                        </div>       
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Fecha de Nacimiento:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="fechaNacimiento" class="form-control" value="<?php echo $_SESSION['usuario']->getFechaNacimiento()->format('d/m/Y'); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12 text-center">
                                                <input type="hidden" name="email_original" value="<?php echo $_SESSION['usuario']->getEmail(); ?>">
                                                <input type="hidden" name="contraseña_original" value="<?php echo $_SESSION['usuario']->getContraseña(); ?>">
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
        }
    }
} else {
    /** El usuario no ha sido validado. */
    echo "<h5>El usuario no ha sido validado correctamente</h5>";
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
                        <li><img src="#" alt=""title=""></li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="js/project.js"></script>
    </body>

</html>
