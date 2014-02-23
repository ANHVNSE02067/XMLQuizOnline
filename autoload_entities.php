<?php
define('ENTITIES_FOLDER', APPLICATION_PATH.DS.'entities/');
foreach(glob(ENTITIES_FOLDER."*.php") as $file){
    require $file;
}
