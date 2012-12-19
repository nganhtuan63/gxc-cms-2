<?php 
switch ($type){
    case ConstantDefine::OBJECT_STATUS_DRAFT :
        $this->pageTitle=t('cms','Manage Drafted Content');
        $this->pageHint=t('cms','Here you can manage all Drafted content on your site'); 
        break;
    
    case ConstantDefine::OBJECT_STATUS_PENDING :
        $this->pageTitle=t('cms','Manage Pending Content');
        $this->pageHint=t('cms','Here you can manage all Pending content on your site'); 
        break;
    
    case ConstantDefine::OBJECT_STATUS_PUBLISHED :
        $this->pageTitle=t('cms','Manage Published Content');
        $this->pageHint=t('cms','Here you can manage all Published content on your site'); 
        break;
    
    default :       
        $this->pageTitle=t('cms','Manage Content');
        $this->pageHint=t('cms','Here you can manage all content on your site'); 
        break;
}

?>
<?php $this->widget('cmswidgets.object.ObjectManageStatusWidget',array('type'=>$type)); 
?>