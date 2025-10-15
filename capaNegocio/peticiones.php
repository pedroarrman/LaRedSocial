<?php

/**
 * usuario.php
 * Módulo secundario que implementa la clase Usuario.
 */
/** Incluye la clase. */
include '../capaDatos/bdpeticiones.php';

/**
 * Declaración de la clase Usuario
 */
class Peticiones {

    /**
     * @var int Identificador del usuario.
     * @access private 
     */
    private int $idAmistad;

    /**
     * @var string Dirección de correo electrónico del usuario.
     * @access private
     */
    private Usuario $idUsuario1;

    /**
     * @var string Contraseña del usuario.
     * @access private
     */
    private Usuario $idUsuario2;

    /**
     * @var string Nombre completo del usuario.
     * @access private
     */
    private string $estado;

    /**
     * 
     * @var DateTime fechaNacimiento del usuario
     */
    private DateTime $fechaSolicitud;

    /**
     * 
     * @param int $idAmistad
     * @return void
     */
    public function setIdAmistad(int $idAmistad): void {
        $this->idAmistad = $idAmistad;
    }

    /**
     * 
     * @param int $idUsuario1
     * @return void
     */
    public function setIdUsuario1(Usuario $idUsuario1): void {
        $this->idUsuario1 = $idUsuario1;
    }

    /**
     * 
     * @param int $idUsuario2
     * @return void
     */
    public function setIdUsuario2(Usuario $idUsuario2): void {
        $this->idUsuario2 = $idUsuario2;
    }

    /**
     * 
     * @param Enum $estado
     * @return void
     */
    public function setEstado(string $estado): void {
        $this->estado = $estado;
    }

    /**
     * 
     * @param DateTime $fechaSolicitud
     * @return void
     */
    public function setFechaSolicitud(DateTime $fechaSolicitud): void {
        $this->fechaSolicitud = $fechaSolicitud;
    }

    /**
     * 
     * @param Usuario $usuario
     * @return void
     */
    public function setUsuario(Usuario $usuario): void {
        $this->usuario = $usuario;
    }

    /**
     * 
     * @return int
     */
    public function getIdAmistad(): int {
        return $this->idAmistad;
    }

    /**
     * 
     * @return int
     */
    public function getIdUsuario1(): Usuario {
        return $this->idUsuario1;
    }

    /**
     * 
     * @return int
     */
    public function getIdUsuario2(): Usuario {
        return $this->idUsuario2;
    }

    /**
     * 
     * @return Enum
     */
    public function getEstado(): string {
        return $this->estado;
    }

    /**
     * 
     * @return DateTime
     */
    public function getFechaSolicitud(): DateTime {
        return $this->fechaSolicitud;
    }


    /**
     * Método que añade un nuevo usuario.
     *
     * @access public
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function enviarPeticion(): bool {
        /** @var BDAmistadess Instancia un objeto de la clase. */
        $bdpeticiones = new BDPeticiones();
        /** Inicializa los atributos del objeto. */
        $bdpeticiones->setIdUsuario1($this->idUsuario1->getIdUsuario());
        $bdpeticiones->setIdUsuario2($this->idUsuario2->getIdUsuario());
        $bdpeticiones->setEstado($this->estado);
        $bdpeticiones->setFechaSolicitud($this->fechaSolicitud);

        /** Inserta un nuevo usuario y comprueba un posible error. */
        if ($bdpeticiones->enviarPeticion()) {
            /** Devuelve true si se ha conseguido. */
            return true;
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }

