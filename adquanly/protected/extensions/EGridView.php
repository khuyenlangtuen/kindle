<?php

Yii::import('zii.widgets.grid.CGridView');

class EGridView extends CGridView
{
	public $template="<div class='top-panel'>{pagesize}{pager}\n{summary}</div>\n{items}\n{pager}";

	public function init()
    {
		// change some default value
		$this->itemsCssClass = 'table';

		parent::init();
    }

	public function renderPagesize() {
		$pageSize = $this->dataProvider->pagination->pageSize;

		echo '<div class="pageSize">Hiển thị ';
		echo CHtml::dropDownList('pageSize', $pageSize, array(
			10 => 10, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 100 => 100, 200 => 200, 500 => 500, 1000 => 1000,
		), array(
			'onchange' => 'location.href = location.href + \'&pageSize=\' + this.value;',
		));
		echo ' / trang</div>';
	}

	public function renderItems()
	{
		if($this->dataProvider->getItemCount()>0 || $this->showTableOnEmpty)
		{
			echo "<table class=\"{$this->itemsCssClass}\" width='100%' cellpadding='0' cellspacing='0' border='0'>\n";
			$this->renderTableHeader();
			ob_start();
			$this->renderTableBody();
			$body=ob_get_clean();
			$this->renderTableFooter();
			echo $body; // TFOOT must appear before TBODY according to the standard.
			echo "</table>";
		}
		else
			$this->renderEmptyText();
	}
}