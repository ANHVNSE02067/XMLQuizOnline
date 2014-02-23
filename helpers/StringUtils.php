<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StringUtil
 *
 * @author anhvn
 */
class StringUtils {
    public static function htmlentities($str){
        return htmlentities($str);
    }
    
    public static function formatTimeStamp($timestamp, $format = 'Y-m-d H:i:s'){
        $date = date_create();
        date_timestamp_set($date, 1171502725);
        $date->setTimestamp($timestamp);
        return $date->format($format);
    }
}

?>
