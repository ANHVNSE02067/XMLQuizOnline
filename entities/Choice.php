<?php

class Choice {

    private $_correct;
    private $_descriptionChoice;

    public function __construct($correct = null, $descriptionChoice = null) {
        $this->_correct = $correct;
        $this->_descriptionChoice = $descriptionChoice;
    }

    public function setCorrect($correct) {
        $this->_correct = $correct;
    }

    public function getCorrect() {
        return $this->_correct;
    }

    public function setDescriptionChoice($descriptionChoice) {
        $this->_descriptionChoice = $descriptionChoice;
    }

    public function getDescriptionChoice() {
        return $this->_descriptionChoice;
    }

}
