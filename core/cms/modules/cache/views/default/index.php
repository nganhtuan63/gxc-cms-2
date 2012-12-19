<h1><?php echo t('cms','Cache Management')?></h1>
<p>
	You can clear Cache and Asset Files cache here:
</p>
<?php $this->renderPartial('cmswidgets.views.notification'); ?>
<ul>	
	<li><?php echo CHtml::link('Clear Cache',array('default/clear/type/cache'));?></li>	
	<li><?php echo CHtml::link('Clear Asset Files',array('default/clear/type/asset'));?></li>	
	<li><?php echo CHtml::link('Logout',array('default/logout'));?></li>	
</ul>

