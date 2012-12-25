<div class="form">
<?php $this->render('cmswidgets.views.notification'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row ">
		<?php echo $form->labelEx($model,'comment_title'); ?>
		<?php echo $form->textField($model,'comment_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment_title'); ?>
		<div class="clear"></div>
	
	</div>
	
	
	<div class="row ">
		<?php echo $form->labelEx($model,'comment_modified_content'); ?>
		<?php echo $form->textArea($model,'comment_modified_content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment_modified_content'); ?>
		<div class="clear"></div>
	
	</div>
	
	<div class="row ">
		<?php echo $form->labelEx($model,'comment_content'); ?>
		<?php echo $form->textArea($model,'comment_content',array('rows'=>6, 'cols'=>50,'disabled'=>true)); ?>
		<?php echo $form->error($model,'comment_content'); ?>
		<div class="clear"></div>
	
	</div>
	

	<div class="row ">
	  	<?php echo $form->labelEx($model,'comment_approved'); ?>
                <?php echo $form->dropDownList($model,'comment_approved',array(1=>'Tắt',2=>'Kích hoạt')); ?>
		<?php echo $form->error($model,'comment_approved'); ?>
                <div class="clear"></div>    
	</div>
	

	<div class="row ">
		<?php echo $form->labelEx($model,'comment_author'); ?>
		<?php echo $form->textField($model,'comment_author',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'comment_author'); ?>
		<div class="clear"></div>

	</div>

	<div class="row ">
		<?php echo $form->labelEx($model,'comment_author_url'); ?>
		<?php echo $form->textField($model,'comment_author_url',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'comment_author_url'); ?>
		<div class="clear"></div>
	</div>


	<div class="row ">
		<?php echo $form->labelEx($model,'comment_author_email'); ?>
		<?php echo $form->textField($model,'comment_author_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'comment_author_email'); ?>
		<div class="clear"></div>	
	</div>

	<div class="row buttons ">
		<?php echo CHtml::submitButton($model->isNewRecord ? t('cms','Create') : t('cms','Save') ,array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->