<?php

class Request{
    public static function get($key, $default){
        return isset($_REQUEST[$key])?$_REQUEST[$key]:$default;
    }
}