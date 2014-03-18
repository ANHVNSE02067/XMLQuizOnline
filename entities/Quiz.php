<?php

class Quiz 
{
    private $_quizID;
    private $_staffID;
    private $_is_closed;
    private $_descriptionQuiz;
    private $_time;
    private $_questions;
    
    public function __construct($quizID = null, $staffID = null, $is_closed = null, $descriptionQuiz = null, $time = null, $questions = array()) {
        $this->_quizID = $quizID;
        $this->_staffID = $staffID;
        $this->_is_closed = $is_closed;
        $this->_descriptionQuiz = $descriptionQuiz;
        $this->_time = $time;
        $this->_questions = $questions;
    }
    
    public function setQuizID($quizID)
    {
        $this->_quizID = $quizID;
    }

    public function getQuizID()
    {
        return $this->_quizID;
    }   
    
    public function setStaffID($staffID)
    {
        $this->_staffID = $staffID;
    }

    public function getStaffID()
    {
        return $this->_staffID;
    }   
    
    public function setIsClosed($is_closed)
    {
        $this->_is_closed = $is_closed;
    }

    public function getIsClosed()
    {
        return $this->_is_closed;
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
    
    public function setQuestions($question)
    {
        $this->_questions = $question;
    }
    
    public function getQuestions()
    {
        return $this->_questions;
    }
}
