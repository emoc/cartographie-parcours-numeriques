<?php

/**
 * This is the model class for table "lieux".
 *
 * The followings are the available columns in table 'lieux':
 * @property integer $id
 * @property integer $id_util
 * @property string $nom
 * @property string $type
 * @property string $presentation
 * @property string $horaires
 * @property string $activites
 * @property integer $acces_mobilite_reduite
 * @property string $lien_article
 * @property double $latitude
 * @property double $longitude
 * @property string $adresse
 * @property string $code_postal
 * @property string $commune
 * @property string $email
 * @property string $telephone
 * @property string $site_web
 * @property string $fil_rss
 *
 * The followings are the available model relations:
 * @property Activites[] $activites0
 * @property Actualites[] $actualites
 * @property CentresInteret[] $centresInterets
 * @property Espaces[] $espaces
 * @property Utilisateurs $idUtil
 * @property Reseaux[] $reseauxes
 * @property ReseauxSociaux[] $reseauxSociauxes
 * @property Utilisateurs[] $utilisateurs
 */
class Lieux extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lieux';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_util, acces_mobilite_reduite', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical'),
			array('nom, lien_article, adresse, email, site_web, fil_rss', 'length', 'max'=>255),
			array('type', 'length', 'max'=>13),
			array('code_postal, telephone', 'length', 'max'=>20),
			array('commune', 'length', 'max'=>100),
			array('presentation, horaires, activites', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_util, nom, type, presentation, horaires, activites, acces_mobilite_reduite, lien_article, latitude, longitude, adresse, code_postal, commune, email, telephone, site_web, fil_rss', 'safe', 'on'=>'search'),
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
			'activites0' => array(self::HAS_MANY, 'Activites', 'id_lieu'),
			'actualites' => array(self::HAS_MANY, 'Actualites', 'id_lieu'),
			'centresInterets' => array(self::HAS_MANY, 'CentresInteret', 'id_lieu'),
			'espaces' => array(self::HAS_MANY, 'Espaces', 'id_lieu'),
			'idUtil' => array(self::BELONGS_TO, 'Utilisateurs', 'id_util'),
			'reseauxes' => array(self::HAS_MANY, 'Reseaux', 'id_lieu'),
			'reseauxSociauxes' => array(self::HAS_MANY, 'ReseauxSociaux', 'id_lieu'),
			'utilisateurs' => array(self::HAS_MANY, 'Utilisateurs', 'id_lieu'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID Lieu',
			'id_util' => 'ID Utilisateur',
			'nom' => 'Nom',
			'type' => 'Type',
			'presentation' => 'Présentation',
			'horaires' => 'Horaires',
			'activites' => 'Activités',
			'acces_mobilite_reduite' => 'Accès mobilité réduite',
			'lien_article' => 'Lien article',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'adresse' => 'Adresse',
			'code_postal' => 'Code Postal',
			'commune' => 'Commune',
			'email' => 'Email',
			'telephone' => 'Téléphone',
			'site_web' => 'Site Web',
			'fil_rss' => 'Fil Rss',
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
		$criteria->compare('id_util',$this->id_util);
		$criteria->compare('nom',$this->nom,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('presentation',$this->presentation,true);
		$criteria->compare('horaires',$this->horaires,true);
		$criteria->compare('activites',$this->activites,true);
		$criteria->compare('acces_mobilite_reduite',$this->acces_mobilite_reduite);
		$criteria->compare('lien_article',$this->lien_article,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('adresse',$this->adresse,true);
		$criteria->compare('code_postal',$this->code_postal,true);
		$criteria->compare('commune',$this->commune,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('site_web',$this->site_web,true);
		$criteria->compare('fil_rss',$this->fil_rss,true);

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
	 * @return Lieux the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
