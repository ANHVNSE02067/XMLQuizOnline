<?php
define('DB_PATH', APPLICATION_PATH.DS.'db'.DS);
class Database {

    public static $db = array();

    private function __construct() {
        
    }

    public static function getInstance($xml_filename) {
        if (!isset(self::$db[$xml_filename])) {
            $dom = new DOMDocument();
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            if(!$dom->load(DB_PATH.$xml_filename)) return false;
            self::$db[$xml_filename] = $dom;
        }
        return self::$db[$xml_filename];
    }

    public static function getXMLPath($xml_filename){
        $file_path = DB_PATH.$xml_filename;
        if(file_exists($file_path)){
            return $file_path;
        }
        return false;
    }

}
