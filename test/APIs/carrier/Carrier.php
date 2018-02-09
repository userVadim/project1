<?php

namespace api;

abstract class Carrier
{
    protected $data;
    protected $status="ok";
    protected $errorStatus="error";
    protected $target;
    
    public function __construct() {  
        $this->getData();
        $this->checkValues();
        $this->checkServer();
        $this->setStatus();
        $this->beforeSendingRequest();
        $this->sendRequest();
        
        $this->returnResponse();
    }
    
    //stopping all processes and 
    //given response to client
    private function stop()
    {
        $this->returnResponse();
        exit();
    }
    
    //getting data 
    //form post request
    private function getData()
    {
        $data=filter_input(INPUT_POST, 'out');
        if(!$this->data=$this->isJson($data))
        {
            $this->errorStatus('Request is not in JSON format.');
        }
    }
    
    //checking if request data 
    //in json format
    private function isJson($data)
    {
        $jsonData=json_decode($data);
        if(is_string($data) && is_object($jsonData))
        {
            return  $this->data=$jsonData;
        }
        return false;
    }
    
    //setting status 
    //of request/response
    protected function setStatus()
    {
        $this->data->status=$this->status;
    }
    
    //setting error status 
    //and stops all processes 
    protected function errorStatus($errorReason)
    {
        $this->data=[
                'status'=>$this->errorStatus,
                'errorMessage'=>$errorReason
            ];
        $this->stop();
    }
    
    //getting from child: 
    //setting remove server address
    private function setTargetServer()
    {
        $this->target=$this->getTargetServer();
    }
    
    //getting from child: 
    //checking needed values to send to remote server
    protected function checkValues()
    {
        if($this->neededValues())
        {
            foreach($this->neededValues() as $value)
            {

                if(!isset($this->data->$value) || empty($this->data->$value))
                {
                     $emptyFields[]=$value;
                }
            }
            if(!empty($emptyFields))
            {
                $errorSring= implode(", ", $emptyFields)." is needed";
                $this->errorStatus($errorSring);

            }
        }
    }
    
    //getting from child: 
    //checking if forbidden server by ip
    protected function checkServer()
    {
        if($this->forbiddenServers())
        {
            foreach($this->forbiddenServers() as $ip)
            {
                if($_SERVER['REMOTE_ADDR']==$ip)
                {
                    $this->errorStatus("forbidden server");
                }
            }
        }
    }
    
    //request to remote server 
    //in json format 
    private function sendRequest()
    {
        $this->setTargetServer();
        
        $data= json_encode($this->data);
        $options = ['http' => [
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => http_build_query(['out' => $data])
        ]];
        $context = stream_context_create($options);       
        if(!$this->data = file_get_contents($this->target, false, $context))
        {
            $this->errorStatus("can't connect to server");
        }
    }
 
    // response to client
    private function returnResponse()
    {
        if(is_object($this->data) || is_array($this->data))
        {
            echo json_encode($this->data);
        }
        else
        {
            echo $this->data;
        }
    }

    //must to return array of forbidden servers 
    public abstract function forbiddenServers();
    
    //must to return array of nedded values
    public abstract function neededValues();
    
    //must to return string: remote server address
    public abstract function getTargetServer();
    
    //adding user functions
    public abstract function beforeSendingRequest();

}

