<?php

return [
    "test_ls_goods"=>[
        "value_names"=>['id','name','price'],
        "values"=>[
            [1,'футболка',200],
            [2,'кросовки',1500],
            [3,'чемодан',4000],
            [4,'часы',2200],
        ],
    ],
    
    "test_ls_descript_items"=>[
        "value_names"=>['id','good_id','name','descr_value'],
        "values"=>[
            [1,1,'color','red'],
            [2,1,'color','blue'],
            [3,4,'mechanism','electronical'],
            [4,4,'mechanism','mechanical'],
            [5,1,'color','green'],
            [6,3,'size','M'],
            [7,3,'size','L'],
            [8,2,'modification','shoelaces'],
            [9,2,'modification','velcro'],
            [10,1,'size','small'],
            [11,1,'size','big'],
        ],
    ],
    
    "test_ls_descript_transl"=>[
        "value_names"=>['id','descr_item_id','lang','transl_value'],
        "values"=>[
            [1,1,'ua','червоний'],
            [2,1,'ru','красный'],
            [3,3,'ua','електронний'],
            [4,3,'ru','электронный'],
            [5,2,'ua','блакитний'],
            [6,2,'ru','синий'],
        ],
    ],
];

