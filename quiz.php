<?php
require 'global.php';
if (!Auth::isUserAuth()) {
    Auth::redirectToUserLoginPage ();
}

$quizId = Request::get('id', null);
if ($quizId === null) {
    die('Invalid request');
}
loadModel('QuizModel.php');
$quizModel = new QuizModel();
$quiz = $quizModel->getQuizById($quizId);
if (!$quiz) {
    die('Invalid request!');
}
Session::set('quiz'.$quiz->getQuizID(), time());
// Render View
$view = new View();
$view->setLayout('user/layout.php');
$view->setView('user/quiz.php');
$view->loadCss('public/css/user/quiz.css');
$view->loadJs('public/js/user/quiz.js');
$view->setData('title', 'Home Page');
$view->setData('headline', 'Quiz Detail');
// Set data
$view->setData('quiz', $quiz);
$view->render();
