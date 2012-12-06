<?php 
$this->pageTitle=t('cms','Update Content list');
$this->pageHint=t('cms','Here you can update information for current Content list'); 
?>
<?php $this->widget('cmswidgets.page.ContentListUpdateWidget',array('object_update_url'=>'beobject/update')); ?>