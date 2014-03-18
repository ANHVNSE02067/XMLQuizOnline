<?php

class Quiz 
{
    private $_descriptionQuiz;
    private $_time;
    private $_questions;
    
    public function __construct($descriptionQuiz = null, $time = null, $question = array()) {
        $this->_descriptionQuiz = $descriptionQuiz;
        $this->_time = $time;
        $this->_questions = $question;
    }
    
    public function setDescriptionQuiz($descriptionQuiz)
    {
        $this->_descriptionQuiz = $descriptionQuiz;
    }
    
    public function getDescriptionQuiz()
    {
        return $this->_descriptionQuiz;
    }
    
    public function setTime($time)
    {
        $this->_time = $time;
    }
    
    public function getTime()
    {
        return $this->_time;
    }
    
    public function setQuestion($question){
        $this->_questions = $question;
    }
    
    public function getQuestion()
    {
        return $this->_questions;
    }
}