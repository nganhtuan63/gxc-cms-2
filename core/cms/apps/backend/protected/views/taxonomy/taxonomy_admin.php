<?php 
$this->pageTitle=t('cms','Manage Taxonomy');
$this->pageHint=t('cms','Here you can manage your Taxonomy'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Taxonomy')); 
?>