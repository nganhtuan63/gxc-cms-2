<?php 
$this->pageTitle=t('cms','Caching Management');
$this->pageHint=t('cms','Here you can clear Cache & Assets for Backend and Frontend'); 
?>
<?php $this->widget('cmswidgets.caching.CachingClearWidget',array()); 
?>