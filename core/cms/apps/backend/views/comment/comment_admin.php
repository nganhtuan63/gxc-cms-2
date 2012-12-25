<?php 
$this->pageTitle=t('cms','Manage Comments');
$this->pageHint=t('cms','Approve/Disable Comments');
?>
<?php 
 $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Comment'));
?>
