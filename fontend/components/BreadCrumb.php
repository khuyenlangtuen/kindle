<?php
class BreadCrumb extends CWidget {
 
    public $crumbs = array();
    public $delimiter = ' &raquo; ';
 
    public function run() {
        $this->render('breadCrumb');
    }
 
}
?>