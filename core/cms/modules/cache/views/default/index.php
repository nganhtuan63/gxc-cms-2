 <h1><?php echo t('cms','Cache Management')?></h1>
<p>
	You can clear Cache and Asset Files cache here:
</p>
<?php $this->renderPartial('cmswidgets.views.notification'); ?>
<ul>

	<?php if (!Yii::app()->cache instanceof CApcCache): ?>
	<li><?php echo CHtml::link('Clear Cache',array('default/clear/type/cache'));?></li>		
	<?php endif; ?> 
	<li><?php echo CHtml::link('Clear Asset Files',array('default/clear/type/asset'));?></li>	
	<li><?php echo CHtml::link('Logout',array('default/logout'));?></li>	
</ul>
<?php if (Yii::app()->cache instanceof CApcCache): ?>
<iframe onload="autoResize(this);" src="<?php echo bu();?>/cache/apc/index" width="100%"/>
<?php endif; ?>

