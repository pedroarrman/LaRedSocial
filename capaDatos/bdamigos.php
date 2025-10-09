<?php

/**
 * bdempresa.php
 * Módulo secundario que implementa la clase BDEmpresa.
 */
/** Incluir la clase base. */
include_once 'bdgestion.php';

/**
 * Declaración de la clase BDEmpresa.
 */
class BDAmigos extends BDGestion {

    /**
     * @var string Dirección de correo electrónico de la empresa.
     * @access private
     */
    private int $idAmigo;

    /**
     * @var string Contraseña de la empresa.
     * @access private
     */
    private int $codUsuario1;

    /**
     * @var string Denominación social de la empresa.
     * @access private
     */
    private int $codUsuario2;

    /**
     * @var DateTime Fecha de inicio de la amistad.
     * @access private 
     */
    private DateTime $fechaAmistad;

    /**
     * 
     * @param int $idAmigo
     * @return void
     */
    public function setIdAmigo(int $idAmigo): void {
        $this->idAmigo = $idAmigo;
    }

    /**
     * 
     * @param int $codUsuario1
     * @return void
     */
    public function setCodUsuario1(int $codUsuario1): void {
        $this->codUsuario1 = $codUsuario1;
    }

    /**
     * 
     * @param int $codUsuario2
     * @return void
     */
    public function setCodUsuario2(int $codUsuario2): void {
        $this->codUsuario2 = $codUsuario2;
    }

    /**
     * 
     * @param DateTime $fechaAmistad
     * @return void
     */
    public function setFechaAmistad(DateTime $fechaAmistad): void {
        $this->fechaAmistad = $fechaAmistad;
    }

    /**
     * 
     * @return int
     */
    public function getIdAmigo(): int {
        return $this->idAmigo;
    }

    /**
     * 
     * @return int
     */
    public function getCodUsuario1(): int {
        return $this->codUsuario1;
    }

    /**
     * 
     * @return int
     */
    public function getCodUsuario2(): int {
        return $this->codUsuario2;
    }

    /**
     * 
     * @return DateTime
     */
    public function getFechaAmistad(): DateTime {
        return $this->fechaAmistad;
    }

    /**
     * Método que comprueba si existe la oferta en la base de datos.
     *
     * @access public
     * @return boolean True si existe el id de la oferta y False en otro caso
     */
    public function existeAmigo(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** @var PDOStatement Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
FROM Amigos
WHERE codUsuario1 = :codUsuario1 AND codUsuario2 = :codUsuario1");
            /** Vincula un parámetro al nombre de variable especificado. */
            $resultado->bindParam(':codUsuario1', $this->codUsuario1);
            $resultado->bindParam(':codUsuario2', $this->codUsuario1);
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
     * Método que inserta una nueva inscripción de un candidato a una oferta en la base de datos
     * 
     * @access public
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function insertaAmigo(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "INSERT INTO Amigos (idAmigo, codUsuario1, codUsuario2, fechaAmistad)
				 VALUES (:idAmigo, :codUsuario1, :codUsuario2, :fechaAmistad)");
            /** Vincula los parámetros al nombre de variable especificado. */
            $resultado->bindParam(':idAmigo', $this->idAmigo);
            $resultado->bindParam(':codUsuario1', $this->codUsuario1);
            $resultado->bindParam(':codUsuario2', $this->codUsuario2);
            $fechaAmistad = $this->fechaAmistad->format('Y-m-d');
            $resultado->bindParam(':fechaAmistad', $fechaAmistad);
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
     * Método que comprueba si existe el usuario en la base de datos.
     *
     * @access public
     * @return boolean True si existe el email del usuario y False en otro caso
     */
    public function leeAmigos(): array {
        /** @var array[]:Tarea Array de objetos de tipo Tarea. */
        $arrayAmigos = array();
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** @var PDOStatement Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
					FROM Amigos");
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Comprueba que existan datos. */
                if ($resultado->rowcount() > 0) {
                    /** Rellenar al array con los datos de las tareas. */
                    $arrayAmigos = $resultado->fetchAll();
                    //var_dump($arraySolicitudes);
                }
            }
        }
        /** Devuelve el array con los datos de las tareas. */
        return $arrayAmigos;
    }

    public function leeAmigo(): array {
        /** @var array[]:array[]:string con los datos de la petición. */
        $arrayAmigos = array();
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "SELECT *
				 FROM Amigos
				 WHERE idAmigo = :idAmigo");
            /** Vincula los parámetros al nombre de variable especificado. */
            $resultado->bindParam(':idAmigo', $this->idAmigo);
            /** Ejecuta la sentencia preparada y comprueba un posible error. */
            if ($resultado->execute()) {
                /** Comprueba que existan datos. */
                if ($resultado->rowcount() > 0) {
                    /** Rellenar al array con los datos de las tareas. */
                    $arrayAmigos = $resultado->fetchAll();
                    //var_dump($arrayTareas);
                }
            }
        }
        /** Devuelve el array con los datos de las tareas. */
        return $arrayAmigos;
    }

    /**
     * Método que elimina una relación oferta candidato existente de la base de datos.
     * 
     * @access public
     * @return boolean True si tiene éxito y False en otro caso
     */
    public function eliminaAmigo(): bool {
        /** Comprueba si existe conexión con la base de datos. */
        if ($this->getPdocon()) {
            /** Prepara la sentencia SQL. */
            $resultado = $this->getPdocon()->prepare(
                    "DELETE FROM Amigos
				 WHERE idAmigo = :idAmigo");
            /** Vincula un parámetro al nombre de variable especificado. */
            $resultado->bindParam(':idAmigo', $this->idAmigo);
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
