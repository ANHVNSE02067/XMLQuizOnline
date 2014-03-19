<?php
require '../global.php';

if (!Auth::isUserAuth()) {
    Auth::redirectToUserLoginPage ();
}

$quizId = Request::get('quizId', null);
if ($quizId === null) {
    die('Invalid request');
}

loadModel('ReportModel.php');
$reportModel = new ReportModel();
$reports = $reportModel->getReportByQuizId($quizId);

$view = new View();
$view->setLayout('staff/layout.php');
$view->setView('staff/report_view.php');
$view->loadCss('public/css/staff/staff.css');
$view->loadJs('public/js/jquery.uitablefilter.js');
$view->loadJs('public/js/staff/staff.js');
$view->setData('title', 'Report Quiz '.$quizId);
$view->setData('headline', 'Report Quiz '.$quizId);
$view->setData('reports', $reports);
// Set data
$view->render();