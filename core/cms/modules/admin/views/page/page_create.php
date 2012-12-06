<?php 
$this->pageTitle=t('cms','Add new Page');
$this->pageHint=t('cms','Here you can add new Page for your Site'); 

?>

<?php 
$add_existed_block_url=Yii::app()->controller->createUrl('block/suggestblock',array('embed'=>'iframe'));    
$add_new_block_url=Yii::app()->controller->createUrl('block/create',array());    
$update_block_url=Yii::app()->controller->createUrl('block/update',array('embed'=>'iframe'));  
$this->widget('cmswidgets.page.PageCreateWidget',array(
    'add_existed_block_url'=>$add_existed_block_url,
    'add_new_block_url'=>$add_new_block_url,
    'update_block_url'=>$update_block_url,
    
)); 
?>