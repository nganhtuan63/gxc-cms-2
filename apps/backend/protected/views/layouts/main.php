<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>    
	<?php 	        		
		$this->renderPartial('application.views.layouts.header',array());       
    ?>
</head>
<body>

<div class="container" id="page">
	<div id="nav">
		<div class="wrap">
				<ul class="right">				
					<li><?php echo t('cms','Welcome'); ?>, <strong><?php echo user()->getModel('display_name'); ?></strong>&nbsp;|&nbsp;</li>
					<li><a href="<?php echo Yii::app()->request->baseUrl?>/user/updatesettings"><?php echo t('cms','Settings'); ?></a>&nbsp;|&nbsp;</li>
					<li><a href="<?php echo Yii::app()->request->baseUrl?>/user/changepass"><?php echo t('cms','Change Password'); ?></a>&nbsp;|&nbsp;</li>
					<li><a href="<?php echo Yii::app()->request->baseUrl?>/site/logout"><?php echo t('cms','Sign out'); ?></a></li>
				</ul>
				
		</div>			
	</div>
	<div id="header">
		<div style="float:left; padding-left:45px">
		<a href="<?php echo bu(); ?>"><img src="<?php echo bu(); ?>/images/logo2.png"; /></a>
		</div>
		<form id="search-box" method="get" action="#" target="_blank" style="float:left;">
			<input class="topSearchBox" id="topSearchBox" autocomplete="off" type="text" maxlength="2048" name="q" label="Search" placeholder="" aria-haspopup="true" />
			<input type="submit" value="Go" id="searchbutton" class="bebutton" />
		</form>
		<div class="clear"></div>
	</div>

	<div id="site-content">
		<div id="left-sidebar">
            <?php $this->renderPartial('application.views.layouts.menu'); ?>
		</div>
		<div id="main-content-zone">
                        <?php if(isset($this->menu)) :?>
                        <?php if(count($this->menu) >0 ): ?>
			<div class="header-info">
				<?php                                       
                      $this->widget('zii.widgets.CMenu', array(
                              'items'=>$this->menu,
                              'htmlOptions'=>array(),
                      ));                                       
                ?>
			</div>
                        <?php endif; ?>
                        <?php endif; ?>
			<div class="page-content">                                
					<div id="inner" style="width:100%;float:left;">
                        <h2><?php echo (isset($this->titleImage)&&($this->titleImage!=''))? '<img src="'. bu().'/'.$this->titleImage.'" />' : ''; ?><?php echo isset($this->pageTitle)? $this->pageTitle : '';  ?></h2>
                        <?php if (isset($this->pageHint)&&($this->pageHint!='')) : ?>
                            <p><?php echo $this->pageHint; ?></p>
                  		<?php endif; ?>
						<?php echo $content; ?>
					</div>
			</div>
		</div>
		
	</div>

</div><!-- page -->
    <script type="text/javascript">

	$(document).ready(function () {
            //Hide the second level menu
            $('#left-sidebar ul li ul').hide();            
            //Show the second level menu if an item inside it active
            $('li.list_active').parent("ul").show();
            
            $('#left-sidebar').children('ul').children('li').children('a').click(function () {                    
                
                 if($(this).parent().children('ul').length>0){                  
                    $(this).parent().children('ul').toggle();    
                 }
                 
            });
          
            
        });
    </script>
</body>

</html>