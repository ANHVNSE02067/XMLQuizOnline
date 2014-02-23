<?php

class UserModel extends Model{

    public function __construct(){
        parent::__construct('User.xml');
    }

    public function getUserByEmail($email){
        $email = addslashes($email);
        $xpath = $this->getXpath();
        $query  = "//user[email='$email']";
        $elements = $xpath->query($query);// class DOMNodeList
        if($elements->length == 0) return false;
        $element = $elements->item(0);
        $user = new User(
            $element->getAttribute('userID'),
            $element->getElementsByTagName('email')->item(0)->nodeValue,
            $element->getElementsByTagName('password')->item(0)->nodeValue,
            $element->getElementsByTagName('fullname')->item(0)->nodeValue
        );
        return $user;
    }
}

?>
