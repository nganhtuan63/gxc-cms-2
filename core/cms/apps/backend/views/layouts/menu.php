      
<?php
$this->widget('zii.widgets.CMenu',array(
	'encodeLabel'=>false,
	'activateItems'=>true,
	'activeCssClass'=>'list_active',
	'items'=>array(

		//Dasboard Menu 
		array(
			'label'=>'<span id="menu_dashboard" class="micon"></span>'.t('cms','Dashboard'), 
			'url'=>array('/site/index') ,'linkOptions'=>array('class'=>'menu_0'),
			'active'=> ((Yii::app()->controller->id=='site') && (in_array(Yii::app()->controller->action->id,array('index'))) ? true : false)
			),                               

		//Content Menu 
		array(
			'label'=>'<span id="menu_content" class="micon"></span>'.t('cms','Content'),  
			'url'=>'javascript:void(0);','linkOptions'=>array('class'=>'menu_1' ), 
			'itemOptions'=>array('id'=>'menu_1'), 
			'items'=>array(
				array(
					'label'=>t('cms','Create Content'), 
					'url'=>array('/object/create'),
					'active'=>Yii::app()->controller->id=='object' && Yii::app()->controller->action->id=='create'
					),
				array(
					'label'=>t('cms','Draft Content'), 
					'url'=>array('/object/draft'),
					'active'=>Yii::app()->controller->id=='object' && Yii::app()->controller->action->id=='draft'
					),
				array(
					'label'=>t('cms','Pending Content'), 
					'url'=>array('/object/pending'),
					'active'=>Yii::app()->controller->id=='object' && Yii::app()->controller->action->id=='pending'
					),
				array(
					'label'=>t('cms','Published Content'), 
					'url'=>array('/object/published'),
					'active'=>Yii::app()->controller->id=='object' && Yii::app()->controller->action->id=='published'
					),
				array(
					'label'=>t('cms','Manage Content'), 
					'url'=>array('/object/admin'),
					'visible'=>user()->isAdmin ? true : false,
					'active'=> ((Yii::app()->controller->id=='object') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)
					)
				)
			),

		//Category Menu 
		array(
			'label'=>'<span id="menu_taxonomy" class="micon"></span>'.t('cms','Category'), 
			'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_2','class'=>'menu_2'),  
			'itemOptions'=>array('id'=>'menu_2'),
			'items'=>array(
				array(
					'label'=>t('cms','Create Term'), 
					'url'=>array('/term/create'),
					'active'=>Yii::app()->controller->id=='term' && Yii::app()->controller->action->id=='create'
				),
				array(
					'label'=>t('cms','Manage Terms'), 
					'url'=>array('/term/admin'),
					'active'=> ((Yii::app()->controller->id=='term') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)                                                                                           
				),
				array(
					'label'=>t('cms','Create Taxonomy'), 
					'url'=>array('/taxonomy/create'),
					'active'=>Yii::app()->controller->id=='taxonomy' && Yii::app()->controller->action->id=='create'
				),
				array(
					'label'=>t('cms','Mangage Taxonomy'), 
					'url'=>array('/taxonomy/admin'),
					'active'=> ((Yii::app()->controller->id=='taxonomy') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false)                                                                                     
				),
				
			),

      //Page Menu 
      	array(
      		'label'=>'<span id="menu_page" class="micon"></span>'.t('cms','Pages'), 
      		'url'=>'javascript:void(0);',
      		'linkOptions'=>array('id'=>'menu_3','class'=>'menu_3'), 
      		'itemOptions'=>array('id'=>'menu_3'),
      		'items'=>array(
      			array(
      				'label'=>t('cms','Create Menu'), 
      				'url'=>array('/menu/create'),
      				'active'=>Yii::app()->controller->id=='menu' && Yii::app()->controller->action->id=='create'
      			),
      			array(
      				'label'=>t('cms','Manage Menus'), 
      				'url'=>array('/menu/admin'),
      				'active'=> ((Yii::app()->controller->id=='menu') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)
      			),
      			array(
      				'label'=>t('cms','Create Queue'), 
      				'url'=>array('/contentlist/create'),
      				'active'=>Yii::app()->controller->id=='contentlist' && Yii::app()->controller->action->id=='create'
      				
      			),
      			array(
      				'label'=>t('cms','Manage Queues'), 
      				'url'=>array('/contentlist/admin'),
      				'active'=> ((Yii::app()->controller->id=='contentlist') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)
      			),
      			array(
      				'label'=>t('cms','Create Block'), 
      				'url'=>array('block/create'),
      				'active'=>Yii::app()->controller->id=='block' && Yii::app()->controller->action->id=='create'
      			),
      			array(
      				'label'=>t('cms','Manage Blocks'), 
      				'url'=>array('/block/admin'),
      				'active'=> ((Yii::app()->controller->id=='block') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)
      			),
      			array(
      				'label'=>t('cms','Create Page'), 
      				'url'=>array('/page/create'),
      				'active'=>Yii::app()->controller->id=='page' && Yii::app()->controller->action->id=='create'
      			),
      			array(
      				'label'=>t('cms','Manage Pages'), 
      				'url'=>array('/page/admin'),
      				'active'=> ((Yii::app()->controller->id=='page') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false
      			)
      		)
      ),

      //Resource Menu 
      array(
      		'label'=>'<span id="menu_resource" class="micon"></span>'.t('cms','Resource'), 
      		'url'=>'javascript:void(0);',
      		'linkOptions'=>array('id'=>'menu_4','class'=>'menu_4'), 
      		'itemOptions'=>array('id'=>'menu_4'), 
      		'items'=>array(
      			array(
      				'label'=>t('cms','Create Resource'), 
      				'url'=>array('/resource/create'),
      				'active'=>Yii::app()->controller->id=='resource' && Yii::app()->controller->action->id=='create'      				
      			),
      			array(
      				'label'=>t('cms','Manage Resource'), 
      				'url'=>array('/resource/admin'),
      				'active'=> ((Yii::app()->controller->id=='resource') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false
      			)
      		)
      ),

      //Manage Menu 
      array(
      		'label'=>'<span id="menu_manage" class="micon"></span>'.t('cms','Manage'), 
      		'url'=>'javascript:void(0);',
      		'linkOptions'=>array('id'=>'menu_5','class'=>'menu_5'), 
      		'itemOptions'=>array('id'=>'menu_5'), 
      		'items'=>array(
      			array(
      				'label'=>t('cms','Comments'), 
      				'url'=>array('/comment/admin'),
      				'active'=>Yii::app()->controller->id=='comment' ? true : false
      			),
      		)
      ),

      //User Menu 
      array(
      	'label'=>'<span id="menu_user" class="micon"></span>'.t('cms','User'), 
      	'url'=>'javascript:void(0);',
      	'linkOptions'=>array('id'=>'menu_6','class'=>'menu_6'), 
      	'itemOptions'=>array('id'=>'menu_6'), 
      	'items'=>array(
      		array(
      			'label'=>t('cms','Create User'), 
      			'url'=>array('/user/create'),
      			'active'=>Yii::app()->controller->id=='user' && Yii::app()->controller->action->id=='create'
      		),
      		array(
      			'label'=>t('cms','Manage Users'), 
      			'url'=>array('/user/admin'),
      			'active'=> ((Yii::app()->controller->id=='user') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false
      		),
      		array(
      			'label'=>t('cms','Permission'), 
      			'url'=>array('/rights/assignment'),
      			'active'=>in_array(Yii::app()->controller->id,array('assignment','authItem')) ?true:false
      		),
      	),
      	'visible'=>user()->isAdmin ? true : false,   
      ),      

      //Settings Menu 
      array(
      	'label'=>'<span id="menu_setting" class="micon"></span>'.t('cms','Settings'), 
      	'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_7','class'=>'menu_7'), 
      	'itemOptions'=>array('id'=>'menu_7'), 
      	'items'=>array(
      		array(
      			'label'=>t('cms','General'), 
      			'url'=>array('/settings/index/type/general'),
      			'active'=>Yii::app()->controller->id=='settings' && isset($_GET['type']) && $_GET['type']=='general'
      		),
      		array(
      			'label'=>t('cms','System'), 
      			'url'=>array('/settings/index/type/system'),
      			'active'=>Yii::app()->controller->id=='settings' && isset($_GET['type']) && $_GET['type']=='system'
      		),

      	),
      	'visible'=>user()->isAdmin ? true : false,   
      ),

      //Caching Menu 
      array(
      	'label'=>'<span id="menu_caching" class="micon"></span>'.t('cms','Caching'), 
      	'url'=>array('cache/default'),'linkOptions'=>array('id'=>'menu_8','class'=>'menu_8','target'=>'_blank'), 
      	'itemOptions'=>array('id'=>'menu_8'), 
      	'items'=>array(
      	),
      	'visible'=>user()->isAdmin ? true : false,   
      	'active'=>Yii::app()->controller->id=='caching'
      )

    ),
));