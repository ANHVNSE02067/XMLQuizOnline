<?php

class ReportModel extends Model {

    public function __construct() {
        parent::__construct('Report.xml');
    }

    public function getAllReport() {
        $xpath = $this->getXpath();
        $query = "//report";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return false;
        }
        $reports = array();
        foreach ($elements as $element) {
            $report = new Report();
            $report->setQuizID(intval($element->getAttribute('quizID')));
            $report->setReportID(intval($element->getAttribute('reportID')));
            $report->setUserID(intval($element->getAttribute('userID')));
            $report->setResult($element->getElementsByTagName('result')->item(0)->nodeValue);
            $reports[] = $report;
        }
        return $reports;
    }

    public function getReportByQuizId($quizID) {
        loadModel('UserModel.php');
        $userModel = new UserModel();
        $users = $userModel->getListUser();
        $xpath = $this->getXpath();
        $query = "//report[@quizID='$quizID']";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return false;
        }
        $reports = array();
        foreach ($elements as $element) {
            $report = array(
                'userID' => intval($element->getAttribute('userID')),
                'result' => $element->getElementsByTagName('result')->item(0)->nodeValue,
                'fullname' => 'unknown user'
            );
            foreach ($users as $user) {
                if ($user['userID'] === $report['userID']) {
                    $report['fullname'] = $user['fullname'];
                }
            }
            $reports[] = $report;
        }
        return $reports;
    }

}
