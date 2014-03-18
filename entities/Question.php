<?php

class Question {

    private $_questionID;
    private $_descriptionQuestion;
    private $_choices;

    public function __construct($questionID = null, $descriptionQuestion = null, $choices = array()) {
        $this->_questionID = $questionID;
        $this->_descriptionQuestion = $descriptionQuestion;
        $this->_choices = $choices;
    }

    public function setQuestionID($questionID) {
        $this->_questionID = $questionID;
    }

    public function getQuestionID() {
        return $this->_questionID;
    }

    public function setDescriptionQuestion($descriptionQuestion) {
        $this->_descriptionQuestio = $descriptionQuestion;
    }

    public function getDescriptionQuestion() {
        return $this->_descriptionQuestion;
    }

    public function setChoices($choices) {
        $this->_choices = $choices;
    }

    public function getChoices() {
        return $this->_choices;
    }

}
