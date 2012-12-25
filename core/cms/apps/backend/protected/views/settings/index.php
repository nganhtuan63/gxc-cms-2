<?php 
$this->pageTitle=t('cms','Manage Settings');
$this->pageHint=t('cms','Here you can manage all Site Settings'); 
?>
<?php $this->widget('cmswidgets.settings.SettingsWidget',array()); 
?>