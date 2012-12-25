<?php if($this->display_type==ListViewBlock::DISPLAY_TYPE_HOMEPAGE) : ?>
	<?php if ($this->content_list != null) : ?>
		<?php                 
				//So I get the first content list and want to return as a Data Provider
                $content_list_data_provider = ListViewBlock::getContentList($this->content_list[0], null , null, ConstantDefine::CONTENT_LIST_RETURN_DATA_PROVIDER);		    
	            //Get the current content List model
                if (isset($content_list_data_provider) && $content_list_data_provider != null) : ?>
                	 	<h2><?php echo t('cms','From the Blog'); ?></h2>
                	 	<?php 
                    	$this->widget('zii.widgets.CListView',
                                  array
                                  (
                                  	'viewData'=>array('asset'=>$this->layout_asset),
                                    'dataProvider'=>$content_list_data_provider,
                                    'itemView'=>'common.blocks.listview.item_render',
                                    'summaryText'=>'',
                                    'ajaxUpdate'=>true,
                                    'enablePagination'=> true,                                                                       
                                    'enableSorting'=>false,                           
                                    'sortableAttributes'=>array(),                                                       
                                    )
                                  );                               							                                                     
                		?>	            	
	            <?php endif; ?>                   		
	<?php endif; ?>
<?php endif; ?>
