<?php

/**
 * usuario.php
 * Módulo secundario que implementa la clase Usuario.
 */
/** Incluye la clase. */
include '../capaDatos/bdusuario.php';

/**
 * Declaración de la clase Usuario
 */
class Usuario {

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
     * @var DateTime fechaNacimiento del usuario
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
     * Método que inicializa el atributo $email.
     *
     * @access public
     * @param string $email Email del usuario.
     * @return array[]:string Array de errores.
     */
    public function setEmail(string $email): array {
        /** @var array[]:string  Array vacío, supone que no hay errores. */
        $error = array();
        /** @var string Sanea la dirección de correo. */
        $emailSaneado = filter_var($email, FILTER_SANITIZE_EMAIL);
        /** Valida la dirección de correo. */
        if (!filter_var($emailSaneado, FILTER_VALIDATE_EMAIL)) {
            /** Almacena el error en al array de errores. */
            $error[] = 'El email no es posible sanearlo y debe tener un formato válido';
        }
        /** Comprueba si no hay errores. */
        if (!$error) {
            /** Inicializa el valor de la propiedad. */
            $this->email = $emailSaneado;
        }
        /** Devuelve el array de errores. */
        return $error;
    }

    /**
     * Método que inicializa el atributo contraseña.
     *
     * @access public
     * @param string $contraseña Contraseña del usuario.
     * @return array[]:string Array de errores.
     */
    public function setContraseña(string $contraseña): array {
        /** @var array[]:string  Array vacío, supone que no hay errores. */
        $error = array();
        /** Comprueba la longitud de la contraseña. */
        if (strlen($contraseña) < 4 || strlen($contraseña) > 15) {
            /** Almacena el error en al array de errores. */
            $error[] = 'La Contraseña debe tener entre 4 y 15 caracteres';
        }
        /** Comprueba que todos los caracteres sean alfanuméricos. */
        if (!ctype_alnum($contraseña)) {
            /** Almacena el error en al array de errores. */
            $error[] = 'La Contraseña debe tener sólo caracteres alfanuméricos';
        }
        /** @var boolean Bandera de control de que al menos haya una letra mayúscula. */
        $errorMayuscula = false;
        /** @var integer Posición inicial del string. */
        $i = 0;
        /** Recorre el string comprobando uno a uno todos los caracteres,
         *  hasta que se encuentra un error o hasta el final si no hay error. */
        while ($i < strlen($contraseña) && !$errorMayuscula) {
            /** Comprueba que contiene al menos una letra mayúscula. */
            if (ctype_upper($contraseña[$i])) {
                /** Existe una letra mayúscula. */
                $errorMayuscula = true;
            }
            /** Avanza a la siguiente posición del string. */
            $i++;
        }
        /** Comprueba si no contiene al menos una letra mayúscula. */
        if (!$errorMayuscula) {
            /** Almacena el error en al array de errores. */
            $error[] = 'La Contraseña debe tener al menos una letra mayúscula';
        }
        /** Comprueba si no hay errores. */
        if (!$error) {
            /** Inicializa el valor de la propiedad. */
            $this->contraseña = $contraseña;
        }
        /** Devuelve el indicador de error. */
        return ($error);
    }

    /**
     * Método que inicializa el atributo $nombre.
     *
     * @access public
     * @param string $nombre Nombre del usuario.
     * @return void
     */
    public function setNombre(string $nombre): void {
        /** Inicializa la propiedad. */
        $this->nombre = $nombre;
    }

    /**
     * Método que inicializa el atributo $fechaNacimiento.
     *
     * @access public
     * @param string $fechaNacimiento Fecha de nacimiento del usuario.
     * @return void
     */
    public function setFechaNacimiento(DateTime $fechaNacimiento): void {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * Método que inicializa el atributo $sexo.
     *
     * @access public
     * @param string $sexo sexo del usuario.
     * @return void
     */
    public function setSexo(string $sexo): void {
        $this->sexo = $sexo;
    }

    /**
     * Método que devuelve el valor del atributo $idUsuario.
     *
     * @access public
     * @return int Identificador de la tarea.
     */
    public function getIdUsuario(): int {
        return $this->idUsuario;
    }

    /**
     * Método que devuelve el valor del atributo $email.
     *
     * @access public
     * @return string Email del usuario.
     */
    public function getEmail(): string {
        /** Devuelve el valor de la propiedad. */
        return $this->email;
    }

    /**
     * Método que devuelve el valor del atributo $contraseña.
     *
     * @access public
     * @return string Contraseña del usuario.
     */
    public function getContraseña(): string {
        /** Devuelve el valor de la propiedad. */
        return $this->contraseña;
    }

    /**
     * Método que devuelve el valor del atributo $nombre.
     *
     * @access public
     * @return string Nombre del usuario.
     */
    public function getNombre(): string {
        /** Devuelve el valor de la propiedad. */
        return $this->nombre;
    }

    /**
     * Método que devuelve el valor del atributo $fechaNacimiento.
     *
     * @access public
     * @return DateTime Fecha de Nacimiento del usuario.
     */
    public function getFechaNacimiento(): DateTime {
        /** Devuelve el valor de la propiedad. */
        return $this->fechaNacimiento;
    }

    /**
     * Método que devuelve el valor del atributo $sexo.
     *
     * @access public
     * @return string estado del usuario.
     */
    public function getSexo(): string {
        return $this->sexo;
    }

    /**
     * Método que comprueba si existe el usuario.
     *
     * @access public
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function existeUsuario(): bool {
        /** @var BDUsuarios Instancia un objeto de la clase. */
        $bdusuario = new BDUsuario();
        /** Inicializa los atributos del objeto. */
        //$bdusuario->setIdUsuario($this->idUsuario);
        $bdusuario->setEmail($this->email);
        $bdusuario->setContraseña($this->contraseña);
        $bdusuario->setNombre($this->nombre);
        $bdusuario->setFechaNacimiento($this->fechaNacimiento);
        $bdusuario->setSexo($this->sexo);
        /** Comprueba si existe el usuario. */
        if ($bdusuario->existeUsuario()) {
            /** El usuario existe. */
            return true;
        }
        /** El usuario no existe. */
        return false;
    }

