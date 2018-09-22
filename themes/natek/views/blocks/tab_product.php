<div class="container tabs-product">
	<ul class="tabs">
		<li class="tab-link current" data-tab="tab-1"><?php echo DModels::get_general('new_product',$_SESSION['language'],true);?></li>
		<li class="tab-link" data-tab="tab-2"><?php echo DModels::get_general('hightlights_product',$_SESSION['language'],true);?></li>
		<li class="tab-link" data-tab="tab-3"><?php echo DModels::get_general('promotion_product',$_SESSION['language'],true);?></li>
	</ul>

	<div id="tab-1" class="tab-content current">
		<?php $this->renderPartial("//blocks/new_product") ?>
	</div>
	<div id="tab-2" class="tab-content">
		<?php $this->renderPartial("//blocks/noibat_product") ?>
	</div>
	<div id="tab-3" class="tab-content">
		
        <?php $this->renderPartial("//blocks/km_product") ?>
	</div>
</div>