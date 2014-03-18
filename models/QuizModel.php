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
            if ($quizStatus === QUIZ_OPEN)
            {
                $quiz = new Quiz();
                $quiz->setQuizID(intval($element->getAttribute('quizID')));
                $quiz->setDescriptionQuiz($element->getElementsByTagName('descriptionQuiz')->item(0)->nodeValue);
                $quiz->setTime(intval($element->getElementsByTagName('time')->item(0)->nodeValue));
                
                $quizzes[] = $quiz;
            }
        }
        return $quizzes;
    }
}

