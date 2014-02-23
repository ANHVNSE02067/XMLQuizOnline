<?php
require 'global.php';
if(!Auth::isUserAuth()) Auth::redirectToUserLoginPage ();
// Render View
$view = new View();
$view->setLayout('staff/layout.php');
$view->setView('staff/index/index.php');
$view->loadCss('public/css/staff/home.css');
$view->loadJs('public/js/staff/home.js');
$view->setData('title', 'Staff Control Panel');
// Set data
$view->setData('demo_var', 'Nhat Anh');
$view->render();
