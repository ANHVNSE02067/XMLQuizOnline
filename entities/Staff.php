<?php
class Staff
{
    private $_staffID;
    private $_email;
    private $_password;
    private $_fullname;

    public function __construct($staffID = null, $email = null, $password = null, $fullname = null)
    {
        $this->_staffID = $staffID;
        $this->_email = $email;
        $this->_password = $password;
        $this->_fullname = $fullname;
    }

    public function setStaffID($staffID)
    {
        $this->_staffID = $staffID;
    }

    public function getStaffID()
    {
        return $this->_staffID;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function setFullname($fullname)
    {
        $this->_fullname = $fullname;
    }

    public function getFullname()
    {
        return $this->_fullname;
    }

}
