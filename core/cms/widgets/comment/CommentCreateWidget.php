<?php
class CommentCreateWidget extends CWidget
{
	public $visible=true;
	
	public function init()
	{
	
	}
	
	public function run()
	{
		if($this->visible)
		{
			$this->renderContent();
		}
	}
	
	protected function renderContent()
	{
		$model = new Comment;
		
		if(isset($_POST['Comment']))
		{
			$model->attributes = $_POST['Comment'];
			if($model->save())
			{
				user()->setFlash('success',t('cms','Created Successfully!'));
			}
		}
		
		$this->render('cmswidgets.views.comment.comment_create_widget',array('model'=>$model));
	}
}
?>