<?php 
$this->pageTitle=t('cms','Add new Item');
$this->pageHint=t('cms','Here you can add new Item to current Menu'); 
?>
<?php 

$this->widget('cmswidgets.page.MenuItemCreateWidget',array()); 
?>