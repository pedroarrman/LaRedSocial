<?php

/**
 * bdusuario.php
 * Módulo secundario que implementa la clase BDUsuarios.
 */
/** Incluye la clase. */
include 'bdgestion.php';

/**
 * Declaración de la clase BDUsuarios
 */
class BDUsuario extends BDGestion {

    /**
     * @var int Identificador del usuario.
     * @access private 
     */
    private int $idUsuario;

    /**
     * @var string Dirección de correo electrónico del usuario.
     * @access private
     */
    private string $email;

    /**
     * @var string Contraseña del usuario.
     * @access private
     */
    private string $contraseña;

    /**
     * @var string Nombre completo del usuario.
     * @access private
     */
    private string $nombre;

    /**
     * 
     * @var DateTime fecha de nacimiento del usuario.
     * @access private
     */
    private DateTime $fechaNacimiento;

    /**
     * @var string sexo del usuario.
     * @access private
     */
    private string $sexo;

    /**
     * Método que inicializa el atributo $idUsuario.
     * 
     * @access public
     * @param int $idUsuario Identificador del usuario.
     * @return void 
     */
    public function setIdUsuario(int $idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    /**
     * Método que inicializa el atributo email.
     *
     * @access public
     * @param string $email Nombre del usuario.
     * @return void
     */
    public function setEmail($email): void {
        $this->email = $email;
    }

    /**
     * Método que inicializa el atributo contraseña.
     *
     * @access public
     * @param string $contraseña Nombre del usuario.
     * @return void
     */
    public function setContraseña($contraseña): void {
        $this->contraseña = $contraseña;
    }

    /**
     * Método que inicializa el atributo nombre.
     *
     * @access public
     * @param string $nombre Nombre del usuario.
     * @return void
     */
    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * 
     * @param DateTime $fechaNacimiento
     * @return void
     */
    public function setFechaNacimiento(DateTime $fechaNacimiento): void {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * Método que inicializa el atributo sexo.
     *
     * @access public
     * @param string $sexo del usuario.
     * @return void
     */
    public function setSexo(string $sexo): void {
        $this->sexo = $sexo;
    }

    /**
     * Método que devuelve el valor del atributo $IdUsuario.
     *
     * @access public
     * @return int Identificador del usuario.
     */
    public function getIdUsuario(): int {
        return $this->idUsuario;
    }

    /**
     * Método que devuelve el valor del atributo email.
     *
     * @access public
     * @return string Email del usuario.
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Método que devuelve el valor del atributo contraseña.
     *
     * @access public
     * @return string Contraseña del usuario.
     */
    public function getContraseña(): string {
        return $this->contraseña;
    }

    /**
     * Método que devuelve el valor del atributo nombre.
     *
     * @access public
     * @return string Nombre completo del usuario.
     */
    public function getNombre(): string {
        return $this->nombre;
    }

    /**
     * 
     * @return DateTime
     */
    public function getFechaNacimiento(): DateTime {
        return $this->fechaNacimiento;
    }

    /**
     * Método que devuelve el valor del atributo estado.
     *
     * @access public
     * @return string Estado del usuario.
     */
    public function getSexo(): string {
        return $this->sexo;
    }

    /**
     * Método que comprueba si existe el usuario en la base de datos.
     *
     * @access public
     * @return boolean True si existe el email del usuario y False en otro caso
     */
    public function existeUsuario(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** @var PDOStatement Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
					FROM Usuario
					WHERE email = :email");
            /** Vincula un parámetro al nombre de variable especificado. */
            $resultado->bindParam(':email', $this->email);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Comprueba que el número de filas sea 1. */
                if ($resultado->rowCount() === 1) {
                    /** Existe el email del usuario. */
                    return true;
                }
            }
        }
        /** No existe el email del usuario. */
        return false;
    }

