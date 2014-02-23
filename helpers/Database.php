<?php
define('DB_PATH', APPLICATION_PATH.DS.'db'.DS);
class Database {

    public static $db = array();

    private function __construct() {
        
    }

    public static function getInstance($xml_filename) {
        if (!isset(self::$db[$xml_filename])) {
            $dom = new DOMDocument();
            if(!$dom->load(DB_PATH.$xml_filename)) return false;
            self::$db[$xml_filename] = $dom;
        }
        return self::$db[$xml_filename];
    }

}
