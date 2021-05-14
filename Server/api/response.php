<?php

class response {
    
    private $statusCode;
    private $statusMessage;
    private $status;
    private $data = array();
    
    function __construct(){

    }
    
    function getStatusCode() {
        return $this->statusCode;
    }

    function getStatusMessage() {
        return $this->statusMessage;
    }

    function getStatus() {
        return $this->status;
    }

    function getData() {
        return $this->data;
    }

    function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
    }

    function setStatusMessage($statusMessage) {
        $this->statusMessage = $statusMessage;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setData($data) {
        $this->data = $data;
    }
    
    function create($statusCode, $statusMessage, $status) {
        $this->statusCode = $statusCode;
        $this->statusMessage = $statusMessage;
        $this->status = $status;    
    }
            
    function showResponse() {
        $makeResponse['statusCode'] = $this->statusCode;
        $makeResponse['statusMessage'] = $this->statusMessage;
        $makeResponse['status'] = $this->status;
        
        $response['response'] = $makeResponse;
        if(is_array($this->data)){
            if(count($this->data) > 0){
                $response['data'] = $this->data;
            }
        }
        
        return $json = json_encode($response, true);
    }
}