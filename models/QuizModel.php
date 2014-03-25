<?php
class QuizModel extends Model
{
    public function __construct()
    {
        parent::__construct('Quiz.xml');
    }
    
    public function getOpenQuizList()
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

    public function getQuizList()
    {
        $xpath = $this->getXpath();
        $query = "//quiz";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return false;
        }
        $quizzes = array();
        foreach ($elements as $element) {            
            $quiz = new Quiz();
            $quiz->setQuizID(intval($element->getAttribute('quizID')));
            $quiz->setIsClosed(intval($element->getAttribute('is_closed')));
            $quiz->setStaffID(intval($element->getAttribute('staffID')));
            $quiz->setDescriptionQuiz($element->getElementsByTagName('descriptionQuiz')->item(0)->nodeValue);
            $quiz->setTime(intval($element->getElementsByTagName('time')->item(0)->nodeValue));

            $quizzes[] = $quiz;
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

    public function addBlankQuiz($quiz)
    {
        $quizId = $this->generateID();
        $quiz->setQuizID($quizId);
        $dom = $this->getDom();
        $quizNode = $dom->createElement('quiz');
        // QuizID
        $quizIDAttribute = $dom->createAttribute('quizID');
        $quizIDAttribute->value = $quiz->getQuizID();
        $quizNode->appendChild($quizIDAttribute);
        // StaffID
        $staffIDAttribute = $dom->createAttribute('staffID');
        $staffIDAttribute->value = $quiz->getStaffID();
        $quizNode->appendChild($staffIDAttribute);
        // is_closed
        $isClosedAttribute = $dom->createAttribute('is_closed');
        $isClosedAttribute->value = $quiz->getIsClosed();
        $quizNode->appendChild($isClosedAttribute);
        // descriptionQuizNode
        $descriptionQuizNode = $dom->createElement('descriptionQuiz');
        $descriptionQuizNode->appendChild($dom->createTextNode($quiz->getDescriptionQuiz()));
        $quizNode->appendChild($descriptionQuizNode);
        // timeNode
        $timeNode = $dom->createElement('time');
        $timeNode->appendChild($dom->createTextNode($quiz->getTime()));
        $quizNode->appendChild($timeNode);
        // questionsNode
        $questionsNode = $dom->createElement('questions');
        $quizNode->appendChild($questionsNode);
        // Add new node
        $dom->getElementsByTagName('quizes')
            ->item(0)
            ->appendChild($quizNode);
        if ($this->save()) {
            return $quiz->getQuizID();
        }
        return false;
    }

    public function deleteQuizByID($quizID)
    {
        $xpath = $this->getXpath();
        $quizID = intval($quizID);
        $query = "//quiz[@quizID='{$quizID}']";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return false;
        }
        $element = $elements->item(0);
        $element->parentNode->removeChild($element);
        // Also delete report of this quiz
        loadModel('ReportModel.php');
        $reportModel = new ReportModel();
        $reportModel->deleteReportByQuizId($quizID);
        return $this->save();
    }

    public function updateQuiz($quiz)
    {
        $xpath = $this->getXpath();
        $query = "//quiz[@quizID='{$quiz->getQuizID()}']";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return false;
        }
        $element = $elements->item(0);
        $element->getElementsByTagName('descriptionQuiz')->item(0)->nodeValue  = $quiz->getDescriptionQuiz();
        $element->getElementsByTagName('time')->item(0)->nodeValue  = $quiz->getTime();
        $element->setAttribute('is_closed', $quiz->getIsClosed());
        return $this->save();
    }

    public function getMaxQuizID()
    {
        $xpath = $this->getXpath();
        $query = "//quiz[not(//quiz/@quizID > @quizID)]/@quizID";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return 0;
        }
        $quizID = $elements->item(0)->value;
        return $quizID;
    }
    public function generateID()
    {
        $maxID = $this->getMaxQuizID();
        return $maxID + 1;
    }
}

