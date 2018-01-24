<?php
namespace app\models;
use app\core\DB as DB;

class Home {
    public function getItems()
    {
        $res=new DB;
        $result=$res->prepare(" SELECT * FROM test_ls_goods ");
        $result->execute();
        while($row=$result->fetch(DB::FETCH_ASSOC))
        {
            $items[]=$row;
        }
        return $items;
    }
}
