<?php 
$this->pageTitle=t('cms','Manage Content List');
$this->pageHint=t('cms','Here you can manage your Content List'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'ContentList')); 
?>