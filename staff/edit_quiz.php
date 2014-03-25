<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}
try {
    $quizId = Request::get('quizId', null);

    if (null === $quizId) {
        throw new Exception('Invalid request');
    }

    $quizId = intval($quizId);

    // Load QuizModel
    loadModel('QuizModel.php');
    $quizModel = new QuizModel();

    $quiz = $quizModel->getQuizById($quizId);
    if (!$quiz) {
        throw new Exception('Quiz Not found!');
    }
    
    if (isset($_POST['editQuiz'])) {
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


        $quiz->setDescriptionQuiz($title);
        $quiz->setTime($time);
        $quiz->setIsClosed($status);
        if (!$quizModel->updateQuiz($quiz)) {
            throw new Exception('Error update quiz!') ;
        }
        // Succes
        Auth::redirect('quiz.php');
    } else {
        // Render edit view
        $view = new View();
        $view->setLayout('staff/layout.php');
        $view->setView('staff/editquiz_view.php');
        $view->loadCss('public/css/staff/editquiz.css');
        $view->setData('title', 'Edit quiz');
        $view->setData('quiz', $quiz);
        $view->render();
    }
} catch (Exception $e) {
    $message = $e->getMessage() . '<br><a href="quiz.php">Try again!</a>';
    // Render error View
    $view = new View();
    $view->setLayout('staff/layout.php');
    $view->setView('error.php');
    $view->setData('title', 'Error adding quiz');
    $view->setData('message', $message);
    $view->render();
}
