<?php
class QuizModel extends Model
{
    public function __construct() {
        parent::__construct('Quiz.xml');
    }

    public function getAllQuiz() {
        $xpath = $this->getXpath();
        $query = "/quiz";
        $elements = $xpath->query($query);
        if ($elements->length() == 0){
            return false;
        }
        $quizzes = array();
        foreach ($elements as $element) {
            $quiz[] = new Quiz(
                $element->getAttribute('quizID'),
                $element->getAttribute('staffID'),
                $element->getAttribute('is_closed'),
                $element->getElementsByTagName('descriptionQuiz')->item(0)->nodeValue,
                $element->getElementsByTagName('time')->item(0)->nodeValue,
                $element->getElementsByTagName('questions')->item(0)->nodeValue
            );
        }
        return $quizzes;
    }

    public function getQuizById() 
    {
        $xpath = $this->getXpath();
        $query = "//quiz";
        $elements = $xpath->query($query);
        if ($elements->length === 0) {
            return false;
        }
        $quizNode = $elements->item(0);
        $quiz = new Quiz(
            $element->getAttribute('quizID'),
            $element->getAttribute('staffID'),
            $element->getAttribute('is_closed'),
            $element->getElementsByTagName('descriptionQuiz')->item(0)->nodeValue,
            $element->getElementsByTagName('time')->item(0)->nodeValue,
            $element->getElementsByTagName('questions')->item(0)->nodeValue
        );
    }
}

