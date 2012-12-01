<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>	    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />
<?php

        $cs=Yii::app()->clientScript;
        $cssCoreUrl = $cs->getCoreScriptUrl();
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
        $cs->registerCssFile($cssCoreUrl . '/jui/css/base/jquery-ui.css');                

        $AssetsUrl=GxcHelpers::publishAsset(Yii::getPathOfAlias('cms.modules.user.assets'),false,-1,YII_DEBUG);

?>
<!-- blueprint CSS framework -->
<link rel="stylesheet" type="text/css" href="<?php echo $AssetsUrl; ?>/css/screen.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo $AssetsUrl; ?>/css/print.css" media="print" />
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo $AssetsUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo $AssetsUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $AssetsUrl; ?>/css/form.css" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container" id="page">
	<div id="header-login" style="margin:0 auto; text-align: center" >		
		<div style="padding-top:60px">
		<img src="<?php echo $AssetsUrl; ?>/images/logo.png" />
		</div>
	</div>
	<div id="site-content" style="margin:0 auto; width:400px; border-top:0px">
        <?php echo $content; ?>		
	</div>

</div><!-- page -->
 
</body>
</html>