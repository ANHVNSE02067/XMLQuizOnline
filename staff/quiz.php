<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}

loadModel('QuizModel.php');
$quizModel = new QuizModel();

// Delete Staff
if (Request::get('delete_quiz')) {
    $quizId = Request::get('quiz_id', null);
    if (null !== $quizId) {
        $quizModel->deleteQuizById($quizId);
    }
}

$staffs = $staffModel->getAllStaffs();
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
