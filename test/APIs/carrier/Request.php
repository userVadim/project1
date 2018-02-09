<?php
namespace api;
use api\Carrier;

class Request extends Carrier 
{
    //setting needed values(fields) in request
    public function neededValues()
    {
        return ['id', 'name', 'position', 'grade'];
    }
    
    //setting forbidden servers ip
    public function forbiddenServers()
    {
        return ['::1'];
    }
    
    
    //setting remote server address 
    public function getTargetServer()
    {
        return 'http://site.com';
    }
    
    protected function setStatus()
    {
//        $this->data->status="test";
    }
    
    public function beforeSendingRequest() 
    {
//        var_dump ($this->data);
    }

}
