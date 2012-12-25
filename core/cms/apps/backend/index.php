<?php
require_once(dirname(__FILE__).'/protected/config/environment.php');
$environment = new Environment(Environment::DEVELOPMENT) ;
 
// change the following paths if necessary
$yii=CORE_FOLDER.'/yii/framework/yii.php';
$globals=CMS_FOLDER.'/globals.php';

defined('YII_DEBUG') or define('YII_DEBUG',$environment->getDebug());
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', $environment->getTraceLevel());


require_once($yii);
require_once($globals);

Yii::setPathOfAlias('common',COMMON_FOLDER);
Yii::setPathOfAlias('cms',CMS_FOLDER);
Yii::setPathOfAlias('cmswidgets',CMS_WIDGETS);
	
Yii::createWebApplication($environment->getConfig())->run();