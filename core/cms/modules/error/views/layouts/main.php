<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php $assetsUrl=GxcHelpers::publishAsset(Yii::getPathOfAlias('cms.modules.error.assets'),false,-1, YII_DEBUG); ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $assetsUrl; ?>/style.css" />
<title><?php echo t('cms','Oops! Something went wrong!'); ?></title>
</head>
<body>
<div id="content">
	<?php 	
	echo $content; ?>
</div>
</body>


