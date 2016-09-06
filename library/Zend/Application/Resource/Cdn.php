<?php

/**
 * @see Zend_Application_Resource_ResourceAbstract
 */
require_once 'Zend/Application/Resource/ResourceAbstract.php';

/**
 * 
 * @author sandro
 *
 */
class Zend_Application_Resource_Cdn extends Zend_Application_Resource_ResourceAbstract {
	
	/* (non-PHPdoc)
	 * @see Zend_Application_Resource_Resource::__construct()
	 */
	public function __construct($options = null) {
		
	}

	/* (non-PHPdoc)
	 * @see Zend_Application_Resource_Resource::init()
	 */
	public function init() {
		
	}
	
	
	/**
	 * 
	 * @var string
	 */
	protected $_host;
	
	/**
	 * @return the $_host
	 */
	public function getHost() {
		return $this->_host;
	}

	/**
	 * @param string $_host
	 */
	public function setHost($_host) {
		$this->_host = $_host;
	}

	

}

?>