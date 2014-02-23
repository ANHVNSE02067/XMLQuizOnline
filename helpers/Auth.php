<?php

// Start session
if (!isset($_SESSION))
    session_start();

class Auth {

    public static function isAuth() {
        if (isset($_SESSION) && isset($_SESSION['auth_user'])) {
            return true;
        }
        return false;
    }

    public static function isStaffAuth(){
        if (isset($_SESSION) && isset($_SESSION['auth_staff'])) {
            return true;
        }
        return false;
    }

    public static function isUserAuth(){
        if (isset($_SESSION) && isset($_SESSION['auth_user'])) {
            return true;
        }
        return false;
    }

    public static function getUserAuthIdentity() {
        if (self::isUserAuth()) {
            return $_SESSION['auth_user'];
        }
        return null;
    }

    public static function getStaffAuthIdentity() {
        if (self::isStaffAuth()) {
            return $_SESSION['auth_staff'];
        }
        return null;
    }

    public static function redirectToStaffLoginPage() {
        self::redirect(SITE_URL . 'staff/login.php');
    }

    public static function redirectToUserLoginPage() {
        self::redirect(SITE_URL . 'login.php');
    }

    public static function unsetUserAuthIdentity() {
        if (isset($_SESSION) && isset($_SESSION['auth_user']))
            unset($_SESSION['auth_user']);
    }

    public static function unsetStaffAuthIdentity() {
        if (isset($_SESSION) && isset($_SESSION['auth_staff']))
            unset($_SESSION['auth_staff']);
    }

    public static function setUserAuthIdentity(AuthUser $user) {
        $_SESSION['auth_user'] = $user;
    }

    public static function setStaffAuthIdentity(AuthUser $user) {
        $_SESSION['auth_staff'] = $user;
    }

    public static function redirect($location) {
        header('location: ' . $location);
        exit;
    }

}

class AuthUser {

    const STAFF = 'staff';
    const USER = 'user';

    private $_userId;
    private $_username;
    private $_email;
    private $_role;

    function __construct($userId = null) {
        $this->_userId = $userId;
    }

    public function getUserId() {
        return $this->_userId;
    }

    public function setUserId($userId) {
        $this->_userId = $userId;
    }

    public function getUsername() {
        return $this->_username;
    }

    public function setUsername($username) {
        $this->_username = $username;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function setEmail($email) {
        $this->_email = $email;
    }

    public function setRole($role){
        if($role == self::STAFF || $role == self::USER){
            $this->_role = $role;
        }
    }

    public function getRole(){
        return $this->_role;
    }

}
