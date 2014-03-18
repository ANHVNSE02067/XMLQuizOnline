<?php

class Report {

    private $_reportID;
    private $_quizID;
    private $_userID;
    private $_result;

    public function __contrucst($reportID = null, $quizID = null, $userID = null, $result = null) {
        $this->_reportID = $reportID;
        $this->_quizID = $quizID;
        $this->_userID = $userID;
        $this->_result = $result;
    }

    public function setReportID($reportID) {
        $this->_reportID = $reportID;
    }

    public function getReportID() {
        return $this->_reportID;
    }

    public function setQuizID($quizID) {
        $this->_quizID = $quizID;
    }

    public function getQuizID() {
        return $this->_quizID;
    }

    public function setUserID($userID) {
        $this->_userID = $userID;
    }

    public function getUserID() {
        return $this->_userID;
    }

    public function setResult($result) {
        $this->_result = $result;
    }

    public function getResult() {
        return $this->_result;
    }

}
