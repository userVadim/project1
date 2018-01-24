<?php

return [
    'CREATE TABLE IF NOT EXISTS test_ls_goods 
    (
        id INT(11) NOT NULL AUTO_INCREMENT, 
        PRIMARY KEY(id),
        name VARCHAR(256), 
        price INT(11)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8',
    
    'CREATE TABLE IF NOT EXISTS test_ls_descript_items 
    (
        id INT(11) NOT NULL AUTO_INCREMENT, 
        PRIMARY KEY(id),
        good_id INT(11),
        INDEX(good_id),
        name VARCHAR(256),
        descr_value  VARCHAR(256)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8',
    
    'CREATE TABLE IF NOT EXISTS test_ls_descript_transl
    (
        id INT(11) NOT NULL AUTO_INCREMENT, 
        PRIMARY KEY(id),
        descr_item_id INT(11), 
        INDEX(descr_item_id),
        lang VARCHAR(10),
        transl_value VARCHAR(256)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8',
];
