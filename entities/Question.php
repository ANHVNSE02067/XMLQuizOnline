<?php

class Question {

    private $_questionID;
    private $_descriptionQuestion;
    private $_choices;
    private $_selected_index;

    public function __construct($questionID = null, $descriptionQuestion = null, $choices = array()) 
    {
        $this->_questionID = $questionID;
        $this->_descriptionQuestion = $descriptionQuestion;
        $this->_choices = $choices;
        $this->_selected_index = -1;
    }

    public function setQuestionID($questionID) 
    {
        $this->_questionID = $questionID;
    }

    public function getQuestionID() 
    {
        return $this->_questionID;
    }

    public function setDescriptionQuestion($descriptionQuestion) 
    {
        $this->_descriptionQuestio = $descriptionQuestion;
    }

    public function getDescriptionQuestion() 
    {
        return $this->_descriptionQuestion;
    }

    public function setChoices($choices) 
    {
        $this->_choices = $choices;
    }

    public function getChoices() 
    {
        return $this->_choices;
    }
    
    public function setSelectedIndex($index)
    {
        $this->_selected_index = $index;
    }

    public function getSelectedIndex()
    {
        return $this->_selected_index;
    }

    public function isCorrect()
    {
        if ($this->_selected_index === null) {
            return false;
        }
        if (!isset($this->_choices[$this->_selected_index])) {
            return false;
        }
        if ($this->_choices[$this->_selected_index]->getCorrect() == CHOICE_TRUE) {
            return true;
        }
        return false;
    }
}
