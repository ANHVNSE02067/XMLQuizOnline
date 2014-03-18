<?php
require 'global.php';
if (!Auth::isUserAuth()) {
    Auth::redirectToUserLoginPage ();
}
// Render View
$view = new View();
$view->setLayout('user/layout.php');
$view->setView('user/quiz.php');
$view->loadCss('public/css/user/quiz.css');
$view->loadJs('public/js/user/quiz.js');
$view->setData('title', 'Home Page');
$view->setData('headline', 'Quiz Detail');
// Set data
$view->setData('quiz', 'Nhat Anh');
$view->render();
