<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = Adminuser::model()->findByAttributes(array('username'=>$this->username));
		if($user === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($user->password !== md5($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->setState('id_user', $user->id);
			$this->setState('role', $user->role);
			$this->setState('username_admin', $user->username);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
}