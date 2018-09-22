<div class="outer-breadcrumb">   
    <div class="container">
        <ol class="breadcrumb">
            <?php 
            foreach($this->crumbs as $crumb) {
                if(isset($crumb['url'])) {
                    echo "<li>".CHtml::link($crumb['name'], $crumb['url'])."</li>";
                } else {
                    echo "<li class='active'>".$crumb['name']."</li>";
                }
                /*if(next($this->crumbs)) {
                    echo $this->delimiter;
                }*/
            }
            ?>
        </ol>
</div>
</div>