    /**
     * Método que valida un usuario en la base de datos.
     *
     * @access public
     * @return boolean True si existe y False en otro caso
     */
    public function validaUsuario(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare("
				SELECT *
				FROM Usuario
				WHERE email = :email AND contraseña = :contrasena");
            /** Vincula un parámetro al nombre de variable especificado. */
            $resultado->bindParam(':email', $this->email);
            $resultado->bindParam(':contrasena', $this->contraseña);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            $resultado->execute();
            /** Comprueba que el número de filas sea 1. */
            if ($resultado->rowCount() === 1) {
                /** Accede a los valores obtenidos. */
                $fila = $resultado->fetch();
                /** Inicializa los atributos del objeto. */
                $this->idUsuario = $fila['idUsuario'];
                $this->email = $fila['email'];
                $this->contraseña = $fila['contraseña'];
                $this->nombre = $fila['nombre'];
                $this->fechaNacimiento = DateTime::createFromFormat('Y-m-d', $fila['fechaNacimiento']);
                $this->sexo = $fila['sexo'];
                /** Existe el usuario. */
                return (true);
            }
        }
        /** No existe el usuario. */
        return (false);
    }

    /**
     * Método que lee todos los datos de los usuarios.
     * 
     * @access public
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function leeUsuarios(): array {
        $arrayUsuarios = array();
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
				 FROM Usuario");
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Comprueba que existan datos. */
                if ($resultado->rowcount() > 0) {
                    /** Rellenar al array con los datos de los usuarios. */
                    $arrayUsuarios = $resultado->fetchAll();
                    //var_dump($arrayUsuarios);
                }
            }
        }
        /** Devuelve el array con los datos de los usuarios. */
        return $arrayUsuarios;
    }

    /**
     * Método que lee los datos de un usuario a partir de su idUsuario.
     * 
     * @access public
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function leeUsuario(): array {
        $arrayUsuarios = array();
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
				 FROM Usuario
				 WHERE idUsuario = :idUsuario");
            /** Vincula los parámetros al nombre de variable especificado. */
            $resultado->bindParam(':idUsuario', $this->idUsuario);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Comprueba que existan datos. */
                if ($resultado->rowcount() > 0) {
                    /** Rellenar al array con los datos de las tareas. */
                    $arrayUsuarios = $resultado->fetchAll();
                    //var_dump($arrayUsuarios);
                }
            }
        }
        /** Devuelve el array con los datos del usuario. */
        return $arrayUsuarios;
    }

    /**
     * Método que inserta un nuevo usuario en la base de datos
     *
     * @access public
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function altaUsuario(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "INSERT INTO Usuario (email, contraseña, nombre, fechaNacimiento, sexo)
					VALUES (:email, :contrasena, :nombre, :fechaNacimiento, :sexo)");
            /** Vincula un parámetro al nombre de variable especificado. */
            $resultado->bindParam(':email', $this->email);
            $resultado->bindParam(':contrasena', $this->contraseña);
            $resultado->bindParam(':nombre', $this->nombre);
            $fecha = $this->fechaNacimiento->format('Y-m-d');
            $resultado->bindParam(':fechaNacimiento', $fecha);
            $resultado->bindParam(':sexo', $this->sexo);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Devuelve true si se ha conseguido. */
                return true;
            }
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }

    /**
     * Método que elimina un usuario existente de la base de datos.
     *
     * @access public
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function eliminaUsuario(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "DELETE FROM Usuario
					 WHERE idUsuario = :idUsuario");
            /** Vincula un parámetro al nombre de variable especificado. */
            $resultado->bindParam(':idUsuario', $this->idUsuario);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Devuelve true si se ha conseguido. */
                return true;
            }
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }

    /**
     * Método que modifica los campos de un usuario de la base de datos.
     *
     * @access public
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function modificaUsuario(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "UPDATE Usuario
					 SET email = :email,
						contraseña = :contrasena,
						nombre = :nombre,
                                                fechaNacimiento = :fechaNacimiento,
                                                sexo = :sexo
					 WHERE idUsuario = :idUsuario");
            /** Vincula los parámetros a los nombre de variables especificado. */
            $resultado->bindParam(':idUsuario', $this->idUsuario);
            $resultado->bindParam(':email', $this->email);
            $resultado->bindParam(':contrasena', $this->contraseña);
            $resultado->bindParam(':nombre', $this->nombre);
            $fecha = $this->fechaNacimiento->format('Y-m-d'); // Formatea la fecha correctamente
            $resultado->bindParam(':fechaNacimiento', $fecha);
            $resultado->bindParam(':sexo', $this->sexo);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Devuelve true si se ha conseguido. */
                return true;
            }
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }
}
