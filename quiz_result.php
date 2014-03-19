<?php
require 'global.php';
if (!Auth::isUserAuth()) {
    Auth::redirectToUserLoginPage ();
}
try{
    $quizId = Request::get('quizId', null);
    $questions = Request::get('question', null);
    if ($quizId === null || $questions === null) {
        die('Invalid request');
    }
    loadModel('QuizModel.php');
    $quizModel = new QuizModel();
    $quiz = $quizModel->getQuizById($quizId);
    if (!$quiz) {
        throw new Exception('Invalid request!');
    }

    $startTime = Session::get('quiz'.$quiz->getQuizID());
    if (!$startTime) {
        throw new Exception('Invalid request!');
    }
    $finishTime = time() - $startTime;
    if ($finishTime > $quiz->getTime() * 60) {
        if ($finishTime - $quiz->getTime() > SYN_TIME_GAP) {
            throw new Exception('Quiz expired!');
        } else {
            $finishTime = $quiz->getTime();
        }
    }

    // Calculate results
    $rawQuestions = $quiz->getQuestions();
    $total = count($rawQuestions);
    $correct = 0;
    $resultsQuestions = array();
    foreach ($rawQuestions as $question) {
        $questionId = $question->getQuestionID();
        $selectedIndex = -1;
        if (isset($questions[$questionId])) {
            $selectedIndex = $questions[$questionId];
        }
        $question->setSelectedIndex($selectedIndex);
        if ($question->isCorrect()) {
            $correct ++;
        }
        $resultsQuestions[] = $question;
    }
    $quiz->setQuestions($resultsQuestions);
    // Render View
    $view = new View();
    $view->setLayout('user/layout.php');
    $view->setView('user/quiz_result.php');
    $view->loadCss('public/css/user/quiz.css');
    $view->setData('title', 'Quiz Result');
    $view->setData('headline', 'Quiz Result');
    // Set data
    $view->setData('quiz', $quiz);
    $view->setData('total', $total);
    $view->setData('correct', $correct);
    $view->setData('finishTime', $finishTime);
    $view->render();
} catch(Exception $e){
    $message = $e->getMessage() . '<br><a href="index.php">Back to home page!</a>';
    // Render error View
    $view = new View();
    $view->setLayout('user/layout.php');
    $view->setView('error.php');
    $view->setData('title', 'Invalid');
    $view->setData('message', $message);
    $view->render();
}
