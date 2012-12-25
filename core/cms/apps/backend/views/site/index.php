<?php
$this->pageTitle=Yii::app()->name;
?>
<p><?php echo t('cms','What do you want to do today?'); ?></p>
<div>
<?php $types=GxcHelpers::getAvailableContentType(); ?>
<ul class="shortcut-buttons-set">
<?php foreach($types as $type) : ?>
<li>
<a href="<?php echo bu().'/object/create/type/'.$type['id']; ?>" class="shortcut-button">
<span>
<img alt="icon" src="<?php 
$icon_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.content_type.'.$type['id'].'.assets'), false, -1, false);                    
echo $icon_asset.'/'.$type['icon']; ?>"><br />
<?php echo t('cms','Create').' '.$type['name'];?>
</span></a></li>
<?php endforeach; ?>

<li>
<a href="<?php echo bu().'/page/create'; ?>" class="shortcut-button">
<span>
<img alt="icon" src="<?php 
		
		                    
echo bu().'/images/paper.png'; ?>"><br />
<?php echo t('cms','Create new Page');?>
</span></a></li>


<li>
<a href="<?php echo bu().'/resource/create'; ?>" class="shortcut-button">
<span>
<img alt="icon" src="<?php                     
echo bu().'/images/upload_file.png'; ?>"><br />
<?php echo t('cms','Upload a File');?>
</span></a></li>


</ul>
<div style="clear:both"></div>
</div>