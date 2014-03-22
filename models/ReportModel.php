<?php

class ReportModel extends Model {

    public function __construct() 
    {
        parent::__construct('Report.xml');
    }

    public function getAllReport() 
    {
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

    public function getReportByQuizId($quizID) 
    {
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

    public function addReport($report)
    {
        $dom = $this->getDom();
        $report->setReportID($this->generateID());
        $reportNode = $dom->createElement('report');
        // Create reportID
        $reportIdAttr = $dom->createAttribute('reportID');
        $reportIdAttr->value = $report->getReportID();
        $reportNode->appendChild($reportIdAttr);
        // Create quizID
        $quizIdAttr = $dom->createAttribute('quizID');
        $quizIdAttr->value = $report->getQuizID();
        $reportNode->appendChild($quizIdAttr);
        // Create reportID
        $userIdAttr = $dom->createAttribute('userID');
        $userIdAttr->value = $report->getUserID();
        $reportNode->appendChild($userIdAttr);
        // create result node
        $resultNode = $dom->createElement('result');
        $resultNode->appendChild($dom->createTextNode($report->getResult()));
        $reportNode->appendChild($resultNode);
        $dom->getElementsByTagName('reports')->item(0)
            ->appendChild($reportNode);
        // Save
        $this->save();
    }

    public function deleteReportByUserId($userID) 
    {
        $xpath = $this->getXpath();
        $query = "//report[@userID='$userID']";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return false;
        }
        $parent = $elements->item(0)->parentNode;
        foreach ($elements as $element) {
            $parent->removeChild($element);
        }

        return $this->save();
    }

    public function getMaxReportID()
    {
        $xpath = $this->getXpath();
        $query = "//report[not(//report/@reportID > @reportID)]/@reportID";
        $elements = $xpath->query($query);
        if ($elements->length == 0) {
            return 0;
        }
        $staffID = $elements->item(0)->value;
        return $staffID;
    }

    public function generateID()
    {
        $maxID = $this->getMaxReportID();
        return $maxID + 1;
    }
}