    /**
     * Método que comprueba si existe la oferta.
     *
     * @access public
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function existePeticion(): bool {
        /** @var BDOferta Instancia un objeto de la clase. */
        $bdpeticiones = new BDPeticiones();
        /** Inicializa los atributos del objeto. */
        $bdpeticiones->setIdUsuario1($this->idUsuario1->getIdUsuario());
        $bdpeticiones->setIdUsuario2($this->idUsuario2->getIdUsuario());
        $bdpeticiones->setEstado($this->estado);
        $bdpeticiones->setFechaSolicitud($this->fechaSolicitud);
        /** Comprueba si existe la oferta. */
        if ($bdpeticiones->existePeticion()) {
            /** La oferta existe. */
            return true;
        }
        /** La oferta no existe. */
        return false;
    }

    /**
     * Método que muestra todos los datos del candidato almacenado.
     *
     * @access public
     * @return Candidato[] Array de objetos de tipo Candidato.
     */
    public function leePeticiones(): array {
        /** @var array[]:Tarea Array de objetos de tipo Tarea. */
        $arraySolicitudes = array();
        /** @var BDEmpresa Instancia un objeto de la clase. */
        $bdpeticiones = new BDPeticiones();
        /** Busca los atributos del usuario. */
        foreach ($bdpeticiones->leePeticiones() as $valor) {
            $this->setIdAmistad($valor['idAmistad']);
            
            $usuario1 = new Usuario();
            $usuario1->setIdUsuario($valor['idUsuario1']);
            $usuario1->leeUsuario();
            $this->setIdUsuario1($usuario1);
            
            $usuario2 = new Usuario();
            $usuario2->setIdUsuario($valor['idUsuario2']);
            $usuario2->leeUsuario();
            $this->setIdUsuario2($usuario2);
            
            $this->setEstado($valor['estado']);
            $this->setFechaSolicitud(new DateTime($valor['fechaSolicitud']));
            $arraySolicitudes[] = clone $this;
        }

        /** Devuelve el array de candidatos. */
        return $arraySolicitudes;
    }

    /**
     * Método que muestra todos los datos del candidato almacenado.
     *
     * @access public
     * @return Candidato[] Array de objetos de tipo Candidato.
     */
    public function leePeticion(): array {
        /** @var array[]:Oferta Array de objetos de tipo Oferta. */
        $arrayPeticion = array();
        /** @var BDTarea Instancia un objeto de la clase. */
        $bdpeticiones = new BDPeticiones();
        
        /** Inicializa el array de objetos Tarea. */
        foreach ($bdpeticiones->leePeticion() as $valor) {

            $this->setIdAmistad($valor ['idAmistad']);

            $usuario1 = new Usuario();
            $usuario1->setIdUsuario($valor['idUsuario1']);
            $usuario1->leeUsuario();
            $this->setIdUsuario1($valor [$usuario1]);
            
            $usuario2 = new Usuario();
            $usuario2->setIdUsuario($valor['idUsuario2']);
            $usuario2->leeUsuario();
            $this->setIdUsuario2($valor[$usuario2]);
            
            $this->setEstado($valor['estado']);
            $this->setFechaSolicitud(new DateTime($valor['fechaSolicitud']));

            $arrayPeticion[] = clone $this;
        }
        /** Devuelve el array. */
        return $arrayPeticion;
    }
    /**
     * 
     * @return bool
     */
    public function modificaPeticion(): bool {
        
    $bdpeticiones = new BDPeticiones();
    /** */
    $bdpeticiones->setIdAmistad($this->idAmistad);
    $bdpeticiones->setIdUsuario1($this->idUsuario1);
    $bdpeticiones->setIdUsuario2($this->idUsuario2);
    $bdpeticiones->setEstado($this->estado);
    $bdpeticiones->setFechaSolicitud($this->fechaSolicitud);
    
    if($bdpeticiones->modificaPeticion()){
        return true;
    }
    return false;
    }
    
     /**
     * Método que modifica los datos de un usuario.
     *
     * @access public
     * @param string $emailOriginal Email original del usuario.
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function eliminaPeticion(): bool {
        /** @var BDAmistadess Instancia un objeto de la clase. */
        $bdpeticiones = new BDPeticiones();
        /** Inicializa los atributos del objeto. */
        $bdpeticiones->setIdAmistad($this->idAmistad);
        /** Modifica los datos del usuario y comprueba un posible error. */
        if ($bdpeticiones->eliminaPeticion()) {
            /** Devuelve true si se ha conseguido. */
            return true;
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }

}


