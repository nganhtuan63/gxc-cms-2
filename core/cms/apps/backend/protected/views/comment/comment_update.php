<?php
	$this->pageTitle=t('cms','Edit Comment');
	$this->pageHint=t('cms','Update Comment');
?>
<?php $this->widget('cmswidgets.comment.CommentUpdateWidget',array()); ?>