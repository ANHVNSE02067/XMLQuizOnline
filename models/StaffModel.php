<?php

class StaffModel extends Model{

    public function __construct()
    {
        parent::__construct('Staff.xml');
    }

    public function getAllStaffs()
    {
        $xpath = $this->getXpath();
        $query  = "//staff";
        $elements = $xpath->query($query);// class DOMNodeList
        if ($elements->length == 0) {
            return false;
        }
        $staffs = array();
        foreach ($elements as $element) {
            $staffs[] = new Staff(
                $element->getAttribute('staffID'),
                $element->getElementsByTagName('email')->item(0)->nodeValue,
                $element->getElementsByTagName('password')->item(0)->nodeValue,
                $element->getElementsByTagName('fullname')->item(0)->nodeValue
            );
        }
        return $staffs;
    }

    public function getStaffByEmail($email)
    {
        $email = addslashes($email);
        $xpath = $this->getXpath();
        $query  = "//staff[email='$email']";
        $elements = $xpath->query($query);// class DOMNodeList
        if ($elements->length == 0) {
            return false;
        }
        $element = $elements->item(0);
        $staff = new Staff(
            $element->getAttribute('staffID'),
            $element->getElementsByTagName('email')->item(0)->nodeValue,
            $element->getElementsByTagName('password')->item(0)->nodeValue,
            $element->getElementsByTagName('fullname')->item(0)->nodeValue
        );
        return $staff;
    }

    public function addStaff($staff)
    {
        $dom = $this->getDom();
        $staff->setStaffID($this->generateID());
        $staffNode = $dom->createElement('staff');
        // Create ID Attribute
        $staffIDAttr = $dom->createAttribute('staffID');
        $staffIDAttr->value = $staff->getStaffID();
        $staffNode->appendChild($staffIDAttr);
        // Create email node
        $emailNode = $dom->createElement('email');
        $emailNode->appendChild($dom->createTextNode($staff->getEmail()));
        $staffNode->appendChild($emailNode);
        // Create password node
        $passwordNode = $dom->createElement('password');
        $passwordNode->appendChild($dom->createTextNode($staff->getPassword()));
        $staffNode->appendChild($passwordNode);
        // Create fullname node
        $fullnameNode = $dom->createElement('fullname');
        $fullnameNode->appendChild($dom->createTextNode($staff->getFullname()));
        $staffNode->appendChild($fullnameNode);
        // Add new staffNode
        $dom->getElementsByTagName('staffs')
            ->item(0)
            ->appendChild($staffNode);
        // save to database
        $this->save();
    }
    

    public function updatePassword($staffID, $newPassword)
    {
        $xpath = $this->getXpath();
        $staffID = intval($staffID);
        $query = "//staff[@staffID='{$staffID}']";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return false;
        }
        $element = $elements->item(0);
        $element->getElementsByTagName('password')->item(0)->nodeValue =  $newPassword;
        return $this->save();
    }

    public function deleteUserById($staffID)
    {
        $xpath = $this->getXpath();
        $userID = intval($userID);
        $query = "//staff[@staffID='{$staffID}']";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return false;
        }
        $element = $elements->item(0);
        $element->parentNode->removeChild($element);
        return $this->save();
    }

    public function getMaxStaffID()
    {
        $xpath = $this->getXpath();
        $query = "//staff[not(//staff/@staffID > @staffID)]/@staffID";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return 0;
        }
        $staffID = $elements->item(0)->value;
        return $staffID;
    }

    public function generateID()
    {
        $maxID = $this->getMaxStaffID();
        return $maxID + 1;
    }
}

