<?php

class EventObject extends Object {
	
	
	public $start_date;
	public $end_date;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Object the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{object}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return CMap::mergeArray(array( array('start_date,end_date', 'required')), Object::extraRules());
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return CMap::mergeArray(array(), Object::extraRelationships());
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return CMap::mergeArray(array('start_date' => t('site','Start date'), 'end_date' => t('site','End date'), ), Object::extraLabel());
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		return Object::extraSearch($this);
	}

	protected function beforeSave() {
		if (parent::beforeSave()) {
			if ($this -> isNewRecord) {
				$this -> object_type = 'event';
				Object::extraBeforeSave('create', $this);

			} else {
				Object::extraBeforeSave('update', $this);

			}
			return true;
		} else
			return false;
	}

	protected function afterSave() {
		parent::afterSave();
		if ($this -> isNewRecord) {
			Object::saveMetaValue('start_date', $this->start_date, $this, true);
			Object::saveMetaValue('end_date', $this->end_date, $this, true);
		} else {
			Object::saveMetaValue('start_date', $this->start_date, $this, false);
			Object::saveMetaValue('end_date', $this->end_date, $this, false);
		}
	}

	public static function Resources() {
		return Object::Resources();
	}

	public static function Permissions() {
		return Object::Permissions();
	}

	public static function buildLink($obj){						
		if($obj->object_id)
			return bu()."page?slug=event&id=".$obj->object_id."&pslug=".$obj->object_slug;
		else 
			return null;
	}
}
