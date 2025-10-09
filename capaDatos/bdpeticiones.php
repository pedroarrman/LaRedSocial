<?php

/**
 * bdpeticiones.php
 * Módulo secundario que implementa la clase BDAmistades.
 */
/** Incluye la clase. */
include_once 'bdgestion.php';

/**
 * Declaración de la clase BDUsuarios
 */
class BDPeticiones extends BDGestion {

    /**
     * @var int Identificador de la amistad.
     * @access private
     */
    private int $idAmistad;

    /**
     * @var string id del usuario 1.
     * @access private
     */
    private int $idUsuario1;

    /**
     * @var string id del usuario 2.
     * @access private
     */
    private int $idUsuario2;

    /**
     *
     * @var Enum estado de la peticion de amistad.
     * @access private
     */
    private string $estado;

    /**
     * @var DateTime fecha de solicitud de la peticion.
     * @access private
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
    public function setIdUsuario1(int $idUsuario1): void {
        $this->idUsuario1 = $idUsuario1;
    }

    /**
     * 
     * @param string $idUsuario2
     * @return void
     */
    public function setIdUsuario2(int $idUsuario2): void {
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
     * @return int
     */
    public function getIdAmistad(): int {
        return $this->idAmistad;
    }

    /**
     * 
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * 
     * @return int
     */
    public function getIdUsuario1(): int {
        return $this->idUsuario1;
    }

    /**
     * 
     * @return string
     */
    public function getIdUsuario2(): string {
        return $this->idUsuario2;
    }

    /**
     * 
     * @return Enum
     */
    public function getEstado(): Enum {
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
     * 
     * @return bool
     */
    public function enviarPeticion(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(""
                    . "INSERT into Peticiones(idUsuario1,idUsuario2, estado,fechaSolicitud)"
                    . "VALUES(:idUsuario1,:idUsuario2,:estado,:fechaSolicitud)");
            /** Vincula un parámetro al nombre de variable especificado. */
            $resultado->bindParam(':idUsuario1', $this->idUsuario1);
            $resultado->bindParam(':idUsuario2', $this->idUsuario2);
            $resultado->bindParam(':estado', $this->estado);
            $fecha = $this->fechaSolicitud->format('Y-m-d');
            $resultado->bindParam(':fechaSolicitud', $fecha);
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
     * Método que comprueba si existe la oferta en la base de datos.
     *
     * @access public
     * @return boolean True si existe el id de la oferta y False en otro caso
     */
    public function existePeticion(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** @var PDOStatement Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
FROM Peticiones
WHERE idUsuario1 = :idUsuario1 AND idUsuario2 = :idUsuario2");
            /** Vincula un parámetro al nombre de variable especificado. */
            $resultado->bindParam(':idUsuario1', $this->idUsuario1);
            $resultado->bindParam(':idUsuario2', $this->idUsuario2);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Comprueba que el número de filas sea 1. */
                if ($resultado->rowCount() === 1) {
                    /** Existe la oferta en la base de datos. */
                    return true;
                }
            }
        }
        /** No existe la oferta en la base de datos. */
        return false;
    }

    /**
     * Método que comprueba si existe el usuario en la base de datos.
     *
     * @access public
     * @return boolean True si existe el email del usuario y False en otro caso
     */
    public function leePeticiones(): array {
        /** @var array[]:Tarea Array de objetos de tipo Tarea. */
        $arraySolicitudes = array();
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** @var PDOStatement Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
					FROM Peticiones");
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Comprueba que existan datos. */
                if ($resultado->rowcount() > 0) {
                    /** Rellenar al array con los datos de las tareas. */
                    $arraySolicitudes = $resultado->fetchAll();
                    //var_dump($arraySolicitudes);
                }
            }
        }
        /** Devuelve el array con los datos de las tareas. */
        return $arraySolicitudes;
    }

    public function leePeticion(): array {
        /** @var array[]:array[]:string con los datos de la petición. */
        $arraySolicitud = array();
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
				 FROM Peticiones
				 WHERE idAmistad = :idAmistad");
            /** Vincula los parámetros al nombre de variable especificado. */
            $resultado->bindParam(':idAmistad', $this->idAmistad);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Comprueba que existan datos. */
                if ($resultado->rowcount() > 0) {
                    /** Rellenar al array con los datos de las tareas. */
                    $arraySolicitud = $resultado->fetchAll();
                    //var_dump($arrayTareas);
                }
            }
        }
        /** Devuelve el array con los datos de las tareas. */
        return $arraySolicitud;
    }

        /**
     * Método que modifica los campos de un candidato de la base de datos.
     *
     * @access public
     * @param string $emailOriginal Valor inicial del email del candidato.
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function modificaPeticion(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "UPDATE Candidato 				 
                        SET idAmistad = :idAmistad,
				idUsuario1 = :idUsuario1,
				idUsuario2 = :idUsuario2,
                                estado = :estado,
                                fechaSolicitud  = :fechaSolicitud,                            
			WHERE idAmistad = :idAmistad");
            /** Vincula los parámetros al nombre de variable especificado. */
            $resultado->bindParam(':idAmistad', $this->idAmistad);
            $resultado->bindParam(':idUsuario1', $this->idUsuario1);
            $resultado->bindParam(':idUsuario2', $this->idUsuario2);
            $resultado->bindParam(':estado', $this->estado);
            $fechaSolicitud = $this->fechaSolicitud->format('Y-m-d');
            $resultado->bindParam(':fechaSolicitud', $fechaSolicitud);
            
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
     * Método que valida un usuario en la base de datos.
     *
     * @access public
     * @return boolean True si existe y False en otro caso
     */
    public function eliminaPeticion(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare("
				DELETE FROM Peticiones
				WHERE idAmistad = :idAmistad");
            /** Vincula un parámetro al nombre de variable especificado. */
            $resultado->bindParam(':idAmistad', $this->idAmistad);
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
