<?php

class CommentController extends BeController
{
    public function __construct($id,$module=null)
	{
		 parent::__construct($id,$module);
                 $this->menu=array(
                        array('label'=>t('cms','Manage Comments'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'button')),
                        
                );
		 
	}
	

	public function actionIndex()
	{
		$model=new Comment('cms','search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];
	
		$this->render('comment_admin',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comment('cms','search');		
		
		$model->unsetAttributes();  // clear any default values		
		if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];
				
		
		$this->render('comment_admin',array(
				'model'=>$model,				
		));
	}
	
	public function actionUpdate($id,$page=1)
	{
		$this->menu=array_merge($this->menu,
				array(
						array('label'=>t('cms','View this user'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'button')),
						array('label'=>t('cms','Delete this user'), 'url'=>array('delete','id'=>$id),'linkOptions'=>array('submit'=>array('delete','id'=>$id),'confirm'=>'Are you sure you want to delete this item?','class'=>'button'))
				)
		);
				
		$id =isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
				
		
		$this->render('comment_update',array());
	}
	
	public function actionApprove($id,$page)
	{
		$model = $this->loadModel($id);
		if($model->comment_approved != Comment::STATUS_APPROVED)
		{
			$model->comment_approved = Comment::STATUS_APPROVED;
			if($model->save())
			{
				$object = Object::model()->findByPk($model->object_id);
				if($object != null)
				{
					$temp_comment_count=$object->comment_count;
					$temp_comment_count++;
					$object->comment_count=$temp_comment_count;
					$object->save();
				}
			}
		}
		
		$this->redirect(array('admin?comments_page='.$page.'#comment_id_'.$id));
	}
	
	public function actionDisabled($id,$page)
	{
		$model = $this->loadModel($id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if($model->comment_approved != Comment::STATUS_PENDING){
			$model->comment_approved = Comment::STATUS_PENDING;
			if($model->save()){
				$object=Object::model()->findbyPk($model->object_id);
				if($object!=null){
					$temp_comment_count=$object->comment_count;
					$temp_comment_count--;
					$object->comment_count=$temp_comment_count;
					$object->save();
				}
			}
		}
		$this->redirect(array('admin?comments_page='.$page.'#comment_id_'.$id));
	}
	
	public function actionDelete($id,$page)
	{
		$model = $this->loadModel($id);
		
		if(isset($model) && $model->delete())
		{
			if($model->comment_approved==Comment::STATUS_APPROVED){
				$object=Object::model()->findbyPk($model->object_id);
				if($object!=null){
					$temp_comment_count=$object->comment_count;
					$temp_comment_count--;
					$object->comment_count=$temp_comment_count;
					$object->save();
			
				}					
			}
			
			$this->redirect(array('admin?comments_page='.$page.'#comment_id_'.$id));
		}
		
	}
	
	public function actionView($id)
	{
				
		$this->menu=array_merge($this->menu,
				array(
						array('label'=>t('cms','Update this user'), 'url'=>array('update','id'=>$id),'linkOptions'=>array('class'=>'button')),
						array('label'=>t('cms','Delete this user'), 'url'=>array('delete','id'=>$id),'linkOptions'=>array('submit'=>array('delete','id'=>$id),'confirm'=>'Are you sure you want to delete this item?','class'=>'button'))
				)
		);
		
		$this->render('comment_view',array(
				'model'=>$this->loadModel($id),
		));
	}	

	public function actionCreate()
	{
		$model = new Comment;
		
		if(isset($_POST['Comment']))
		{
			$model->attributes = $_POST['Comment'];
			if($model->save())
			{
				$this->redirect('cms','view',array('id'=>$model->comment_id));
			}
		}
		
		$this->render('comment_create',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Comment::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,t('cms','The requested page does not exist.'));
		return $model;
	}
	
}