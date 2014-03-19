<?php
class Session
{
    public function __construct()
    {
        self::start();
    }

    public static function start()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function get($key)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }
}
