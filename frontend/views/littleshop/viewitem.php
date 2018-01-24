<div class="curr_item">
    <table>
        <tr>
            <td>Name:</td>
            <td><?=$this->data['itemMainInfo']['name']?></td>
        </tr>
        <tr>
            <td>Price:</td>
            <td><?=$this->data['itemMainInfo']['price']?></td>
        </tr>
        <tr>
            <td>Check id via ajax:</td>
            <td id='item_id' val='<?=$this->data['itemMainInfo']['id']?>'><?=$this->data['itemMainInfo']['id']?></td>
        </tr>
        <?php
        foreach($this->data['itemAdditDescr'] as $descrName=>$descrVals)
        {
            ?>
            <tr>
                <td><?= ucfirst($descrName)?>:</td>
                <td>
                    <select id="<?=$descrName?>_select">
                        <?php
                        foreach($descrVals as $vals)
                        {
                            ?>
                            <option id="<?=$descrName."_".$vals['id']?>">       <!-- We can use this id instead ajax, but I'll go in more difficult way -->
                                    <?php
                                        echo $vals['value'];
                                        foreach($vals['transl'] as $trans)
                                        {
                                            if($trans)
                                            {
                                                echo ", ".$trans;
                                            }
                                        }
                                    ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>

