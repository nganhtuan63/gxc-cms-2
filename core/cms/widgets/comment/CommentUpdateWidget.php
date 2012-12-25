<?php 
class CommentUpdateWidget extends CWidget
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
		$id =isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
		$page =isset($_GET['page']) ? (int) ($_GET['page']) : 0 ;
		
		$model = GxcHelpers::loadDetailModel('Comment', $id);
		
		$prev_status = $model->comment_approved;
		
		if(isset($_POST['Comment']))
		{
			$model->attributes = $_POST['Comment'];
				
			if($model->save())
			{
				if($prev_status != $model->comment_approved)
				{
		
					if($model->comment_approved == Comment::STATUS_APPROVED )
					{
						$object = Object::model()->findbyPk($model->object_id);
						if($object != null)
						{
							$tempCommentCount = $object->comment_count;
							$tempCommentCount++;
							$object_comment_count = $tempCommentCount;
							$object->save();
						}
					}
					else if($model->comment_approved == Comment::STATUS_PENDING)
					{
						$object = Object::model()->findbyPk($model->object_id);
						if($object != null)
						{
							$tempCommentCount = $object->comment_count;
							$tempCommentCount--;
							$object_comment_count = $tempCommentCount;
							$object->save();
								
						}
					}
				}
		
				user()->setFlash('success',t('cms','Updated Successfully!')); 
				
			}
		}
		
		$this->render('cmswidgets.views.comment.comment_update_widget',array('model'=>$model,));
	}
		
}
?>
