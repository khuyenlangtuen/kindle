<?php

extract(array(
	'object_type' => 'product',
	'width' => (isset($pair->image_x) ? $pair->image_x : 100),
	'height' => (isset($pair->image_y) ? $pair->image_y : 100),
	'no_link' => true,
	'return_url' => false,
	'class' => '',
    'alt'=>'',
    'u'=>'',
    'no_seo'=>false,
    'have_src'=>false,
    'link_zoom'=>'',
), EXTR_SKIP);
//echo $link_zoom;
if ( isset($pair->id) && isset($pair->thumb_image) ) {
//	$img = CHtml::image('/', '', array('id' => 'image_'.$object_type.'_'.$pair->pair_id, 'alt' => '', 'border' => 0));
	if($no_seo)
        $img = img2($object_type,$have_src, $pair->thumb_image, $alt, array('id' => 'image_'.str_replace("/","",$object_type).'_'.$pair->id, 'border' => 0, 'itemprop' => 'image', 'class' => $class), array('width' => $width, 'height' => $height), $return_url);
	else if($link_zoom!="")
		$img = img2($object_type,$have_src, $pair->thumb_image, $alt, array('id' => 'image_'.str_replace("/","",$object_type).'_'.$pair->id, 'border' => 0, 'class' => $class , 'data-zoom-image'=>$link_zoom), array('width' => $width, 'height' => $height), $return_url);
    else
    	$img = img2($object_type,$have_src, $pair->thumb_image, $alt, array('id' => 'image_'.str_replace("/","",$object_type).'_'.$pair->id, 'border' => 0, 'class' => $class), array('width' => $width, 'height' => $height), $return_url);
    if ( $no_link ) {
		echo $img;
	} else {
		echo CHtml::link($img, '/', array('target' => '_blank')) ;
	}
} else {
	echo img2($object_type,$have_src, 'no_image.png', $alt, array('id' => 'image_'.str_replace("/","",$object_type).'_'.rand(1000, 9999), 'border' => 0, 'class' => $class), array('width' => $width, 'height' => $height));
	//echo CHtml::image(bu() . '/images/no_image.gif', '', array('alt' => '', 'border' => 0));
}
?>