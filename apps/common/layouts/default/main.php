<?php
 	if(YII_DEBUG)
    	$layout_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.layouts.default.assets'), false, -1, true);
	else 
		$layout_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.layouts.default.assets'), false, -1, false);
?>
<?php $this->renderPartial('common.front_layouts.default.header',array('page'=>$page,'layout_asset'=>$layout_asset)); ?>      
	<body>
		
		<div class="container" id="page">

			<div id="header">
				<?php 
				//Render Widget for Header Region
				$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'0','layout_asset'=>$layout_asset)); ?>
			</div><!-- header -->

			<?php 
				//Render Widget for Content Region			
				$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'1','layout_asset'=>$layout_asset)); ?>

			<div class="clear"></div>

			<div id="footer">
				<?php 
				//Render Widget for Footer Region
				$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'2','layout_asset'=>$layout_asset)); ?>
			</div><!-- footer -->

		</div><!-- page -->					
	<?php 
		//Render Widget for Footer Script
		$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'4','layout_asset'=>$layout_asset)); 
	?>
</body>
</html>