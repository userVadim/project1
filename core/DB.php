<?php

namespace app\core;
use \PDO as PDO;


class DB extends PDO{
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $createDefaultTables;
    private $insertDefaultValues;
    
    const FETCH_ASSOC=PDO::FETCH_ASSOC;
            
    public function __construct() {
        $this->getParams();
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        parent::__construct($dsn,$this->user,$this->password);
        
        try 
        { 
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->exec("set names utf8");

            $this->createDefaultTables();
        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
    }
    
    private function getParams()
    {
        $params=require DB_CONFIG_FILE_PATH; 
        $this->dbname=$params['dbname'];
        $this->host=$params['host'];
        $this->password=$params['password'];
        $this->user=$params['user'];
        $this->createDefaultTables=$params['createDefaultTables'];
        $this->insertDefaultValues=$params['insertDefaultValues'];
    }
    
    private function createDefaultTables()
    {
        if($this->createDefaultTables)
        {
            $dump= include DB_DEFAULT_TABLES;
            foreach($dump as $query)
            {
                $table=$this->prepare($query);
                $table->execute();
            }
            
            $this->insertDefaultValues();
        }
    }
    
    private function insertDefaultValues()
    {
        if($this->insertDefaultValues)
        {
            $rows=include DB_DEFAULT_ROWS;
            foreach($rows as $tablename=>$vals)
            {
                if($this->isEmptyTable($tablename))
                {
                    $value_names=$vals['value_names'];
                    $values=$vals['values'];
                    foreach($values as $arr)
                    {
                        $query="INSERT INTO ".$tablename. " SET ";
                        foreach ($arr as $key=>$val)
                        {
                            $query.=$value_names[$key]."='".$val."'";
                            if($key < count($arr)-1)
                            {
                                $query.=", ";
                            }
                        }
                        $insert= $this->prepare($query);
                        $insert->execute();
                    }
                }
            }
        }
    }
    
    private function isEmptyTable($tablename)
    {
        $check=$this->query('SELECT COUNT(*) AS count FROM '.$tablename);
        $check_rows=$check->fetch(PDO::FETCH_ASSOC);
        if($check_rows['count']==0)
        {
            return true;
        }
        return false;
    }
}
