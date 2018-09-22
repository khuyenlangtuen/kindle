<?php
if(!empty($sp))
{
    ?>
    
    <div class="table-responsive" style="overflow: hidden;">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>Mã SP</th>
                        <th>Hình ảnh</th>
                        <th>Giá tiền</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   
                   $l_sp=json_decode($sp->detail);
                    foreach($l_sp as $key=>$row)
                    {
                        if($row)
                        {
                            $item=json_decode($row);
                            $c='odd';
                            if($key%2==0)
							     $c='even';
                            ?>
                            <tr class="<?php echo $c;?> gradeA">
                                    <td><?php echo $item->ma_sp;?></td>
                                    <td><img src="<?php echo $item->thumb_small;?>" /></td>
                                    <td><?php echo number_format($item->gia_sp);?></td>
                                    <td class="center"><?php echo $item->count?></td>
                                    <td class="center"><?php echo number_format($item->thanhtien)?></td>
                            </tr>
                            
                            <?php
                            
                        }
                    }
                   
                   ?> 
                    
                </tbody>
            </table>
    </div>
    <?php
    
}
?>