<?php $this->widget('system.web.widgets.CTabView', array(
	'tabs'=>array(
		'stats'=>array(
			'title'=>'Host Stats',
			'view'=>'_statistics',
			'data'=>array(
				'formatter'=>$formatter,
				'fileCache'=>$fileCache,
				'userCache'=>$userCache,
				'iniSettings'=>$iniSettings,
				'info'=>$info,
				'blocks'=>$blocks,
				'fragInfo'=>$fragInfo,
			),
		),
		'fileCache'=>array(
			'title'=>'File Cache Content',
			'view'=>'_filecache',
			'data'=>array(
				'formatter'=>$formatter,
				'fileCacheList'=>$fileCacheList,
			),
		),
		'userCache'=>array(
			'title'=>'User Cache Content',
			'view'=>'_usercache',
			'data'=>array(
				'formatter'=>$formatter,
				'userCacheList'=>$userCacheList,
			),
		),
	),
)); ?>