    /**
     * Método que añade un nuevo usuario.
     *
     * @access public
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function almacenaUsuario(): bool {
        /** @var BDUsuarios Instancia un objeto de la clase. */
        $bdusuario = new BDUsuario();
        /** Inicializa los atributos del objeto. */
        $bdusuario->setEmail($this->email);
        $bdusuario->setContraseña($this->contraseña);
        $bdusuario->setNombre($this->nombre);
        $bdusuario->setFechaNacimiento($this->fechaNacimiento);
        $bdusuario->setSexo($this->sexo);
        /** Inserta un nuevo usuario y comprueba un posible error. */
        if ($bdusuario->altaUsuario()) {
            /** Devuelve true si se ha conseguido. */
            return true;
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }

    /**
     * Método que valida un usuario.
     *
     * @access public
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function validaUsuario(): bool {
        /** @var BDUsuarios Instancia un objeto de la clase. */
        $bdusuario = new BDUsuario();
        /** Inicializa los atributos del objeto. */
        $bdusuario->setEmail($this->email);
        $bdusuario->setContraseña($this->contraseña);
        /** Comprueba si existe y gestiona un posible error. */
        if ($bdusuario->validaUsuario()) {
            /** Inicializa los atributos del objeto con los datos almacenados. */
            $this->nombre = $bdusuario->getNombre();
            $this->fechaNacimiento = $bdusuario->getFechaNacimiento();
            $this->idUsuario = $bdusuario->getIdUsuario();
            $this->sexo = $bdusuario->getSexo();
            $this->email = $bdusuario->getEmail();
            $this->contraseña = $bdusuario->getContraseña();
            /** Devuelve true si se ha conseguido. */
            return true;
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }

    /**
     * Método que muestra todos los datos del candidato almacenado.
     *
     * @access public
     * @return Candidato[] Array de objetos de tipo Candidato.
     */
    public function leeUsuarios(): array {
        /** @var array[]:Oferta Array de objetos de tipo Oferta. */
        $arrayUsuarios = array();
        /** @var BDTarea Instancia un objeto de la clase. */
        $bdusuario = new BDUsuario();
        /** Inicializa el array de objetos Tarea. */
        foreach ($bdusuario->leeUsuarios() as $valor) {
            $this->setIdUsuario($valor ['idUsuario']);
            $this->setEmail($valor ['email']);
            $this->setContraseña($valor['contraseña']);
            $this->setNombre($valor['nombre']);
            $this->setFechaNacimiento(new DateTime($valor['fechaNacimiento']));
            $this->setSexo($valor['sexo']);
            $usuario = new Usuario();
            $usuario->setIdUsuario($valor['idUsuario']);
            $usuario->leeUsuario();
            $arrayUsuarios[] = clone $this;
        }
        /** Devuelve el array. */
        return $arrayUsuarios;
    }

    /**
     * Método que muestra todos los datos del candidato almacenado.
     *
     * @access public
     * @return Candidato[] Array de objetos de tipo Candidato.
     */
    public function leeUsuario(): array {
        /** @var array[]:Tarea Array de objetos de tipo Tarea. */
        $arrayUsuarios = array();
        /** @var BDEmpresa Instancia un objeto de la clase. */
        $bdusuario = new BDUsuario();
        /** Inicializa el atributo. */
        $bdusuario->setIdUsuario($this->idUsuario);

        /** Busca los atributos del usuario. */
        foreach($bdusuario->leeUsuario()as $valor){
            $this->setIdUsuario($valor['idUsuario']);
            $this->setEmail($valor['email']);
            $this->setContraseña($valor['contraseña']);
            $this->setNombre($valor['nombre']);
            $this->setFechaNacimiento(new DateTime($valor['fechaNacimiento']));
            $this->setSexo($valor['sexo']);
            
            $arrayUsuarios[] = clone $this;
        }

        /** Devuelve el array de candidatos. */
        return $arrayUsuarios;
    }

    /**
     * Método que modifica los datos de un usuario.
     *
     * @access public
     * @param string $emailOriginal Email original del usuario.
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function modificaUsuario(string $emailOriginal): bool {
        /** @var BDUsuarios Instancia un objeto de la clase. */
        $bdusuario = new BDUsuario();
        /** Inicializa los atributos del objeto. */
        $bdusuario->setIdUsuario($this->idUsuario);
        $bdusuario->setEmail($this->email);
        $bdusuario->setContraseña($this->contraseña);
        $bdusuario->setNombre($this->nombre);
        $bdusuario->setFechaNacimiento($this->fechaNacimiento);
        $bdusuario->setSexo($this->sexo);
        /** Modifica los datos del usuario y comprueba un posible error. */
        if ($bdusuario->modificaUsuario($emailOriginal)) {
            /** Devuelve true si se ha conseguido. */
            return true;
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }

    /**
     * Método que elimina un usuario.
     *
     * @access public
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function eliminaUsuario(): bool {
        /** @var BDUsuarios Instancia un objeto de la clase. */
        $bdusuario = new BDUsuario();
        /** Inicializa los atributos del objeto. */
        $bdusuario->setIdUsuario($this->idUsuario);
        /** Elimina un usuario y comprueba un posible error. */
        if ($bdusuario->eliminaUsuario()) {
            /** Devuelve true si se ha conseguido. */
            return true;
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }
}
