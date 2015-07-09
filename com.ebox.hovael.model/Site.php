<?php

class Site{
    private $id;
    private $location;
    private $startdate;
    private $enddate;
    private $projectmanager;
    private $sitemanager;
    private $permanent;
    private $status;
    
    function __construct($id, $location, $startdate, $enddate, $projectmanager, $sitemanager, $permanent, $status) {
        $this->id = $id;
        $this->location = $location;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->projectmanager = $projectmanager;
        $this->sitemanager = $sitemanager;
        $this->permanent = $permanent;
        $this->status = $status;
    }

    
    function getId() {
        return $this->id;
    }

    function getLocation() {
        return $this->location;
    }

    function getStartdate() {
        return $this->startdate;
    }

    function getEnddate() {
        return $this->enddate;
    }

    function getProjectmanager() {
        return $this->projectmanager;
    }

    function getSitemanager() {
        return $this->sitemanager;
    }

    function getPermanent() {
        return $this->permanent;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setStartdate($startdate) {
        $this->startdate = $startdate;
    }

    function setEnddate($enddate) {
        $this->enddate = $enddate;
    }

    function setProjectmanager($projectmanager) {
        $this->projectmanager = $projectmanager;
    }

    function setSitemanager($sitemanager) {
        $this->sitemanager = $sitemanager;
    }

    function setPermanent($permanent) {
        $this->permanent = $permanent;
    }

    function setStatus($status) {
        $this->status = $status;
    }



}
?>