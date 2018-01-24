<?php

include '../ajaxDBConnect.php';


$params=$_POST['params'];

$item_id=$params[0]['item_id'];
$fullID=$item_id;

foreach($params as $val)
{
    $descr_name=explode("_",$val['category']);
    $descr_name=$descr_name[0];
    
    $descr_suf= substr($descr_name, 0,3);
    
    $descr_value=explode(",",$val['selected']);
    $descr_value=trim($descr_value[0]);
    
    $a=$db->prepare(" SELECT id FROM test_ls_descript_items "
            . " WHERE good_id=:item_id AND name=:descr_name AND descr_value=:descr_value");
    $a->execute(['item_id'=>$item_id, 'descr_name'=>$descr_name,'descr_value'=>$descr_value]);        
      
    $result=$a->fetch(PDO::FETCH_ASSOC);
    
    
    $fullID.=".".$result['id'];
}

echo $fullID;