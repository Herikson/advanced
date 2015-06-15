<?php

namespace backend\controllers;

use Yii;
use backend\models\Entidade;
use backend\models\EntidadeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Localizacao;
use yii\helpers\BaseStringHelper;
use yii\helpers\json;

/**
 * EntidadeController implements the CRUD actions for Entidade model.
 */
class EntidadeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Entidade models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntidadeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Entidade model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Entidade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTabsData($model) {

    $html = $this->renderPartial('_form',['model' => $model,]);
    return Json::encode($html);
    }

    public function actionCreate()
    {
        $model = new Entidade();
        $modelLocal = new Localizacao();

        $modeltrue = true;
        $modelLocaltrue = false;
        

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id=Yii::$app->user->getId();
            
            if($model->save()){
                return $this->render('cadastrar', [
                    'model' => $model,
                    'modelLocal' =>$modelLocal,
                    'modeltrue' =>$modeltrue,
                    'modelLocaltrue' =>$modelLocaltrue,
                ]);
            }

            
        } else {


            if ($modelLocal->load(Yii::$app->request->post())) {

                $modeltrue = false;
                $modelLocaltrue = true;
                $carater = array("[", "]");
                $arrayLocal=explode('-',str_replace($carater, null, $modelLocal->local));
                $cont_ln=0;
                $cont=0;
                $total =count($arrayLocal);

                foreach ($arrayLocal as $value) {
                    $cont_ln++;

                    if (is_null($value)||$value==""){
                        $cont++;
                    }else{

                    if ($cont > 0) {
                        if ($cont_ln<$total){
                        $modelLocal->google_longitude=-$value;
                        }else{
                        $modelLocal->google_latitude=-$value;    
                        }
                    }else{

                        if($cont_ln<$total){
                        $modelLocal->google_longitude=$value;
                        }else{
                        $modelLocal->google_latitude=$value;    
                        }
                    }
                    $cont=0;
                    }                   
                }
                
                //$modelLocal->id=1;
                $modelLocal->save();
                // print_r($modelLocal->getErrors());
                // die;
                $model = $this->findModel($modelLocal->entidade_id);

                return $this->render('cadastrar', [
                    'model' => $model,
                    'modelLocal' =>$modelLocal,
                    'modeltrue' =>$modeltrue,
                    'modelLocaltrue' =>$modelLocaltrue,
                ]);
                
            } else {
            return $this->render('cadastrar', [
                'model' => $model,
                'modelLocal' =>$modelLocal,
                'modeltrue' =>$modeltrue,
                'modelLocaltrue' =>$modelLocaltrue,
            ]);
            }
        }
    }

    /**
     * Updates an existing Entidade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->user_id=Yii::$app->user->getId();
            
            if($model->save()){
                return $this->render('cadastrar', [
                    'model' => $model,
                ]);
            }

        } else {
            return $this->render('cadastrar', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Entidade model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Entidade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Entidade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Entidade::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
