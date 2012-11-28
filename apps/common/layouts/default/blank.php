<?php
 	if(YII_DEBUG)
    	$layout_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.front_layouts.default.assets'), false, -1, true);
	else 
		$layout_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.front_layouts.default.assets'), false, -1, false);
?>
<?php $this->renderPartial('common.front_layouts.default.header',array('page'=>$page,'layout_asset'=>$layout_asset)); ?>    
	<body>
		<div class="container" id="container">
			<div class="span-24" id="content">
				
				<div class="inner_content">					
					<?php 
					//Render Widget for Content Region
					$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'1','layout_asset'=>$layout_asset)); ?>
				</div>
			
			</div>	
		</div>
	<?php 
		//Render Widget for Footer Script
		$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'4','layout_asset'=>$layout_asset)); 
	?>
</body>
</html>