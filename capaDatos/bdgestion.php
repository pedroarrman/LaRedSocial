<?php
/**
 * bdgestion.php
 * Módulo secundario que implementa la clase BDGestion.
 */

/**
 * Declaración de la clase BDGestion
 * @abstract
*/
abstract class BDGestion {

	/**
	 * @var PDO Conexión con el servidor de bases de datos.
	 * @access private 
	 */
	private $pdocon = null;
	
	/** 
	 * @const DSN Nombre del origen de datos.
	 */
	private const DSN = "mysql:host=localhost;dbname=BDUsuarios";

	/** 
	 * @const USUARIO Nombre del usuario del servidor de bases de datos.
	 * @access private 
	 */
	private const USUARIO = "UBDUsuarios";

	/** 
	 * @const CONTRASEÑA Contraseña del usuario.
	 * @access private 
	 */
	private const CONTRASEÑA = "Lo-1234-lo";

	/** 
	 * @const OPCIONES[] Opciones de conexión específicas del controlador.
	 * @access private 
	 */
	private const OPCIONES = array(PDO::MYSQL_ATTR_INIT_COMMAND => 
		'SET CHARACTER SET utf8');	
	
	/**
	 * Constructor de la clase.
	 * 
	 * @access public
	 * @return void 
	 */
	public function __construct() {
		/** Establece la conexión con el servidor de bases de datos. */
		$this->pdocon = new PDO(self::DSN, self::USUARIO, self::CONTRASEÑA, 
				self::OPCIONES);
	}

	/**
	 * Destructor de la clase.
	 * 
	 * @access public
	 * @return void 
	 */
	public function __destruct() {
		/** Cierra la conexión con el servidor de bases de datos. */
		$this->pdocon = null;
	}

	/**
	 * Método que devuelve el valor de la conexión.
	 * 
	 * @access public
	 * @return PDO Conexión con el servidor de bases de datos.
	 */
	public function getPdocon() : PDO {
		return $this->pdocon;
	}
}
