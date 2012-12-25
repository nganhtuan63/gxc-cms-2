<?php $this->widget('zii.widgets.CDetailView',array(
		
			'data'=>$model,
			'attributes'=> array(
					
					'comment_id',
					array(
							'name'=>'object_id',
							'type'=>'raw',
							'value'=>CHtml::link($model->object->object_title,array("object/view","id"=>$model->object->object_id)),
					),
					'comment_title',
					'comment_modified_content',
					'comment_content',
					array(
							'name'=>'comment_date',
							'type'=>'raw',
							'value'=>date('Y-m-d H:i:s',$model->comment_date),
					),
					'comment_author',
					'comment_author_email',
					'comment_author_url',
					'comment_author_IP',
					'comment_agent',					
			),
		) 
		
);

?>