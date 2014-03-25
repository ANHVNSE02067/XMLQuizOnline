<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}
if (isset($_POST['addQuiz'])) {
    try {
        $title = trim(Request::get('title', null));
        $time = trim(Request::get('time', null));
        $status = trim(Request::get('status', null));

        if ($title === '') {
            throw new Exception('Title cannot be blank!');
        }

        if ($time === '') {
            throw new Exception('You must specify time!');
        }

        if ($status === '') {
            throw new Exception('You must specify status!');
        }

        // Load QuizModel
        loadModel('QuizModel.php');
        $quizModel = new QuizModel();

        $quiz = new Quiz(null, Auth::getStaffAuthIdentity()->getUserId(), $status, $title, $time);
        $quizId = $quizModel->addBlankQuiz($quiz);
        if (false === $quizId) {
            throw new Exception('Error adding quiz!') ;
        }
        // Succes
        Auth::redirect('edit_quiz.php?id='.$quizId);
    } catch (Exception $e) {
        $message = $e->getMessage() . '<br><a href="add_quiz.php">Try again!</a>';
        // Render error View
        $view = new View();
        $view->setLayout('staff/layout.php');
        $view->setView('error.php');
        $view->setData('title', 'Error adding quiz');
        $view->setData('message', $message);
        $view->render();
    }
} else {
    // Render Add blank quiz view
    $view = new View();
    $view->setLayout('staff/layout.php');
    $view->setView('staff/addquiz_view.php');
    $view->loadCss('public/css/staff/addquiz.css');
    $view->setData('title', 'Add Quiz');
    $view->render();
}
