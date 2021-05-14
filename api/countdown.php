<?php

class countdown{
    
    private $id;
    private $title;
    private $date;
    private $time;
    private $timestamp;
            
    function __construct(){

    }
    
    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getDate() {
        return $this->date;
    }

    function getTime() {
        return $this->time;
    }

    function getTimestamp() {
        return $this->timestamp;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setTime($time) {
        $this->time = $time;
    }
    
    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
}