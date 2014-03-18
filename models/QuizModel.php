<?php
class QuizModel extends Model
{
    public function __construct()
    {
        parent::__construct('Quiz.xml');
    }
    
    public function getQuizList()
    {
        $xpath = $this->getXpath();
        $query = "//quiz";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return false;
        }
        $quizzes = array();
        $quizStatus = '';  
        foreach ($elements as $element) {
            $quizStatus = intval($element->getAttribute('is_closed'));
            if ($quizStatus === QUIZ_OPEN) {
                $quiz = new Quiz();
                $quiz->setQuizID(intval($element->getAttribute('quizID')));
                $quiz->setDescriptionQuiz($element->getElementsByTagName('descriptionQuiz')->item(0)->nodeValue);
                $quiz->setTime(intval($element->getElementsByTagName('time')->item(0)->nodeValue));
                
                $quizzes[] = $quiz;
            }
        }
        return $quizzes;
    }

    public function getQuizById($quizID) 
    {   
        $quizID = intval($quizID);
        $xpath = $this->getXpath();
        $query = "//quiz[@quizID='{$quizID}']";
        $elements = $xpath->query($query);
        if ($elements->length === 0) {
            return false;
        }
        $quizNode = $elements->item(0);
        $questionsNode = $quizNode->getElementsByTagName('questions')->item(0);
        $questions = $this->getQuestionsByNode($questionsNode);
        $quiz = new Quiz(
            $quizNode->getAttribute('quizID'),
            $quizNode->getAttribute('staffID'),
            $quizNode->getAttribute('is_closed'),
            $quizNode->getElementsByTagName('descriptionQuiz')->item(0)->nodeValue,
            $quizNode->getElementsByTagName('time')->item(0)->nodeValue,
            $questions
        );
        return $quiz;
    }
    
    protected function getQuestionsByNode($questionsNode)
    {
        $questions = array();
        $questionNodes = $questionsNode->getElementsByTagName('question');
        if ($questionNodes->length === 0) {
            return array();
        }
        foreach ($questionNodes as $node) {
            $choices = $this->getChoicesByNode($node->getElementsByTagName('choices')->item(0));
            $questions[] = new Question(
                $node->getAttribute('questionID'),
                $node->getElementsByTagName('descriptionQuestion')->item(0)->nodeValue,
                $choices
            );
        }
        return $questions;
    }
    
    protected function getChoicesByNode($choicesNode)
    {
        $choices = array();
        $choiceNodes = $choicesNode->getElementsByTagName('choice');
        if ($choiceNodes->length === 0) {
            return array();
        }
        foreach ($choiceNodes as $node) {
            $choices[] = new Choice(
                $node->getAttribute('correct'),
                $node->getElementsByTagName('descriptionChoice')->item(0)->nodeValue
            );
        }
        return $choices;
    }
}

