<?php 
$this->pageTitle=t('cms','Manage Menu');
$this->pageHint=t('cms','Here you can manage your Menu'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Menu')); 
?>