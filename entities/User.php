<?php
class User
{
    private $_userID;
    private $_email;
    private $_password;
    private $_fullname;

    public function __construct($userID = null, $email = null, $password = null, $fullname = null){
        $this->_userID = $userID;
        $this->_email = $email;
        $this->_password = $password;
        $this->_fullname = $fullname;
    }

    public function setUserID($userID){
        $this->_userID = $userID;
    }

    public function getUserID(){
        return $this->_userID;
    }

    public function setEmail($email){
        $this->_email = $email;
    }

    public function getEmail(){
        return $this->_email;
    }

    public function getPassword(){
        return $this->_password;
    }

    public function setPassword($password){
        $this->_password = $password;
    }

    public function setFullname($fullname){
        $this->_fullname = $fullname;
    }

    public function getFullname(){
        return $this->_fullname;
    }

}
