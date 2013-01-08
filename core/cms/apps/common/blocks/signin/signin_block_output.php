<div class="form-stacked">    
    <?php $this->render('cmswidgets.views.notification_frontend'); ?>    
    <div class="website-info">
        <h1><?php echo t('site','Sign into your Account'); ?></h1>
    </div>    
    <?php $form=$this->beginWidget('CActiveForm', array(
       'id'=>$this->id.ConstantDefine::AJAX_BLOCK_SEPERATOR.$this->block['block_id'].ConstantDefine::AJAX_BLOCK_SEPERATOR.'login-content',
	   'enableAjaxValidation'=>true,
	   'clientOptions'=>array(
	       'validateOnSubmit'=>true,
	    ),     
        )); 
    ?>    
    <div class="clearfix">
        <label for="username" class="labelBlur" style="display: inline; "><?php echo t('site','Email'); ?></label>
       	   <div class="input">
        <?php echo $form->textField($model,'username',array('size'=>30,'class'=>'userform','autoComplete'=>'off')); ?>
        <?php echo $form->error($model,'username'); ?>
        </div>   
    </div>             
   <div class="clearfix">
        <label for="password" class="labelBlur" style="display: inline; "><?php echo t('site','Password'); ?></label>
        <div class="input">
        <?php echo $form->passwordField($model,'password',array('size'=>30,'class'=>'userform','autoComplete'=>'off')); ?>
        <?php echo $form->error($model,'password'); ?>
        </div>
    </div>
    <p><a href="<?php echo bu();?>/forgot-password"><?php echo t('site','Forgot password?'); ?></a>                             
                    </p>
    <div class="clearfix">     
         <label><?php echo $form->checkBox($model,'rememberMe',array('style'=>'float:left; margin-right:10px')); ?> <?php echo t('site','Remember me on this computer') ?></label>
         <?php echo $form->error($model,'rememberMe'); ?>
    </div>
    <div class="actions">
         <?php echo CHtml::submitButton(t('site','Sign in'),array('class'=>'btn primary','id'=>'bSigninButton')); ?>    
    </div>    
    <p><?php echo t("site","Don't have an account?"); ?> 
                            <a href="<?php echo bu();?>/sign-up"><?php echo t('site','Register'); ?></a>.
    </p>    
    <?php $this->endWidget(); ?>  

</div>
