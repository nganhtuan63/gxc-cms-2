<?php 
$this->pageTitle=t('cms','Add new Resource');
$this->pageHint=t('cms','Here you can add new Resource'); 
?>
<?php $this->renderPartial('_resource_form',array('model'=>$model,'is_new'=>$is_new,'types_array'=>$types_array)); ?>