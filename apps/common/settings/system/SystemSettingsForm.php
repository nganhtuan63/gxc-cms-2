<?php

/**
 * This is the model class for System Settings Form
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package common.settings.system
 *
 */
class SystemSettingsForm extends CFormModel
{
	public $support_email;
    public $page_size;
    public $language_number;
	public $keep_file_name_upload;
        
       

	/**
	 * Declares the validation rules.
	 * 
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('support_email, page_size, language_number, keep_file_name_upload', 'required'),
            array('support_email', 'email'),
           	
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'support_email'=>t('cms','Support email'),
            'page_size'=>t('cms','Items per page'),            
            'keep_file_name_upload'=>t('cms','Keep file name when uploading'),
		);
	}
             
	
	public static function filenameUpload(){
		return array(
			'0'=>t('cms','No'),
			'1'=>t('cms','Yes'),
		);
	}

	
       
}
