<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'resource-grid',
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
		array('name'=>'resource_id',
			'type'=>'raw',
			'htmlOptions'=>array('class'=>'gridmaxwidth'),
			'value'=>'$data->resource_id',
		    ),
		array(
			'name'=>'resource_name',
			'type'=>'raw',
			'htmlOptions'=>array('class'=>'gridLeft'),
			'value'=>'CHtml::link($data->resource_name,array("'.app()->controller->id.'/view","id"=>$data->resource_id))',
		    ),
		array(
			'name'=>'resource_path',
			'type'=>'raw',
			'htmlOptions'=>array('class'=>'gridLeft'),
			'value'=>'GxcHelpers::renderTextBoxResourcePath($data)',
		    ),
        array(
			'name'=>'resource_type',
			'type'=>'raw',
			'htmlOptions'=>array('class'=>'gridLeft gridmaxwidth'),
			'value'=>'$data->resource_type',
		    ),
		array(
			'name'=>'where',
			'type'=>'raw',
			'htmlOptions'=>array('class'=>'gridLeft gridmaxwidth'),
			'value'=>'$data->where',
		    ),
		array(
			'header'=>'',			
			'type'=>'raw',
			'htmlOptions'=>array('class'=>'button-column'),
			'value'=>'GxcHelpers::renderLinkPreviewResource($data)',
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
			    'url'=>'Yii::app()->createUrl("'.app()->controller->id.'/update", array("id"=>$data->resource_id))',
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
<?php
//in your view where you want to include JavaScripts
$cs = Yii::app()->getClientScript();  
$cs->registerScript(
  'resource-field-handle',
  '
		function selectAllText(textbox) {
		    textbox.focus();
		    textbox.select();		    
		}
		$(".pathResource").click(function() { selectAllText(jQuery(this)) });
  ',
  CClientScript::POS_END
);
?>