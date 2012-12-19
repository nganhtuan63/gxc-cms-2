<?php 
$this->pageTitle=t('cms','Manage Users');
$this->pageHint=t('cms','Here you can view all members information of your site'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'User')); 
?>