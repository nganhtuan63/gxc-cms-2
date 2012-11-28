<?php

/**
 * This is the model class for General Settings Form
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package common.settings.general
 *
 */
class GeneralSettingsForm extends CFormModel
{
	public $site_name;
	public $slogan;
    public $site_title;
    public $site_description;    
    public $homepage;
        	

	/**
	 * Declares the validation rules.
	 * 
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('site_name, homepage', 'required'),                      		
            array('site_title, site_description, slogan', 'safe'), 
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'site_name'=>t('cms','Site name'),
			'slogan'=>t('cms','Slogan'),
            'site_title'=>t('cms','Site title'),
            'site_description'=>t('cms','Site description'),
            'homepage'=>t('cms','Page name used as Homepage'),
		);
	}
                
	
       
}
