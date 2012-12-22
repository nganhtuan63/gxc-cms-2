<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'taxonomy-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText'=>t('cms','Displaying').' {start} - {end} '.t('cms','in'). ' {count} '.t('cms','results'),
	'pager' => array(
		'header'=>t('cms','Go to page:'),
		'nextPageLabel' =>  t('cms','Next'),
		'prevPageLabel' =>  t('cms','previous'),
		'firstPageLabel' =>  t('cms','First'),
		'lastPageLabel' =>  t('cms','Last'),
                'pageSize'=> Yii::app()->settings->get('system', 'page_size')
	),
	'columns'=>array(
		array('name'=>'page_id',
			'type'=>'raw',
			'htmlOptions'=>array('class'=>'gridmaxwidth'),
			'value'=>'$data->page_id',
		    ),
                array(
			'name'=>'name',
			'type'=>'raw',
			'htmlOptions'=>array('class'=>'gridLeft'),
			'value'=>'CHtml::link($data->name,array("'.app()->controller->id.'/view","id"=>$data->page_id))',
		    ),
                'layout',
                 array(
                        'name'=>'lang',
			'type'=>'raw',			
			'value'=>'GxcHelpers::convertLanguage($data->lang)',                   
                ),
                array
		(
		    'class'=>'CButtonColumn',
		    'template'=>'{translate}',
		    'visible'=>count((GxcHelpers::getAvailableLanguages())>1),
		    'buttons'=>array
		    (
			'translate' => array
			(
			   'label'=>t('cms','Translate'),
			    'imageUrl'=>false,
			    'url'=>'Yii::app()->createUrl("'.app()->controller->id.'/create", array("guid"=>$data->guid))',
			),
		    ),
		), 
		                 			
		array
		(
		    'class'=>'CButtonColumn',
		    'template'=>'{update}',
		    'buttons'=>array
		    (
			'update' => array
			(
			    'label'=>t('cms','Edit'),
			    'imageUrl'=>false,
			    'url'=>'Yii::app()->createUrl("'.app()->controller->id.'/update", array("id"=>$data->page_id))',
			),
		    ),
		),
                array
		(
		    'class'=>'CButtonColumn',
		    'template'=>'{delete}',
		    'buttons'=>array
		    (
			'delete' => array
			(
                            'label'=>t('cms','Delete'),
			    'imageUrl'=>false,
			),

		    ),
		),
		
	),
)); ?>
