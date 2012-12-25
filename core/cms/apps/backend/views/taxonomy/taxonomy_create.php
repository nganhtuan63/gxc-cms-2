<?php 
$this->pageTitle=t('cms','Add new Taxonomy');
$this->pageHint=t('cms','Here you can add new Taxonomy for your Content Type'); 
?>
<?php $this->widget('cmswidgets.object.TaxonomyCreateWidget',array()); 
?>