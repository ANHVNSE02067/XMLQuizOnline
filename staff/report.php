<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}
try {
    $quizId = Request::get('quizId', null);
    if ($quizId === null) {
        die('Invalid request');
    }

    loadModel('ReportModel.php');
    $reportModel = new ReportModel();
    $reports = $reportModel->getReportByQuizId($quizId);
    
    if (!$reports) {
        throw new Exception('This quiz have not been taken yet!');
    }

    $view = new View();
    $view->setLayout('staff/layout.php');
    $view->setView('staff/report_view.php');
    $view->loadCss('public/css/staff/report.css');
    $view->loadJs('public/js/jquery.uitablefilter.js');
    $view->loadJs('public/js/staff/report.js');
    $view->setData('title', 'Report Quiz '.$quizId);
    $view->setData('headline', 'Report Quiz '.$quizId);
    $view->setData('reports', $reports);
    // Set data
    $view->render();
} catch (Exception $e) {
    $message = $e->getMessage() . '<br><a href="statistic.php">Try again!</a>';
    // Render error View
    $view = new View();
    $view->setLayout('staff/layout.php');
    $view->setView('error.php');
    $view->setData('title', 'Error adding staf');
    $view->setData('message', $message);
    $view->render();
}
