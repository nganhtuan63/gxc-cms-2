<?php 
$this->pageTitle=t('cms','Create new User');
$this->pageHint=t('cms','Here you can add new member for the site'); 
?>
<div class="form">
<?php $this->renderPartial('cmswidgets.views.notification'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'usercreate-form',
        'enableAjaxValidation'=>true,       
        )); 
?>

<?php echo $form->errorSummary($model); ?>
<div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username'); ?>
        <?php echo $form->error($model,'username'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'display_name'); ?>
        <?php echo $form->textField($model,'display_name'); ?>
        <?php echo $form->error($model,'display_name'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
</div>


<div class="row buttons">
        <?php echo CHtml::submitButton(t('cms','Save'),array('class'=>'bebutton')); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">    
    CopyString('#UserCreateForm_email','#UserCreateForm_username','email');
    CopyString('#UserCreateForm_email','#UserCreateForm_display_name','email');
</script>
</div><!-- form -->
