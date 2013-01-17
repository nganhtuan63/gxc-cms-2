<div id="inner-form-sidebar">
                    <!--Start the publish Box -->
                    <div class="content-box">

                            <div class="content-box-header">


                            <h3><?php echo  t('cms','Publish'); ?></h3>

                            </div> 

                            <div class="content-box-content" style="display: block;">

                                    <div class="tab-content default-tab" style="display: block;">

                                        <?php echo $form->label($model,'object_date'); ?>
                                        <?php echo $form->textField($model,'object_date'); ?>
                                        <?php echo $form->error($model,'object_date'); ?>

                                           
                                        <?php $this->render('cmswidgets.views.object.object_workflow',array('form'=>$form,'model'=>$model,'content_status'=>$content_status,'type'=>$type)); ?>
                                    </div>       

                            </div>


                    </div>
                    <!-- End Publish Box -->
                    
                    <?php foreach($terms as $key=>$term) : ?>                                           
                    <?php $this->render('cmswidgets.views.object.object_term',array(
                        'form'=>$form,
                        'model'=>$model,
                        'term'=>$term,
                        'selected_terms'=>$selected_terms,
                        'key'=>$key
                        )); ?>
                    <?php endforeach; ?>
                    
                
                    
            </div>