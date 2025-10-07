<?php

/**
 * bdusuario.php
 * Módulo secundario que implementa la clase BDUsuarios.
 */
/** Incluye la clase. */
include_once 'bdgestion.php';

/**
 * Declaración de la clase BDUsuarios
 */
class BDUsuarioExtendido extends BDGestion {

    /**
     * @var int Identificador del usuario.
     * @access private 
     */
    private int $idUsuarioExtendido;

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
    public function setIdUsuarioExtendido(int $idUsuarioExtendido): void {
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
    public function getIdUsuarioExtendido(): int {
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
     * Método que lee los datos de un usuario a partir de su idUsuario.
     * 
     * @access public
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function leeUsuarioExtendido(): array {
                /** @var array[]:array[]:string con los datos del usuarioExtendido. */
        $arrayUsuarioExtendido = array();
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
				 FROM UsuarioExtendido
				 WHERE idUsuarioExtendido = :idUsuarioExtendido"
                    );
            /** Vincula los parámetros al nombre de variable especificado. */                      
            $resultado->bindParam(':idUsuarioExtendido', $this->idUsuarioExtendido);
            //var_dump($resultado);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Comprueba que existan datos. */
                if ($resultado->rowcount() > 0) {
                    /** Rellenar al array con los datos de las tareas. */
                    $arrayUsuarioExtendido = $resultado->fetchAll();
                    //var_dump($arrayUsuarioExtendido);
                }
            }
        }
        /** Devuelve el array con los datos del usuarioExtendido. */
        return $arrayUsuarioExtendido;
    }

    /**
     * Método que comprueba si existe el usuario en la base de datos.
     *
     * @access public
     * @return boolean True si existe el email del usuario y False en otro caso
     */
    public function insertaUsuarioExtendido(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** @var PDOStatement Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "INSERT INTO UsuarioExtendido (idUsuarioExtendido, foto, estado, redes, informacion)
					VALUES (:idUsuarioExtendido, :foto, :estado, :redes, :informacion)");
            /** Vincula un parámetro al nombre de variable especificado. */
            $resultado->bindParam(':idUsuarioExtendido', $this->idUsuarioExtendido);
            $resultado->bindParam(':foto', $this->foto);
            $resultado->bindParam(':estado', $this->estado);
            $resultado->bindParam(':redes', $this->redes);
            $resultado->bindParam(':informacion', $this->informacion);

            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Devueve True si se ha conseguido. */
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
     * @param string $emailOriginal Valor inicial del email del usuario.
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function modificaUsuarioExtendido(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "UPDATE UsuarioExtendido
					 SET foto = :foto,
						estado = :estado,
						redes = :redes,
                                                informacion = :informacion
					 WHERE idUsuarioExtendido = :idUsuarioExtendido");
            /** Vincula los parámetros a los nombre de variables especificado. */
            $resultado->bindParam(':idUsuarioExtendido', $this->idUsuarioExtendido);
            $resultado->bindParam(':foto', $this->foto);
            $resultado->bindParam(':estado', $this->estado);
            $resultado->bindParam(':redes', $this->redes);
            $resultado->bindParam(':informacion', $this->informacion);

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
    public function eliminaUsuarioExtendido(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "DELETE FROM UsuarioExtendido
					 WHERE idUsuarioExtendido = :idUsuarioExtendido");
            /** Vincula un parámetro al nombre de variable especificado. */
            $resultado->bindParam(':idUsuarioExtendido', $this->idUsuarioExtendido);
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
