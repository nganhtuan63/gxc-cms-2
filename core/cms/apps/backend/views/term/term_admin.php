<?php 
$this->pageTitle=t('cms','Manage Terms');
$this->pageHint=t('cms','Here you can manage your Terms. <br /> <b>Note: </b>When you delete a Term, all contents belong to that Term will be moved to Uncategory Term'); 
?>
<?php $this->widget('cmswidgets.ModelManageWidget',array('model_name'=>'Term')); 
?>