<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />
<?php

        $cs=Yii::app()->clientScript;
        $cssCoreUrl = $cs->getCoreScriptUrl();
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
        $cs->registerCssFile($cssCoreUrl . '/jui/css/base/jquery-ui.css');
                

        //Publish Files from backend assets folders

        $urlScript =  Yii::app()->getModule('admin')->AssetsUrl.'/js/backend.js';
	$prettyPhotoScript = Yii::app()->getModule('admin')->AssetsUrl.'/js/jquery.prettyPhoto.js';
        $cs->registerScriptFile($urlScript, CClientScript::POS_HEAD);
	$cs->registerScriptFile($prettyPhotoScript, CClientScript::POS_HEAD);   

?>
<!-- blueprint CSS framework -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getModule('admin')->AssetsUrl; ?>/css/screen.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getModule('admin')->AssetsUrl; ?>/css/print.css" media="print" />
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getModule('admin')->AssetsUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getModule('admin')->AssetsUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getModule('admin')->AssetsUrl; ?>/css/form.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getModule('admin')->AssetsUrl; ?>/css/prettyPhoto.css" />

<title><?php echo CHtml::encode($this->pageTitle); ?></title>

<script type="text/javascript" charset="utf-8">
	  $(document).ready(function(){
	       $("a[rel^='prettyPhoto']").prettyPhoto({show_title: true,social_tools: '',deeplinking: false});
	  });
</script>
