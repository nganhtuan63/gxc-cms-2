<?php
$this->pageTitle = t('cms','View Comment'). $model->comment_id;
?>
<?php $this->widget('cmswidgets.ModelViewWidget',array('model_name'=>'Comment'));
 ?>

