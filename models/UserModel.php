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

    public function addUser($user){
        $dom = $this->getDom();
        $user->setUserID($this->generateID());
        $userNode = $dom->createElement('user');
        // Create ID Attribute
        $userIDAttr = $dom->createAttribute('userID');
        $userIDAttr->value = $user->getUserID();
        $userNode->appendChild($userIDAttr);
        // Create email node
        $emailNode = $dom->createElement('email');
        $emailNode->appendChild($dom->createTextNode($user->getEmail()));
        $userNode->appendChild($emailNode);
        // Create password node
        $passwordNode = $dom->createElement('password');
        $passwordNode->appendChild($dom->createTextNode($user->getPassword()));
        $userNode->appendChild($passwordNode);
        // Create fullname node
        $fullnameNode = $dom->createElement('fullname');
        $fullnameNode->appendChild($dom->createTextNode($user->getFullname()));
        $userNode->appendChild($fullnameNode);
        // Add new userNode
        $dom->getElementsByTagName('users')
            ->item(0)
            ->appendChild($userNode);
        // save to database
        $this->save();
    }
    

    public function updatePassword($userID, $newPassword){
        $xpath = $this->getXpath();
        $userID = intval($userID);
        $query = "//user[@userID='{$userID}']";
        $elements = $xpath->query($query);
        if($elements->length == 0) return false;
        $element = $elements->item(0);
        $element->getElementsByTagName('password')->item(0)->nodeValue =  $newPassword;
        return $this->save();
    }

    public function getMaxUserID(){
        $xpath = $this->getXpath();
        $query = "//user[not(//user/@userID > @userID)]/@userID";
        $elements = $xpath->query($query);
        if($elements->length == 0) return 0;
        $userID = $elements->item(0)->value;
        return $userID;
    }

    public function generateID(){
        $maxID = $this->getMaxUserID();
        return $maxID + 1;
    }
}

?>
