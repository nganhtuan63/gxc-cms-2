<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php $assetsUrl=GxcHelpers::publishAsset(Yii::getPathOfAlias('cms.modules.install.assets'),false,-1, YII_DEBUG); ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $assetsUrl; ?>/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $assetsUrl; ?>/form.css" />
<title><?php echo t('cms','CMS Installer'); ?></title>
</head>
<body>
<div id="content" style="width:650px;margin:10px auto;padding:10px 0;">	
	<?php echo $content; ?>
</div>
</body>


