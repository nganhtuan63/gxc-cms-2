<?php 
$this->pageTitle=t('cms','Manage Resource');
$this->pageHint=t('cms','Here you can manage your Resource'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Resource')); 
?>