<?php 
$this->pageTitle=t('cms','Add new Resource');
$this->pageHint=t('cms','Here you can add new Resource'); 
?>
<?php $this->widget('cmswidgets.resource.ResourceCreateWidget',array()); 
?>