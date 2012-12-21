<?php
	$layout_asset=GxcHelpers::publishAsset(Yii::getPathOfAlias('common.layouts.default.assets')); 	
?>
<?php $this->renderPartial('common.layouts.default.header',array('page'=>$page,'layout_asset'=>$layout_asset)); ?>      
	<body>		
		<div id="page">
			<div id="header">
					<div class="container">
						<h1 class="logo-info"><?php echo settings()->get('general', 'site_name'); ?></h1>
					</div>									
					<?php 
					//Render Widget for Header Region
					$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'0','layout_asset'=>$layout_asset)); ?>													
			</div><!-- header -->

			<div class="container">
				<div id="content">
					<?php 
				//Render Widget for Content Region			
				$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'1','layout_asset'=>$layout_asset)); ?>
				</div>
				<div id="sidebar">
					<?php 
				//Render Widget for Content Region			
				$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'2','layout_asset'=>$layout_asset)); ?>
				</div>
				<div class="clear"></div>				
			
			</div>
						

			
		</div><!-- page -->					

		<div id="footer">
				&copy; Copyright 2012 
			<?php 
				//Render Widget for Footer Script
				$this->widget('BlockRenderWidget',array('page'=>$page,'region'=>'4','layout_asset'=>$layout_asset)); 
			?>		
		</div><!-- footer -->
	
</body>
</html>