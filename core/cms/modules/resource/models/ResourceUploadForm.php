<?php

class ResourceUploadForm extends CFormModel
{
    public $name;
    public $body;
    public $link;
    public $upload;
    public $type;
	public $where;
    
    public function rules()
    {
        return array(
            array('link, name, body, type,where','safe'),
            array('upload', 'file','allowEmpty'=>true),
            
        );
    }
	
	
    public function attributeLabels()
    {
            return array(
                    'upload'=>t('cms','Upload'),
                    'link'=>t('cms','Link'),
                    'name'=>t('cms','Resource Name'),
                    'body'=>t('cms','Description'),
                    'where'=>t('cms','Storage'),
					'type'=>t('cms','File type')
            );
    }
    
    
}