<?php
// Start checking script execution time
//$start = (float) array_sum(explode(' ',microtime()));

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

// Stop checking script execution time
//$end = (float) array_sum(explode(' ',microtime()));
//echo "Processing time: ". sprintf("%.4f", ($end-$start))." seconds";  
//echo memory_get_usage() . "\n"; 