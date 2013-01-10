<?php

class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$password=Yii::app()->getModule('cache')->password;
		if($password===null)
			throw new CException('Please configure the "cache" property of the "cache" module.');
		elseif($password===false || $password===$this->password)
			$this->errorCode=self::ERROR_NONE;
        else
            $this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
		return !$this->errorCode;
	}
}