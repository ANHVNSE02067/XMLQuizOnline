<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}

loadModel('QuizModel.php');
$quizModel = new QuizModel();

// Delete Quiz
if (Request::get('delete_quiz')) {
    $quizId = Request::get('quiz_id', null);
    if (null !== $quizId) {
        $quizModel->deleteQuizById($quizId);
    }
}

$quizzes = $quizModel->getQuizList();

$view = new View();
$view->setLayout('staff/layout.php');
$view->setView('staff/quiz_view.php');
$view->loadCss('public/css/staff/quiz.css');
$view->loadJs('public/js/jquery.uitablefilter.js');
$view->loadJs('public/js/staff/quiz.js');
$view->setData('title', 'Quiz Manager');
$view->setData('headline', 'Quiz Manager');
$view->setData('quizzes', $quizzes);
// Set data
$view->render();
