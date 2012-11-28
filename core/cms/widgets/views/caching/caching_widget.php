<div class="form">
<?php $this->render('cmswidgets.views.notification'); ?>
<a class="button" href="<?php echo bu();?>/becaching/clear?cache_id=backend_assets"><?php echo  t('cms','Clear BACKEND Assets'); ?></a>
<a class="button" href="<?php echo bu();?>/becaching/clear?cache_id=backend_cache"><?php echo  t('cms','Clear BACKEND Cache'); ?></a>
<a class="button" href="<?php echo bu();?>/becaching/clear?cache_id=frontend_assets"><?php echo  t('cms','Clear FRONTEND Assets'); ?></a>
<a class="button" href="<?php echo bu();?>/becaching/clear?cache_id=frontend_cache"><?php echo  t('cms','Clear FRONTEND Cache'); ?></a>
</div>