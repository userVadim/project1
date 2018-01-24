$(document).ready(function(){
    
    var params=[];
    
    getSelected();
    
    $('select').change(function(){
        getSelected()
    });
    
    function getSelected()
    {
        $('select').each(function(){
            var selected=$(this).val();
            var item_id=$("#item_id").attr('val');
            var category=$(this).attr('id');
            var arr={'item_id':item_id, 'category':category, 'selected':selected, };
            params.push(arr);
        })
        
        $.ajax({
                type:"POST",
                url:'ajax/littleshop/getSelectedID.php',
                data:{
                    params:params,
                },
                success: function(data)
                {
                    $("#item_id").html(data);
                    params=[];
                }
        })
        
        
    }
})

