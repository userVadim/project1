<?php

namespace app\models;
use app\core\DB as DB;

class Viewitem extends DB {
    
    public $id;
    
    public function itemMainInfo()
    { 
        if($this->id)
        {
            $info=$this->prepare("SELECT * FROM test_ls_goods WHERE id=?");
            $info->execute([$this->id]);           

            return $info->fetch(DB::FETCH_ASSOC);
        }
    }
    
    public function itemAdditDescr()
    {
        
        $descrParams=$this->prepare(" SELECT d.*, l.transl_value, l.lang FROM test_ls_descript_items d"
                                    . " LEFT JOIN test_ls_descript_transl l"
                                    . " ON d.id=l.descr_item_id"
                                    . " WHERE good_id=?");
        $descrParams->execute([$this->id]);
        while($row=$descrParams->fetch(DB::FETCH_ASSOC))
        {
           $result[]=$row; 
        }
        return $this->sortDescript($result);
    }
    
    private function sortDescript($arr)
    { 
        foreach ($arr as $val)
        {
            $res[$val['name']][$val['id']]['value']=$val['descr_value'];
            $res[$val['name']][$val['id']]['id']=$val['id'];
            $res[$val['name']][$val['id']]['transl'][$val['lang']]=$val['transl_value'];
        }
        foreach($res as $key=>$descr)
        {
            $res[$key]= array_values($descr);
        }
        return $res;
    }
}
