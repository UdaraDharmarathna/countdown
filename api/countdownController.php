<?php

require 'config.php';
require 'response.php';
require 'database.php';
require 'countdown.php';
require 'countdownDAO.php';

$viewData = false;
if(isset($_GET['view'])){
    if(intval($_GET['view']) === 1){
        $viewData = true;
    }
}

$countdownAvailable = false;
$id = NULL;
$checkAvailableCountdown = countdownDAO::checkAvailableCountdown();
if($checkAvailableCountdown){
    $countdownAvailable = true;
    foreach ($checkAvailableCountdown as $single){
        $id = $single['id'];
        break;
    }
}

$response = new response();

$countdown = new countdown();
if($viewData){
    $countdown->setId($id);
    $singleCountdown = countdownDAO::getCountdown($countdown);
    if($singleCountdown){
        $response->create(200,'Success',true);
        $response->setData($singleCountdown);
        echo $response->showResponse();
        die();
    } else {
        $response->create(202,'Data not found',false);
        echo $response->showResponse();
        die();
    }
} else {
    $title = NULL;
    $date = NULL;
    $time = NULL;
    
    if(isset($_POST['title']) && !empty($_POST['title'])){
        $title = $_POST['title'];
    } else {
        $response->create(202,'Title is required',false);
        echo $response->showResponse();
        die();
    }
    if(isset($_POST['date']) && !empty($_POST['date'])){
        $date = $_POST['date'];
        if (DateTime::createFromFormat('Y-m-d', $date) === false) {
            $response->create(202,'Invalid date',false);
            echo $response->showResponse();
            die();
        }
    } else {
        $response->create(202,'Target date is required',false);
        echo $response->showResponse();
        die();
    }
    if(isset($_POST['time']) && !empty($_POST['time'])){
        $time = $_POST['time'];
        if (DateTime::createFromFormat('H:i', $time) === false) {
            $response->create(202,'Invalid time',false);
            echo $response->showResponse();
            die();
        }
    } else {
        $response->create(202,'Target time is required',false);
        echo $response->showResponse();
        die();
    }
    
    $countdown->setTitle($title);
    $countdown->setDate($date);
    $countdown->setTime($time);
    $date_time = $date.' '.$time;
    
    $dateObj = new DateTime($date_time);
    $timestamp = $dateObj->getTimestamp();  
    
    $countdown->setTimestamp($timestamp);
    
    if($countdownAvailable){
        $countdown->setId($id);
        if(countdownDAO::updateCountdown($countdown)){
            $response->create(200,'Success',true);
            echo $response->showResponse();
            die();
        } else {
            $response->create(202,'Countdown setup fail',false);
            echo $response->showResponse();
            die();
        }
    } else {
        if(countdownDAO::setCountdown($countdown)){
            $response->create(200,'Success',true);
            echo $response->showResponse();
            die();
        } else {
            $response->create(202,'Countdown setup fail',false);
            echo $response->showResponse();
            die();
        }
    }
}

