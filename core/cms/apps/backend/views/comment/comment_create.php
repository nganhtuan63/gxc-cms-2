<?php 
$this->pageTitle=t('cms','Add new Comment');
$this->pageHint=t('cms','Create new Comment');
?>

<?php 
$this->widget('cmswidgets.comment.CommentCreateWidget',array());
?>