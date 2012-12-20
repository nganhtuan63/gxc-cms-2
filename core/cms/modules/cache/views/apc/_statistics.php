<?php Yii::app()->getClientScript()->registerCssFile($this->module->getAssetsUrl() . '/fragmentation.css'); ?>
<?php Yii::app()->getClientScript()->registerCssFile($this->module->getAssetsUrl() . '/stats.css'); ?>
<div class="column span-12">
	<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'General Information',
	)); ?>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$info,
		'formatter'=>$formatter,
		'attributes'=>array(
			'apc_version:text:APC Version',
			'php_version:text:PHP Version',
			'host:text:APC Host',
			'server_software:text',
			'shared_memory:text',
			'memory_type:text',
			'start_time:datetime',
			'start_time:duration:Uptime',
			'file_upload_support:boolean',
		),
	)); ?>
	<?php $this->endWidget(); ?>
</div>

<div class="column span-6">
	<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'File Cache Information',
	)); ?>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$fileCache,
		'formatter'=>$formatter,
		'attributes'=>array(
			'cached_files:number',
			'cached_file_size:datasize',
			'hits:number',
			'misses:number',
			'request_rate:rate',
			'hit_rate:rate',
			'miss_rate:rate',
			'insert_rate:rate',
			array(
				'name'=>'cache_full_count',
				'type'=>'number',
				'label'=>'Cache full count',
				'cssClass'=>'full',
				'visible'=>($fileCache['cache_full_count']>0),
			),
			array(
				'name'=>'cache_full_count',
				'type'=>'number',
				'label'=>'Cache full count',
				'visible'=>($fileCache['cache_full_count']==0),
			),
		),
	)); ?>
	<?php $this->endWidget(); ?>
</div>

<div class="column span-6 last">
	<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'User Cache Information',
	)); ?>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$userCache,
		'formatter'=>$formatter,
		'attributes'=>array(
			'cached_entries:number',
			'cached_entry_size:datasize',
			'hits:number',
			'misses:number',
			'request_rate:rate',
			'hit_rate:rate',
			'miss_rate:rate',
			'insert_rate:rate',
			array(
				'name'=>'cache_full_count',
				'type'=>'number',
				'label'=>'Cache full count',
				'cssClass'=>'full',
				'visible'=>($userCache['cache_full_count']>0),
			),
			array(
				'name'=>'cache_full_count',
				'type'=>'number',
				'label'=>'Cache full count',
				'visible'=>($userCache['cache_full_count']==0),
			),
		),
	)); ?>
	<?php $this->endWidget(); ?>
</div>

<div class="clear"></div>

<div class="column span-24">
	<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'Cache Fragmentation',
	)); ?>
	<div class="fragmentation-container">
	<?php
		foreach($blocks as $block)
			echo CHtml::tag('div', array(
				'class'=>$block['free'] ? 'free' : 'used',
				'style'=>'width: '.(int)$block['percent'].'%',
				'title'=>($block['free'] ? 'Free' : 'Used') . " block with {$formatter->formatDatasize($block['size'])} (Segment {$block['segment']} | Offset {$formatter->formatNumber($block['offset'])})",
			), '', true);
	?>
	</div>
	Fragmentation:
	<div class="right">
	<?php if($fragInfo['freesegs'] > 1): ?>
		<span title="<?php echo $formatter->formatDatasize($fragInfo['fragsize']); ?> out of <?php echo $formatter->formatDatasize($fragInfo['freetotal']);?> in <?php echo $fragInfo['freesegs']; ?> segments"><?php echo round($fragInfo['fragsize']/$fragInfo['freetotal']*100, 3); ?>%</span>
	<?php else: ?>
		0.00%
	<?php endif; ?>
	</div>
	<?php $this->endWidget(); ?>
</div>
<div class="column span-24 last">
	<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'Runtime Settings'
	)); ?>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>new CArrayDataProvider($iniSettings, array(
			'sort'=>array(
				'attributes'=>array(
					'id',
					'access',
				),
				'defaultOrder'=>array(
					'id'=>false,
				),
			),
			'pagination'=>array(
				'pageSize'=>15,
			),
		)),
		'formatter'=>$formatter,
		'columns'=>array(
			array(
				'name'=>'id',
				'type'=>'raw',
				'value'=>'CHtml::link($data["id"], "http://php.net/manual/apc.configuration.php#ini." . str_replace("_", "-", $data["id"]), array(
					"target"=>"_new",
				))',
			),
			array(
				'name'=>'local',
				'header'=>'Local Setting'
			),
			array(
				'name'=>'global',
				'header'=>'Global Setting'
			),
			'access:access:Access Level',
		),
	)); ?>
	<?php $this->endWidget(); ?>
</div>

<div class="clear"></div>