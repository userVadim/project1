<?php

use app\core\DB as DB;
use app\core\Site as Site;

class App {
    
    public function begin()
    {
        $this->getPaths();
        $this->getCoreFiles();
        $this->start();
    }
    
    private function getPaths()
    {
        require 'config/paths.php';
    }
    
    private function getCoreFiles()
    {
        $files=new DirectoryIterator(CORE_FOLDER_PATH);
        foreach($files as $file)
        {
            if(!$file->IsDot() && $file!=__CLASS__.".php")
            {
                require CORE_FOLDER_PATH.$file;
            }
        }
    }
    
    private function start()
    {
        $site=$this->getController();
    }
    
    private function getController()
    {
        require WEB_CONFIG;
        $sitename= ucfirst(BASE_PAGE);
        $site=filter_input(INPUT_GET, 'site', FILTER_SANITIZE_SPECIAL_CHARS);
        if(isset($site))
        {
            $file= ucfirst(strtolower($site));

            if(file_exists(CONTROLLERS.$file.".php"))
            {
                $sitename=$file;
            }
        }
        require CONTROLLERS.$sitename.'.php';
        
        $this->initController($sitename);
        
    }
    
    private function initController($site)
    {
        $class='app\controllers\\'.$site;
        new $class;
    }

}
