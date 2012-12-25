<?php

/**
 * This is the model class for table "gxc_comment".
 *
 * The followings are the available columns in table 'gxc_comment':
 * @property string $comment_id
 * @property string $object_id
 * @property string $comment_author
 * @property string $comment_author_email
 * @property string $comment_author_url
 * @property string $comment_author_IP
 * @property integer $comment_date
 * @property integer $comment_date_gmt
 * @property string $comment_content
 * @property integer $comment_karma
 * @property string $comment_approved
 * @property string $comment_agent
 * @property string $comment_type
 * @property string $comment_parent
 * @property string $userid
 * @property string $comment_title
 * @property string $comment_modified_content
 */
class Comment extends CActiveRecord
{
	const STATUS_PENDING=1;
	const STATUS_APPROVED=2;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gxc_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment_author, comment_author_email , comment_title ', 'required',                            
             ),
			array('comment_karma', 'numerical', 'integerOnly'=>true),
			array('object_id, comment_author_IP, comment_approved, comment_type, comment_parent, userid comment_date, comment_date_gmt, comment_agent , comment_modified_content', 'safe'),
			array('comment_author_url', 'url'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comment_id, object_id, comment_author, comment_author_email, comment_author_url, comment_author_IP, comment_date, comment_date_gmt, comment_content, comment_karma, comment_approved, comment_agent, comment_type, comment_parent, userid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			      'object' => array(self::BELONGS_TO, 'Object', 'object_id'),			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'comment_id' => 'ID',
			'object_id' => t('cms','Content'),
			'comment_author' => t('cms','Full name'),
			'comment_author_email' => t('cms','Email'),
			'comment_author_url' => t('cms','Author website'),
			'comment_author_IP' => t('cms','IP'),
			'comment_date' => t('cms','Date'),
			'comment_date_gmt' => t('cms','Date GMT'),
			'comment_content' => t('cms','Content'),
			'comment_karma' => t('cms','Comment Karma'),
			'comment_approved' => t('cms','Approve'),
			'comment_agent' => t('cms','Comment Agent'),
			'comment_type' => t('cms','Comment Type'),
			'comment_parent' => t('cms','Comment Parent'),
			'userid' => t('cms','User ID'),
			'comment_title' => t('cms','Title'),
			'comment_modified_content' => t('cms','Modified content'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('comment_id',$this->comment_id,true);
		$criteria->compare('object_id',$this->object_id,true);
		$criteria->compare('comment_author',$this->comment_author,true);
		$criteria->compare('comment_author_email',$this->comment_author_email,true);
		$criteria->compare('comment_author_url',$this->comment_author_url,true);
		$criteria->compare('comment_author_IP',$this->comment_author_IP,true);
		$criteria->compare('comment_date',$this->comment_date);
		$criteria->compare('comment_date_gmt',$this->comment_date_gmt);
		$criteria->compare('comment_content',$this->comment_content,true);
		$criteria->compare('comment_karma',$this->comment_karma);
		$criteria->compare('comment_approved',$this->comment_approved,true);
		$criteria->compare('comment_agent',$this->comment_agent,true);
		$criteria->compare('comment_type',$this->comment_type,true);
		$criteria->compare('comment_parent',$this->comment_parent,true);
		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('comment_title',$this->comment_title,true);
		$criteria->compare('comment_modified_content',$this->comment_modified_content,true);

		$criteria->order = "comment_date DESC";
		
		$sort = new CSort;
		$sort->attributes = array(
				'comment_id',
		);
		$sort->defaultOrder = 'comment_id DESC';		
		
		$criteria->with=array('object');
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord) {
				$current_time=time();
				$current_time_gmt=local_to_gmt(time());
				$this->comment_date=$current_time;
				$this->comment_date_gmt=$current_time_gmt;
				$this->comment_karma=0;
				$this->comment_type='comment';
				$this->comment_parent=0;
	
				if(!user()->isGuest){
					$this->userid= user()->id;
				} else {
					$this->userid=0;
				}
				$this->comment_author_IP = ip();
				$this->comment_agent = $_SERVER['HTTP_USER_AGENT']!= null ? $_SERVER['HTTP_USER_AGENT'] : '';
			}
			return true;
		}
		else
			return false;
	}
	
	public static function convertCommentState($data)
	{
		if($data->comment_approved==Comment::STATUS_APPROVED){
			return bu().'/images/active.png';
		} else {
			return bu().'/images/disabled.png';
		}
	
	}		
	
}