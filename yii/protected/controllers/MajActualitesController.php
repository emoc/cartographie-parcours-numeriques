<?php

class MajActualitesController extends Controller
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
				'actions'=>array('createUtil','updateUtil', 'adminUtil', 'delete', 'viewUtil'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to ...
				'actions'=>array('create','update','admin','delete','view'),
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
	 * Displays a particular model, restricted for an authenticated user,  to his models.
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
		$model=new Actualites;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Actualites']))
		{
        
			$model->attributes=$_POST['Actualites'];
            $rnd = rand(0,9999);
            
            $uploadedFile = CUploadedFile::getInstance($model,'image');   
     
            $fileName =  substr($model->date_debut, 0, 4) 
                       . substr($model->date_debut, 5, 2)
                       . substr($model->date_debut, 8, 2)
                       . "_" . $model->id_lieu  
                       . "_" . $rnd
                       . "." . pathinfo($uploadedFile, PATHINFO_EXTENSION);
                       
            if ($uploadedFile !== null) $model->image=$fileName;
            
			if($model->save()) {
                //$uploadedFile->saveAs('../actupix/'.$fileName);
                if ($uploadedFile !== null) 
                {
                    $uploadedFile->saveAs('../actupix/'.$fileName); 
                }
                
                               
				$this->redirect(array('view','id'=>$model->id));
            }
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
        
		$model=new Actualites;
        $model->id_lieu  = Yii::app()->user->lieu;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        
        if(isset($_POST['Actualites']))
		{
            $rnd = rand(0,9999);
			$model->attributes=$_POST['Actualites'];
            $uploadedFile = CUploadedFile::getInstance($model,'image');   
     
            $fileName =  substr($model->date_debut, 0, 4) 
                       . substr($model->date_debut, 5, 2)
                       . substr($model->date_debut, 8, 2)
                       . "_" . $model->id_lieu  
                       . "_" . $rnd
                       . "." . pathinfo($uploadedFile, PATHINFO_EXTENSION);
                       
            if ($uploadedFile !== null) $model->image=$fileName;            

			if($model->save())
            {   
                //$uploadedFile->saveAs(Yii::app()->request->baseUrl . '/../actupix/'.$fileName);
                if ($uploadedFile !== null) 
                {
                    $uploadedFile->saveAs('../actupix/'.$fileName); 
                }
				$this->redirect(array('viewUtil','id'=>$model->id));
            }
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
        $original_image = $model->image;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Actualites']))
		{
			$model->attributes=$_POST['Actualites'];
            $rnd = rand(0,9999);
            $uploadedFile = CUploadedFile::getInstance($model, 'image');
            $fileName =  substr($model->date_debut, 0, 4) 
                       . substr($model->date_debut, 5, 2)
                       . substr($model->date_debut, 8, 2)
                       . "_" . $model->id_lieu  
                       . "_" . $rnd
                       . "." . pathinfo($uploadedFile, PATHINFO_EXTENSION);
            $model->image = $uploadedFile !== null ? $fileName : $original_image;
            
			if($model->save())
            {
                if ($uploadedFile !== null) 
                {
                    $uploadedFile->saveAs(Yii::app()->request->baseUrl . '/../actupix/'.$fileName);
                }
				$this->redirect(array('view','id'=>$model->id));
            }
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
        $original_image = $model->image;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Actualites']))
		{
            $rnd = rand(0,9999);
			$model->attributes=$_POST['Actualites'];
            $uploadedFile = CUploadedFile::getInstance($model, 'image');
            $fileName =  substr($model->date_debut, 0, 4) 
                       . substr($model->date_debut, 5, 2)
                       . substr($model->date_debut, 8, 2)
                       . "_" . $model->id_lieu  
                       . "_" . $rnd
                       . "." . pathinfo($uploadedFile, PATHINFO_EXTENSION);
            $model->image = $uploadedFile !== null ? $fileName : $original_image;
            
			if($model->save())
            {
                if ($uploadedFile !== null) 
                {
                    //$uploadedFile->saveAs(Yii::app()->request->baseUrl . '/../actupix/'.$fileName);
                    $uploadedFile->saveAs('../actupix/'.$fileName);
                }
				$this->redirect(array('viewUtil','id'=>$model->id));
            }
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
		$dataProvider=new CActiveDataProvider('Actualites');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Actualites('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Actualites']))
			$model->attributes=$_GET['Actualites'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    /**
	 * Manages all models for the current authenticated user.
	 */
	public function actionAdminUtil()
	{
		$model=new Actualites('search');
		$model->unsetAttributes();  // clear any default values
        
		if(isset($_GET['Actualites']))
			$model->attributes=$_GET['Actualites'];
        $model->id_lieu  = Yii::app()->user->lieu;
		$this->render('adminUtil',array(
			'model'=>$model,
		));
	}
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Actualites the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Actualites::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Actualites $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='actualites-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
}
