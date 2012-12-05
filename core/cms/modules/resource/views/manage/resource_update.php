<?php 
$this->pageTitle=t('cms','Update Resource');
$this->pageHint=t('cms','Here you can update information for current Resource'); 
?>
<?php $this->renderPartial('_resource_form',array('model'=>$model,'is_new'=>$is_new,'types_array'=>$types_array)); ?>