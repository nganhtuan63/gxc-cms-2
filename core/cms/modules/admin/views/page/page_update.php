<?php 
$this->pageTitle=t('cms','Update Page');
$this->pageHint=t('cms','Here you can update information for current Page'); 
?>
<?php 
$add_existed_block_url=Yii::app()->controller->createUrl('block/suggestblock',array('embed'=>'iframe'));    
$add_new_block_url=Yii::app()->controller->createUrl('block/create',array());    
$update_block_url=Yii::app()->controller->createUrl('block/update',array('embed'=>'iframe')); 
$this->widget('cmswidgets.page.PageUpdateWidget',array(
    'add_existed_block_url'=>$add_existed_block_url,
    'add_new_block_url'=>$add_new_block_url,
    'update_block_url'=>$update_block_url,    
)); 
?>