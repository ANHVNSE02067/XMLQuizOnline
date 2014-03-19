<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}

loadModel('QuizModel.php');
$quizModel = new QuizModel();
$quizzes = $quizModel->getQuizList();

$view = new View();
$view->setLayout('staff/layout.php');
$view->setView('staff/quiz_view.php');
$view->loadCss('public/css/staff/staff.css');
$view->loadJs('public/js/jquery.uitablefilter.js');
$view->loadJs('public/js/staff/staff.js');
$view->setData('title', 'Staff Manager');
$view->setData('headline', 'Staff Manager');
$view->setData('quizzes', $quizzes);
// Set data
$view->render();
