<?php
define('MODEL_PATH', dirname(__FILE__));

class Model {
    private $dom = null;
    private $xpath  = null;
    private $xml_filename = null;
    function __construct($xml_filename) {
        $this->dom = Database::getInstance($xml_filename);
        if($this->dom) {
            $this->xml_filename = $xml_filename;
            $this->xpath = new DOMXpath($this->dom);
        }
    }

    public function getDom(){
        return $this->dom;
    }

    public function getXpath(){
        return $this->xpath;
    }

    public function getXMLFilePath(){
        return Database::getXMLPath($this->xml_filename);
    }

    public function save(){
        $xmlFilePath = $this->getXMLFilePath();
        if(!$this->dom || !$xmlFilePath) return false;
        return $this->dom->save($xmlFilePath);
    }
}

function loadModel($model){
    $model = MODEL_PATH.DIRECTORY_SEPARATOR.$model;
    if(file_exists($model)){
        require $model;
    }else{
        throw new Exception('Cannot load '.$model);
    }
}

?>
