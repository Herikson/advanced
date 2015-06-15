<?php

namespace backend\controllers;

use Yii;
use backend\models\Localizacao;
use backend\models\Entidade;
use backend\models\LocalizacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\json;

/**
 * LocalizacaoController implements the CRUD actions for Localizacao model.
 */
class LocalizacaoController extends Controller
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
     * Lists all Localizacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LocalizacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Localizacao model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Localizacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   
    public function actionCreate()
    {
        $model = new Entidade();
        $modelLocal = new Localizacao();

        if ($modelLocal->load(Yii::$app->request->post())) {

                $modeltrue = false;
                $modelLocaltrue = true;
                $carater = array("[", "]");
                $arrayLocal=explode('-',str_replace($carater, null, $modelLocal->local));
                $cont_ln=0;
                $cont=0;
                $total =count($arrayLocal);

                if(is_null($modelLocal->entidade_id)){
                    echo "Sem entidade ID";
                    die;
                } 
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
                $modelLocal->entidade_id=26;
                $model = $model->findOne($modelLocal->entidade_id);

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

    /**
     * Updates an existing Localizacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Localizacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Localizacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Localizacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Localizacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
