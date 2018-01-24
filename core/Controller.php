<?php


namespace app\core;
use \DirectoryIterator;

abstract class Controller {
    
    private $class;
    private $page;
    private $data;
    
    public function __construct()
    {
        $this->childrenName();
        $this->getModes();
        $this->getTemplate();
    }
    
    private function childrenName()
    {
        $path=explode('\\',get_called_class());
        $this->class= strtolower($path[count($path)-1]);       
    }
    
    private function getModes()
    {
        $path=MODELS.$this->class."/";
        $files=new DirectoryIterator($path);
        foreach($files as $file)
        {
            if(!$file->IsDot())
            {
                require $path.$file;
            }
        }
    }
    
    private function getTemplate() {
        require TEMPLATES.$this->class.".php";
    }
    
    public function render($data)
    {
        $this->data=$data;
    }


    private function content()
    {
        $path=VIEWS.$this->class.'/';
        $page = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING);
        if(!$page || !file_exists($path.$page.".php"))
        {
            $page='index';
        }

        $function="action". ucfirst($page);

        $this->$function();

        require $path.$page.".php";
        return $this->data;
    }
    
    public function id()
    {
        $id=filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if($id)
        {
            return $id;
        }
    }
    
    public function goHome()
    {
        header("Location:index.php");
    }
}
