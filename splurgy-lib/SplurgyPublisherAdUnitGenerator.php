<?php

/*
 * This class will check for the template folder and be able to generate the
 * proper template.
 */
require_once 'SplurgyPublisherExceptions.php';
require_once 'SplurgyPublisherTemplateGenerator.php';

class SplurgyPublisherAdUnitGenerator extends TemplateGenerator
{
    private $_token;
    private $_dimension;
    private $_patterns = array();
    private $_replacements = array();
    private $_templateGenerator;
    private $_path;
    private $_html;

    public function __construct($token, $dimension, $filename)
    {
        $this->_path = dirname(__FILE__). '/ad-unit-templates/';
        $this->_token = $token;
        $this->_dimension = $dimension;
        $this->setPatterns();
        $this->setReplacements();
        parent::__construct($filename, $this->_path, $this->_patterns, $this->_replacements);
        $this->_html = parent::getTemplate();
    }

    public function setPatterns() 
    {
        $this->_patterns[] = '{$token}';
        $this->_patterns[] = '{$dimension}';        
    }

    public function setReplacements() 
    {
        $this->_replacements[] = $this->_token;
        $this->_replacements[] = $this->_dimension;
    }

    public function getHtml() {
        return $this->_html;
    }
}

?>
