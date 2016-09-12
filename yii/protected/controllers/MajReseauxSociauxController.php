<?php

class MajReseauxSociauxController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to ...
				'actions'=>array('createUtil','updateUtil', 'adminUtil', 'delete', 'viewUtil', 'menuReseauSocialAutocomplete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to ...
				'actions'=>array('admin','delete','create','view', 'update', 'menuReseauSocialAutocomplete'),
				'users'=>array('@'),
                'expression'=>'isset($user->role) && ($user->role==="2")',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
    
    /**
	 * Displays a particular model restricted, for an authenticated user, to his models.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewUtil($id)
	{
		$this->render('viewUtil',array(
			'model'=>$this->loadModel($id),
		));
	}
    
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ReseauxSociaux;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ReseauxSociaux']))
		{
			$model->attributes=$_POST['ReseauxSociaux'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    /**
	 * Creates a new model, restricted, for an authenticated user, to his models.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateUtil()
	{
        
		$model=new ReseauxSociaux;
        $model->id_lieu  = Yii::app()->user->lieu;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ReseauxSociaux']))
		{
			$model->attributes=$_POST['ReseauxSociaux'];
			if($model->save())
				$this->redirect(array('viewUtil','id'=>$model->id));
		}

		$this->render('createUtil',array(
			'model'=>$model,
		));
	}
    
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ReseauxSociaux']))
		{
			$model->attributes=$_POST['ReseauxSociaux'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    /**
	 * Updates a particular model, restricted for an authenticated user.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateUtil($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ReseauxSociaux']))
		{
			$model->attributes=$_POST['ReseauxSociaux'];
			if($model->save())
				$this->redirect(array('viewUtil','id'=>$model->id));
		}

		$this->render('updateUtil',array(
			'model'=>$model,
		));
	} 
    
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ReseauxSociaux');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ReseauxSociaux('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ReseauxSociaux']))
			$model->attributes=$_GET['ReseauxSociaux'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    /**
	 * Gérer les modèles de l'utilisateur.
	 */
	public function actionAdminUtil()
	{
    	$model=new ReseauxSociaux('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['ReseauxSociaux']))
			$model->attributes=$_GET['ReseauxSociaux'];
        $model->id_lieu  = Yii::app()->user->lieu;
		$this->render('adminUtil',array(
			'model'=>$model,
		));
	
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ReseauxSociaux the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ReseauxSociaux::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ReseauxSociaux $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='reseaux-sociaux-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    /**
	 * Answer to AJAX request to autocomplete form
	 */
	public function actionMenuReseauSocialAutocomplete()
	{
		$request=trim($_GET['term']);
        
	    if($request!='') {
            /* pour le cas ou on veut uniquement un choix prédictif :
	        $model=Espaces::model()->findAll(array('distinct'=>true, 
                                                   'select'=> 'espace', 
                                                   "condition"=>"espace like '$request%'"));
            */
            $model=ReseauxSociaux::model()->findAll(array('distinct'=>true, 
                                                   'select'=> 'reseau', 
                                                   'order' => 'reseau'));
	        $data=array();
	        foreach($model as $get){
	            $data[]=$get->reseau;
	        }
	        $this->layout='empty';
            echo CJSON::encode($data);
	    }
	}
}
