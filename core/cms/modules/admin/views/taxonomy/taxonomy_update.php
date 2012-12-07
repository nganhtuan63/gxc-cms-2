<?php 
$this->pageTitle=t('cms','Update Taxonomy');
$this->pageHint=t('cms','Here you can update information for current Taxonomy'); 
?>
<?php 
$form_create_url=Yii::app()->controller->createUrl('term/create',array('embed'=>'iframe','taxonomy'=>$id));    
$form_update_url=Yii::app()->controller->createUrl('term/update',array('embed'=>'iframe','taxonomy'=>$id));    
$form_change_order_url=Yii::app()->controller->createUrl('term/changeorder',array());    
$form_delete_url=Yii::app()->controller->createUrl('term/delete',array());  
$this->widget('cmswidgets.object.TaxonomyUpdateWidget',array(
    'form_create_term_url'=>$form_create_url,
    'form_update_term_url'=>$form_update_url,
    'form_delete_term_url'=>$form_delete_url,
    'form_change_order_term_url'=>$form_change_order_url,
        )); 
?>