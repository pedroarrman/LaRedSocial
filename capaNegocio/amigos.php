<?php

/**
 * candidato.php
 * Módulo secundario que implementa la clase Candidato.
 */
/** Incluye la clase. */
include_once '../capaDatos/bdamigos.php';

/**
 * Declaración de la clase Empresa
 */
class Amigos {

    /**
     * @var string Dirección de correo electrónico de la empresa.
     * @access private
     */
    private Peticiones $idAmigo;

    /**
     * @var string contraseña de la empresa.
     * @access private
     */
    private Usuario $codUsuario1;

    /**
     * @var string denominación social de la empresa.
     * @access private
     */
    private Usuario $codUsuario2;

    /**
     * @var string sitio web de la empresa.
     * @access private
     */
    private DateTime $fechaAmistad;

    /**
     * 
     * @param Peticiones $idAmigo
     * @return void
     */
    public function setIdAmigo(Peticiones $idAmigo): void {
        $this->idAmigo = $idAmigo;
    }

    /**
     * 
     * @param Usuario $codUsuario1
     * @return void
     */
    public function setCodUsuario1(Usuario $codUsuario1): void {
        $this->codUsuario1 = $codUsuario1;
    }

    /**
     * 
     * @param Usuario $codUsuario2
     * @return void
     */
    public function setCodUsuario2(Usuario $codUsuario2): void {
        $this->codUsuario2 = $codUsuario2;
    }

    /**
     * 
     * @param Peticiones $fechaAmistad
     * @return void
     */
    public function setFechaAmistad(DateTime $fechaAmistad): void {
        $this->fechaAmistad = $fechaAmistad;
    }

    /**
     * 
     * @return Peticiones
     */
    public function getIdAmigo(): Peticiones {
        return $this->idAmigo;
    }

    /**
     * 
     * @return Usuario
     */
    public function getCodUsuario1(): Usuario {
        return $this->codUsuario1;
    }

    /**
     * 
     * @return Usuario
     */
    public function getCodUsuario2(): Usuario {
        return $this->codUsuario2;
    }

    /**
     * 
     * @return Peticiones
     */
    public function getFechaAmistad(): DateTime {
        return $this->fechaAmistad;
    }

    /**
     * Método que comprueba si existe la oferta.
     *
     * @access public
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function existeAmigo(): bool {
        /** @var BDOferta Instancia un objeto de la clase. */
        $bdamigos = new BDAmigos();
        /** Inicializa los atributos del objeto. */
        $bdamigos->setIdAmigo($this->idAmigo->getIdAmistad());
        $bdamigos->setCodUsuario1($this->codUsuario1->getIdUsuario());
        $bdamigos->setCodUsuario2($this->codUsuario2->getIdUsuario());
        $bdamigos->setFechaAmistad($this->fechaAmistad);
        /** Comprueba si existe la oferta. */
        if ($bdamigos->existeAmigo()) {
            /** La oferta existe. */
            return true;
        }
        /** La oferta no existe. */
        return false;
    }

    /**
     * Método que añade una nueva realación ofertaCandidato.
     *
     * @access public
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function insertaAmigo(): bool {
        /** @var BDOfertaCandidato Instancia un objeto de la clase. */
        $bdamigos = new BDAmigos();
        /** Inicializa los atributos del objeto. */
        $bdamigos->setIdAmigo($this->idAmigo->getIdAmistad());
        $bdamigos->setCodUsuario1($this->codUsuario1->getIdUsuario());
        $bdamigos->setCodUsuario2($this->codUsuario2->getIdUsuario());
        $bdamigos->setFechaAmistad($this->fechaAmistad);
        // var_dump($bdofertaCandidato);
        /** Inserta una nueva relacion oferta candidato y comprueba un posible error. */
        if ($bdamigos->insertaAmigo()) {
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
    public function leeAmigos(): array {
        /** @var array[]:Tarea Array de objetos de tipo Tarea. */
        $arrayAmigos = array();
        /** @var BDEmpresa Instancia un objeto de la clase. */
        $bdamigos= new BDAmigos();
        /** Busca los atributos del usuario. */
        foreach ($bdamigos->leeamigos() as $valor) {
            $this->setIdAmigo($valor['idAmigo']);
            
            $usuario1 = new Usuario();
            $usuario1->setIdUsuario($valor['codUsuario1']);
            $usuario1->leeUsuario();
            $this->setCodUsuario1($usuario1);
            
            $usuario2 = new Usuario();
            $usuario2->setIdUsuario($valor['codUsuario2']);
            $usuario2->leeUsuario();
            $this->setCodUsuario2($usuario2);            
            $this->setFechaAmistad(new DateTime($valor['fechaAmistad']));
            $arrayAmigos[] = clone $this;
        }

        /** Devuelve el array de candidatos. */
        return $arrayAmigos;
    }
    
    /**
     * Método que muestra todos los datos del candidato almacenado.
     *
     * @access public
     * @return Candidato[] Array de objetos de tipo Candidato.
     */
    public function leeAmigo(): array {
        /** @var array[]:Oferta Array de objetos de tipo Oferta. */
        $arrayAmigos = array();
        /** @var BDTarea Instancia un objeto de la clase. */
        $bdamigos = new BDAmigos();
        
        /** Inicializa el array de objetos Tarea. */
        foreach ($bdamigos->leeAmigo() as $valor) {

            $this->setIdAmigo($valor ['idAmigo']);

            $usuario1 = new Usuario();
            $usuario1->setIdUsuario($valor['codUsuario1']);
            $usuario1->leeUsuario();
            $this->setCodUsuario1($valor [$usuario1]);
            
            $usuario2 = new Usuario();
            $usuario2->setIdUsuario($valor['codUsuario2']);
            $usuario2->leeUsuario();
            $this->setCodUsuario2($valor[$usuario2]);
            $this->setFechaAmistad(new DateTime($valor['fechaAmistad']));

            $arrayAmigos[] = clone $this;
        }
        /** Devuelve el array. */
        return $arrayAmigos;
    }
    
    /**
     * Método que elimina una relacion oferta candidato.
     *
     * @access public
     * @return boolean	True en caso afirmativo
     * 					False en caso contrario.
     */
    public function eliminaAmigo(): bool {
        /** @var BDOfertaCandidato Instancia un objeto de la clase. */
        $bdamigos = new BDAmigos();
        /** Inicializa los atributos del objeto. */
        $bdamigos->setIdAmigo($this->idAmigo->getIdAmistad());
        /** Elimina un usuario y comprueba un posible error. */
        if ($bdamigos->eliminaAmigo()) {
            return true;
        }
        return false;
    }
}
