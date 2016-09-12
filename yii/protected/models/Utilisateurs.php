<?php

/**
 * This is the model class for table "utilisateurs".
 *
 * The followings are the available columns in table 'utilisateurs':
 * @property integer $id
 * @property integer $id_lieu
 * @property string $username
 * @property string $email
 * @property string $password
 * @property integer $role
 * @property integer $valide
 * @property string $derniere_connexion
 *
 * The followings are the available model relations:
 * @property Lieux[] $lieuxes
 * @property Lieux $idLieu
 */
class Utilisateurs extends CActiveRecord
{
    public $new_password;
    public $new_password_repeat;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'utilisateurs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('derniere_connexion', 'required'),
			array('id_lieu, role, valide', 'numerical', 'integerOnly'=>true),
			array('username, email', 'length', 'max'=>255),
			array('password', 'length', 'max'=>40),
            array('new_password', 'length', 'max'=>40),
            array('new_password', 'compare', 'on'=>'insert, changePassword'),
            array('new_password_repeat', 'safe'),
            array('new_password, new_password_repeat', 'required', 'on'=>'insert'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_lieu, username, email, password, role, valide, derniere_connexion', 'safe', 'on'=>'search'),
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
			'lieuxes' => array(self::HAS_MANY, 'Lieux', 'id_util'),
			'idLieu' => array(self::BELONGS_TO, 'Lieux', 'id_lieu'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID Utilisateur',
			'id_lieu' => 'ID Lieu',
			'username' => "Nom d'utilisateur",
			'email' => 'Email',
			'password' => 'Mot de passe',
            'new_password' => 'Nouveau mot de passe',
            'new_password_repeat' => 'Confirmer le nouveau mot de passe',
			'role' => 'Role',
			'valide' => 'Valide',
			'derniere_connexion' => 'Dernière Connexion',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_lieu',$this->id_lieu);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		//$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('valide',$this->valide);
		$criteria->compare('derniere_connexion',$this->derniere_connexion,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
                'pageSize'=>500,
            ),
            'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Utilisateurs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function hashPassword($password)
    {
        return md5($password);
    }
    
    public function afterValidate()
    {
      parent::afterValidate();
      if ($this->getScenario() === 'insert')
        $this->password = $this->hashPassword($this->new_password);
    }
}
