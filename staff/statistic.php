<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}

// Get list report
loadModel('QuizModel.php');
$quizModel = new QuizModel;
$quizzes = $quizModel->getOpenQuizList();

// Render View
$view = new View();
$view->setLayout('staff/layout.php');
$view->setView('staff/statistic_view.php');
$view->loadCss('public/css/staff/statistics.css');
$view->loadJs('public/js/jquery.uitablefilter.js');
$view->loadJs('public/js/staff/statistic.js');
$view->setData('title', 'Quiz Statistic');
$view->setData('headline', 'Quiz Statistic');
$view->setData('quizzes', $quizzes);
// Set data
$view->render();
