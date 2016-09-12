<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    // Need to store the user's ID:
    private $_id;
    private $_derniere_connexion;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    /*
	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}*/
    public function authenticate()
    {
        $user  = Utilisateurs::model()->findByAttributes(array('username'=>$this->username));
        
        if ($user===null) { // No user found!
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        } else if ($user->password !== md5($this->password) ) { // Invalid password!
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        } else { // Okay!
            $this->errorCode=self::ERROR_NONE;
            //$this->_derniere_connexion = $user->derniere_connexion;
            //$this->setState('derniere_connexion', $user->derniere_connexion);
            $this->setState('derniere_connexion', date('Y-m-d H:i:s'));
            $user->saveAttributes(array('derniere_connexion'=>date('Y-m-d H:i:s')));
            // Store the role in a session:
            $this->setState('role', $user->role);
            $this->setState('lieu', $user->id_lieu);
            $this->_id = $user->id;
        }
        return !$this->errorCode;
        
    }
    
    public function getId()
    {
        return $this->_id;
    }
}