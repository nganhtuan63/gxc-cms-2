<h1>CMS Installer</h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'app_name'); ?>
		<?php echo $form->textField($model,'app_name'); ?>
		<?php echo $form->error($model,'app_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'db_host'); ?>
		<?php echo $form->textField($model,'db_host'); ?>
		<?php echo $form->error($model,'db_host'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'db_name'); ?>
		<?php echo $form->textField($model,'db_name'); ?>
		<?php echo $form->error($model,'db_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'db_username'); ?>
		<?php echo $form->textField($model,'db_username'); ?>
		<?php echo $form->error($model,'db_username'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'db_password'); ?>
		<?php echo $form->passwordField($model,'db_password'); ?>
		<?php echo $form->error($model,'db_password'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'url_path'); ?>
		<?php echo $form->textField($model,'url_path'); ?>
		<?php echo $form->error($model,'url_path'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'url_resource_path'); ?>
		<?php echo $form->textField($model,'url_resource_path'); ?>
		<?php echo $form->error($model,'url_resource_path'); ?>
	</div>
		<div class="row">
		<?php echo $form->labelEx($model,'timezone'); ?>
		<?php echo $form->dropDownList($model,'timezone',InstallForm::getTimeZone()); ?>
		<?php echo $form->error($model,'timezone'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'admin_email'); ?>
		<?php echo $form->textField($model,'admin_email'); ?>
		<?php echo $form->error($model,'admin_email'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'site_title'); ?>
		<?php echo $form->textField($model,'site_title'); ?>
		<?php echo $form->error($model,'site_title'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'site_description'); ?>
		<?php echo $form->textField($model,'site_description'); ?>
		<?php echo $form->error($model,'site_description'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit',array('class'=>'button active')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->