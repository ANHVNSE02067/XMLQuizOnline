<?php
require 'global.php';
if (!Auth::isUserAuth()) {
    Auth::redirectToUserLoginPage ();
}
// Render View
$view = new View();
$view->setLayout('user/layout.php');
$view->setView('user/index.php');
$view->loadCss('public/css/home.css');
$view->loadJs('public/js/home.js');
$view->setData('title', 'Home Page');
$view->setData('headline', 'Home');
// Set data
$view->setData('demo_var', 'Nhat Anh');
$view->render();
