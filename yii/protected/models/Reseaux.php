<?php

/**
 * This is the model class for table "reseaux".
 *
 * The followings are the available columns in table 'reseaux':
 * @property integer $id
 * @property integer $id_lieu
 * @property string $reseau
 *
 * The followings are the available model relations:
 * @property Lieux $idLieu
 */
class Reseaux extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reseaux';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lieu', 'numerical', 'integerOnly'=>true),
			array('reseau', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_lieu, reseau', 'safe', 'on'=>'search'),
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
			'idLieu' => array(self::BELONGS_TO, 'Lieux', 'id_lieu'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_lieu' => 'ID Lieu',
			'reseau' => 'Réseau',
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
		$criteria->compare('reseau',$this->reseau,true);

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
	 * @return Reseaux the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
