<?php

class MyLinkPagerAjax extends CLinkPager
{
  const CSS_FIRST_PAGE='first';
	const CSS_LAST_PAGE='last';
	const CSS_PREVIOUS_PAGE='previous';
	const CSS_NEXT_PAGE='next';
	const CSS_INTERNAL_PAGE='page';
	const CSS_HIDDEN_PAGE='disabled';
	const CSS_SELECTED_PAGE='active';
	// Add my custom pager css where I remove the hidden property from the first and the last item.
  public function __construct() {
   // $this->cssFile = Yii::app()->request->baseUrl.'/themes/v2/css/mypager.css';
  }
  
  /**
         * Creates the page buttons.
         * @return array a list of page buttons (in HTML code).
         */
        protected function createPageButtons()
        {
        		$pageCount=$this->getPageCount();
                if($pageCount<=1)
                        return array();

                list($beginPage,$endPage)=$this->getPageRange();
                $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
                $buttons=array();

                // first page
               // if($currentPage <=1)
                //  $buttons[]=$this->createPageButton($this->firstPageLabel,0,self::CSS_FIRST_PAGE,false,false);

                // prev page
                if(($page=$currentPage-1)<0)
                        $page=0;
                if($currentPage >= 1)      
                  $buttons[]=$this->createPageButton('<i class="fa fa-angle-left"></i>',$page,self::CSS_PREVIOUS_PAGE,$currentPage<=0,false);

                // internal pages
                for($i=$beginPage;$i<=$endPage;++$i)
                        $buttons[]=$this->createPageButton($i+1,$i,self::CSS_INTERNAL_PAGE,false,$i==$currentPage);

                // next page
                if(($page=$currentPage+1)>=$pageCount-1)
                        $page=$pageCount-1;
                if($currentPage < $pageCount-1)
                  $buttons[]=$this->createPageButton('<i class="fa fa-angle-right"></i>',$page,self::CSS_NEXT_PAGE,$currentPage>=$pageCount-1,false);

                // last page
                //$buttons[]=$this->createPageButton($this->lastPageLabel,$pageCount-1,self::CSS_LAST_PAGE,$endPage>=$pageCount-1,false);

                return $buttons;
        }

  /**
         * Creates the default pagination.
         * This is called by {@link getPages} when the pagination is not set before.
         * @return CPagination the default pagination instance.
         */
        protected function createPages()
        {
                return new MyPaginationAjax;
        }
        protected function createPageButton($label,$page,$class,$hidden,$selected)
    	{
    		if($hidden || $selected)
    			$class.=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
    		return '<span id="trang_'.$page.'" class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page)).'</span>';
    	}
}
