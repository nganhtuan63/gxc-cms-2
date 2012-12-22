<?php
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
	'sourcePath'=>dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'backend',
	'messagePath'=>dirname(__FILE__),
	'languages'=>array('vi_vn'),
	'fileTypes'=>array('php'),
    'overwrite'=>true,
	'exclude'=>array(
		'.svn',
		'yiilite.php',
		'yiit.php',
		'/i18n/data',
		'/messages',
		'/vendors',
		'/web/js',
	),
	'translator' => 't',
);
