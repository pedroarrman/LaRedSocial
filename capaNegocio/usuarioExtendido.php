<?php

/*
 * 
 * 
 */
include_once '../capaDatos/bdusuarioExtendido.php';

/**
 * Declaración de la clase UsuarioExtendido
 */
class UsuarioExtendido {

    /**
     * 
     */
    private Usuario $idUsuarioExtendido;

    /**
     * 
     * @var string
     */
    private string $foto;

    /**
     * 
     * @var string
     */
    private string $estado;

    /**
     * 
     * @var string
     */
    private string $redes;

    /**
     * 
     * @var string
     */
    private string $informacion;

    /**
     * 
     * @param int $idUsuarioExtendido
     * @return void
     */
    public function setIdUsuarioExtendido(Usuario $idUsuarioExtendido): void {
        $this->idUsuarioExtendido = $idUsuarioExtendido;
    }

    /**
     * 
     * @param string $foto
     * @return void
     */
    public function setFoto(string $foto): void {
        $this->foto = $foto;
    }

    /**
     * 
     * @param string $estado
     * @return void
     */
    public function setEstado(string $estado): void {
        $this->estado = $estado;
    }

    /**
     * 
     * @param string $redes
     * @return void
     */
    public function setRedes(string $redes): void {
        $this->redes = $redes;
    }

    /**
     * 
     * @param string $informacion
     * @return void
     */
    public function setInformacion(string $informacion): void {
        $this->informacion = $informacion;
    }

    /**
     * 
     * @return int
     */
    public function getIdUsuarioExtendido(): Usuario {
        return $this->idUsuarioExtendido;
    }

    /**
     * 
     * @return string
     */
    public function getFoto(): string {
        return $this->foto;
    }

    /**
     * 
     * @return string
     */
    public function getEstado(): string {
        return $this->estado;
    }

    /**
     * 
     * @return string
     */
    public function getRedes(): string {
        return $this->redes;
    }

    /**
     * 
     * @return string
     */
    public function getInformacion(): string {
        return $this->informacion;
    }

    /**
     * 
     * @return Usuario
     */
    public function getUsuario(): Usuario {
        return $this->usuario;
    }

    public function leeUsuarioExtendido(): array {
        /** @var array[]:Oferta Array de objetos de tipo UsuarioExtendido. */
        $arrayUsuarioExtendido = array();
        /** @var BDUsuarioExtendido Instancia un objeto de la clase. */
        $bdusuarioExtendido = new BDUsuarioExtendido();
        /** Inicializa el atributo. */
        $bdusuarioExtendido->setIdUsuarioExtendido($this->idUsuarioExtendido->getIdUsuario());
        //var_dump($bdusuarioExtendido);
        /** Inicializa el array de objetos Tarea. */
        foreach ($bdusuarioExtendido->leeUsuarioExtendido() as $valor) {
            
            $usuario = new Usuario();
            $usuario->setIdUsuario($valor['idUsuarioExtendido']);
            $usuario->leeUsuario();
            $this->setIdUsuarioExtendido($usuario);
            
            $this->setFoto($valor['foto']);
            $this->setEstado($valor['estado']);
            $this->setRedes($valor['redes']);
            $this->setInformacion($valor['informacion']);           

            $arrayUsuarioExtendido[] = clone $this;
        }
        return $arrayUsuarioExtendido;
    }

    public function almacenaUsuarioExtendido(): bool {
        /** @var BDUsuarioExtendido Instancia un objeto de la clase. */
        $bdusuarioExtendido = new BDUsuarioExtendido();
        /** Inicializa los atributos del objeto. */
        $bdusuarioExtendido->setIdUsuarioExtendido($this->getIdUsuarioExtendido()->getIdUsuario());
        $bdusuarioExtendido->setFoto($this->foto);
        $bdusuarioExtendido->setEstado($this->estado);
        $bdusuarioExtendido->setRedes($this->redes);
        $bdusuarioExtendido->setInformacion($this->informacion);
        /** Inserta un nuevo usuario y comprueba un posible error. */
        if ($bdusuarioExtendido->insertaUsuarioExtendido()) {
            /** Devuelve true si se ha conseguido. */
            return true;
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }

    /**
     * Método que modifica un usuarioExtendido.
     *
     * @access public
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function modificaUsuarioExtendido(): bool {
        /** @var BDUsuarioExtendido Instancia un objeto de la clase. */
        $bdusuarioExtendido = new BDUsuarioExtendido();
        /** Inicializa los atributos del objeto. */
        $bdusuarioExtendido->setIdUsuarioExtendido($this->idUsuarioExtendido->getIdUsuario());
        $bdusuarioExtendido->setFoto($this->foto);
        $bdusuarioExtendido->setEstado($this->estado);
        $bdusuarioExtendido->setRedes($this->redes);
        $bdusuarioExtendido->setInformacion($this->informacion);
        
        /** Modifica los datos del usuario y comprueba un posible error. */
        if ($bdusuarioExtendido->modificaUsuarioExtendido()) {
            /** Devuelve true si se ha conseguido. */
            return true;
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }

    /**
     * Método que elimina un usuarioExtendido.
     *
     * @access public
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function eliminaUsuarioExtendido(): bool {
        /** @var BDUsuarioExtendido Instancia un objeto de la clase. */
        $bdusuarioExtendido = new BDUsuarioExtendido();
        /** Inicializa los atributos del objeto. */
        $bdusuarioExtendido->setIdUsuarioExtendido($this->idUsuarioExtendido);
        /** Elimina un usuario y comprueba un posible error. */
        if ($bdusuarioExtendido->eliminaUsuarioExtendido()) {
            /** Devuelve true si se ha conseguido. */
            return true;
        }
        /** Devuelve false si se ha producido un error. */
        return false;
    }
}
