<?php 
$this->pageTitle=t('cms','Manage Blocks');
$this->pageHint=t('cms','Here you can manage your Blocks'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Block')); 
?>