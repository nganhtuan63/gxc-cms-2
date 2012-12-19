<div id="language-zone">
        <?php if($model->isNewRecord) : ?>
            <?php if(count($versions)>0) : ?>
            <div class="row even border-left-silver">
                    <?php echo "<strong style='color:#DD4B39'>".t("cms","Translated Version of :")."</strong><br />" ?>    

                        <?php foreach($versions as $version) :?>
                        <?php  echo "<br /><b>- ".$version."</b>"; ?>
                        <?php endforeach; ?>
                        
                    <div class="clear"></div>
                    <br />
            </div>
             <?php endif; ?>
             <?php $lang_number= GxcHelpers::getAvailableLanguages() ; if(count($lang_number)>1) :  ?>
            <div class="row odd border-left-silver">
                    <?php echo $form->labelEx($model,'lang'); ?>	    
                    <?php echo $form->dropDownList($model,'lang',GxcHelpers::loadLanguageItems($lang_exclude),
                            array('id'=>'lang_select','options' => array(array_search(Yii::app()->language,GxcHelpers::loadLanguageItems($lang_exclude,false))=>array('selected'=>true)))
                            
                            ); ?>
                    <?php echo $form->error($model,'lang'); ?>
                    <div class="clear"></div>
            </div>
            <?php else : ?>
                <?php echo $form->hiddenField($model,'lang',array('value'=>GxcHelpers::mainLanguage())); ?>
            <?php endif; ?>
        <?php endif; ?>
</div>
 <div id="titlewrap">
         <?php echo $form->textField($model,'object_name',array('class'=>'specialTitle','tabindex'=>'1','id'=>'txt_object_name')); ?>
         <?php echo $form->error($model,'object_name'); ?>									
</div>

<div id="small_buttons_insert" align="right">
		<span><?php echo  t('cms','Insert'); ?></span>		
		<img valign="top" alt="Image" title="Image" onClick="insertFileToContent('image');" src="<?php echo bu(); ?>/images/insert_image.png" />
				
</div>
<div id="bodywrap">		
         <?php echo $form->textArea($model,'object_content',array('tabindex'=>'2','class'=>'specialContent','id'=>'ckeditor_content')); ?>
         <?php echo $form->error($model,'object_content'); ?>                                                          
</div>