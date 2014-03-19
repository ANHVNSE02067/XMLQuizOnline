<?php
require 'global.php';
if (!Auth::isUserAuth()) {
    Auth::redirectToUserLoginPage ();
}

loadModel('QuizModel.php');
$quizModel = new QuizModel;
$quizzes = $quizModel->getQuizList();

// Render View
$view = new View();
$view->setLayout('user/layout.php');
$view->setView('user/index.php');
$view->loadCss('public/css/user/home.css');
$view->loadJs('public/js/user/home.js');
$view->setData('title', 'Home Page');
$view->setData('headline', 'Home');
// Set data
$view->setData('demo_var', 'Nhat Anh');
$view->setData('quizzes', $quizzes);
$view->render();
