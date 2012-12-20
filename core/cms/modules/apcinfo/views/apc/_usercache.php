<?php $this->widget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'user-cache-content',
	'options'=>array(
		'title'=>'Stored Value',
		'autoOpen'=>false,
		'width'=>800,
		'height'=>600,
	),
)); ?>
<?php $this->widget('zii.widgets.CMenu', array(
	'items'=>array(
		array(
			'label'=>'Clear cache',
			'url'=>$this->createUrl('clearUserCache'),
			'linkOptions'=>array(
				'confirm'=>'This will purge the entire user cache. Are you sure?',
			),
		),
	),
)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>new CArrayDataProvider($userCacheList, array(
		'keyField'=>'info',
		'sort'=>array(
			'attributes'=>array(
				'info',
				'num_hits',
				'mem_size',
				'access_time',
				'mtime',
				'creation_time',
				'deletion_time',
				'ttl',
			),
			'defaultOrder'=>array(
				'num_hits'=>true,
			),
		),
	)),
	'formatter'=>$formatter,
	'columns'=>array(
		'info:text:Label',
		'num_hits:number:Hits',
		'mem_size:datasize:Size',
		'access_time:datetime:Last accessed',
		'mtime:datetime:Last modified',
		'creation_time:datetime:Created at',
		array(
			'name'=>'deletion_time',
			'type'=>'datetime',
			'header'=>'Deleted at',
			'value'=>'($data["deletion_time"]===0) ? null : $data["deletion_time"]',
		),
		array(
			'name'=>'ttl',
			'type'=>'number',
			'header'=>'Timeout [s]',
			'value'=>'($data["ttl"]===0) ? null : $data["ttl"]',
		),
		array(
			'class'=>'zii.widgets.grid.CButtonColumn',
			'template'=>'{view} {delete}',
			'viewButtonUrl'=>'$this->grid->controller->createUrl("view", array("key"=>$data["info"]))',
			'viewButtonOptions'=>array(
				'onclick'=>'$.ajax({
					url: $(this).attr("href"),
					success: function(data) {
						$("#user-cache-content").html(data).dialog("open");
					},
					error: function(xhr) {
						alert("Error " + xhr.status + ": " + xhr.responseText);
					}
				}); return false;',
			),
			'deleteButtonUrl'=>'$this->grid->controller->createUrl("delete", array("key"=>$data["info"]))',
		),
	),
));