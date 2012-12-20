<?php Yii::app()->getClientScript()->registerCssFile($this->module->getAssetsUrl() . '/filecache.css'); ?>
<?php $this->widget('zii.widgets.CMenu', array(
	'items'=>array(
		array(
			'label'=>'Clear cache',
			'url'=>$this->createUrl('clearFileCache'),
			'linkOptions'=>array(
				'confirm'=>'This will purge the entire opcode cache. Are you sure?',
			),
		),
		array(
			'label'=>'Clear outdated',
			'url'=>$this->createUrl('clearOutdated'),
			'linkOptions'=>array(
				'confirm'=>'This will purge all opcode cache entries that are no longer in sync with the filesystem. Are you sure?',
			),
		),
	),
)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>new CArrayDataProvider($fileCacheList, array(
		'keyField'=>'filename',
		'sort'=>array(
			'attributes'=>array(
				'filename',
				'num_hits',
				'mem_size',
				'access_time',
				'mtime',
				'creation_time',
				'deletion_time',
			),
			'defaultOrder'=>array(
				'num_hits'=>true,
			),
		),
	)),
	'formatter'=>$formatter,
	'rowCssClassExpression'=>'(filemtime($data["filename"]) > $data["mtime"]) ? "outdated" : $this->rowCssClass[$row % count($this->rowCssClass)]',
	'columns'=>array(
		'filename:text:Script Filename',
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
	),
));