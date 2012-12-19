<?php 
$this->pageTitle=t('cms','Manage Pages');
$this->pageHint=t('cms','Here you can manage your Pages'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Page')); 
?>