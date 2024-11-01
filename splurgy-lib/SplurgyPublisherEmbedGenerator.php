<?php


require_once 'SplurgyPublisherExceptions.php';
require_once 'SplurgyPublisherTemplateGenerator.php';

class SplurgyPublisherEmbedGenerator extends TemplateGenerator
{
    private $_token;
    private $_patterns = array();
    private $_replacements = array();
    private $_templateGenerator;
    private $_path;
    private $_html;

    public function __construct($filename, $token)
    {
        $this->_path = dirname(__FILE__). '/embed-templates/';
        $this->_token = $token;
        $this->setPatterns();
        $this->setReplacements();
        parent::__construct("$filename", $this->_path, $this->_patterns, $this->_replacements);
        $this->_html = parent::getTemplate();
    }

    public function setPatterns() 
    {
        $this->_patterns[] = '{$token}';
    }

    public function setReplacements() 
    {
        $this->_replacements[] = $this->_token;
    }

    public function getHtml() {
        return $this->_html;
    }
}

?>
