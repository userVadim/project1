
<div class="home">
    <?php
        foreach($this->data['items'] as $item)
        {
            ?>
                <div class="item">
                    <p>Name: <?=$item['name']?></p>
                    <p>Price: <?=$item['price']?></p>
                    <a href="index.php?site=littleshop&p=viewitem&id=<?=$item['id']?>">View item</a>
                </div>
            <?php
        }
    ?>
</div>
