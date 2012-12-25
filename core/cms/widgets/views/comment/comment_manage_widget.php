<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comment-grid',
	'ajaxUpdate'=>false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
			array(
			'name'=>'comment_id',
			'type'=>'raw',
			'htmlOptions'=>array('style'=>'text-align :center'),
			'value'=>'$data->comment_id',
		    ),
			
			array(
					'name'=>'comment_title',
					'type'=>'raw',
					'htmlOptions'=>array('class'=>'gridLeft','style'=>'width:150px !important'),
					'value'=>'CHtml::link($data->comment_title,array("comment/view", "id"=>$data->comment_id))',
			),
			
			array(
					'name'=>'comment_content',
					'type'=>'raw',
					'htmlOptions'=>array('class'=>'gridLeft','style'=>'width:700px !important'),
					'value'=>'$data->comment_content!=$data->comment_modified_content 
                    ? "<span id=\"comment_id_".$data->comment_id."\" style=\"color:#11038D;\">".CHtml::encode($data->comment_modified_content)."</span>"
                    : "<span id=\"comment_id_".$data->comment_id."\">".CHtml::encode($data->comment_modified_content)."</span>"', 
			),
			
			array(
					'name'=>'object_id',
					'type'=>'raw',
					'htmlOptions'=>array('class'=>'gridmaxwidth','style'=>'width:150px !important'),
					'value'=>'CHtml::link($data->object->object_title,array("object/view","id"=>$data->object->object_id))',
			),
			
			array(
					'name'=>'comment_author',
					'type'=>'raw',
					'htmlOptions'=>array('class'=>'gridmaxwidth','style'=>'width:150px !important'),
					'value'=>'$data->comment_author'
			),
			
			array(
					'name'=>'comment_author_email',
					'type'=>'raw',
					'value'=>'$data->comment_author_email'
			),
			
			array(
					'name'=>'comment_approved',
					'type'=>'image',
					'value'=>'Comment::convertCommentState($data)'					
			),
			
			array(
					'class'=>'CButtonColumn',
					'template'=>'{update}',
					'buttons'=>array
					(
							'update'=> array(
								'label'=>t('cms','Edit'),
								'imageUrl'=>false,
								'url'=>'Yii::app()->createUrl("comment/update",array("id"=>$data->comment_id,"page"=>isset($_GET["Comments_page"])?$_GET["Comments_page"]:1))',
							),		
					),
			),
			
			array(
					'class'=>'CButtonColumn',
					'template'=>'{approve}',
					'buttons'=>array(
							
							'approve'=> array(
									
									'label'=>t('cms','Approve'),
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("comment/approve",array("id"=>$data->comment_id,"page"=>isset($_GET["Comment_page"])? $_GET["Comment_page"] : 1))',
									'visible'=>'$data->comment_approved == Comment::STATUS_PENDING',
							),
					),
			),
			
			array(
					'class'=>'CButtonColumn',
					'template'=>'{disabled}',
					'buttons'=>array(
								
							'disabled'=> array(
										
									'label'=>t('cms','Disabled'),
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("comment/disabled",array("id"=>$data->comment_id,"page"=>isset($_GET["Comment_page"])? $_GET["Comment_page"] : 1))',
									'visible'=>'$data->comment_approved != Comment::STATUS_PENDING'
							),
					),
			),

			array
			(
				'class'=>'CButtonColumn',
				'template'=>'{delete}',
				'buttons'=>array(
							
					'delete'=>array(
							
							'label'=>t('cms','Delete'),
							'imageUrl'=>false,
							'url'=>'Yii::app()->createUrl("comment/delete",array("id"=>$data->comment_id,"page"=>isset($_GET["Comment_page"])? $_GET["Comment_page"] : 1))',
					),		
				),	
			),
	),
)); ?>