<?php

namespace app\controllers;
use app\core\Controller as Controller;
use app\models\Home as Home;
use app\models\Viewitem as Viewitem;

class Littleshop extends Controller {

    
    public function actionIndex()
    {
        $model= new Home;
        $items=$model->getItems();
        $this->render(compact('items'));
    }
    
    
    public function actionViewitem()
    {
        $model=new ViewItem;
        if(!$this->id())
        {
            return $this->goHome();
        }
        $model->id=$this->id();
        $itemMainInfo=$model->itemMainInfo();
        $itemAdditDescr=$model->itemAdditDescr();
        
        
        $this->render(compact('itemMainInfo','itemAdditDescr'));
    }
}
