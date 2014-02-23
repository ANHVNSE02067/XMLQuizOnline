<?php
define('MODEL_PATH', dirname(__FILE__));

class Model {
    private $dom;
    private $xpath;
    private $xml_filename;
    function __construct($xml_filename) {
        $this->dom = Database::getInstance($xml_filename);
        if($this->dom) $this->xml_filename = $xml_filename;
        $this->xpath = new DOMXpath($this->dom);
    }

    public function getDom(){
        return $this->dom;
    }

    public function getXpath(){
        return $this->xpath;
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
