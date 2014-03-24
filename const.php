<?php
define('SITE_URL', 'http://localhost/XMLQuizOnline/');
define('STAFF_URL', 'http://localhost/XMLQuizOnline/staff/');
define('DS', DIRECTORY_SEPARATOR);
define('APPLICATION_PATH', dirname(__FILE__));
define('IMG_UPLOAD_PATH', APPLICATION_PATH . DS. 'public' . DS . 'img' . DS . 'upload');
define('IMG_UPLOAD_URL', SITE_URL . 'public/upload/');
define('TIME_FORMAT', 'Y-m-d H:i:s');
define('QUIZ_CLOSED', 1);
define('QUIZ_OPEN', 0);
define('CHOICE_TRUE', 1);
define('CHOICE_FALSE', 0);
define('SYN_TIME_GAP', 3); // There will be 3 seconds plus for load quiz and submit quiz
