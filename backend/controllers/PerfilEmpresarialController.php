<?php

namespace backend\controllers;

use Yii;
use backend\models\PerfilEmpresarial;
use backend\models\PerfilEmpresarialSearch;
use backend\models\UserPerfilEmpresarial;
use backend\models\Localizacao;
use backend\models\Contato;
use backend\models\Produtos;
use backend\models\Model;

use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PerfilEmpresarialController implements the CRUD actions for PerfilEmpresarial model.
 */
class PerfilEmpresarialController extends Controller
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
     * Lists all PerfilEmpresarial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PerfilEmpresarialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PerfilEmpresarial model.
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
     * Creates a new PerfilEmpresarial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PerfilEmpresarial();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PerfilEmpresarial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionEditar()
    {
        $model = [new PerfilEmpresarial()];

    
        $model = Model::createMultiple(PerfilEmpresarial::classname(), $model);
        Model::loadMultiple($model, Yii::$app->request->post());

        // print_r($model);
        foreach($model as $i=>$md):
            if ($model[$i]['check']==1){

                $id=$model[$i]['id_delete'];
                $model_del = PerfilEmpresarial::findOne($id);
                $localizacao = Localizacao::findOne(['perfil_empresarial_id'=>$id]);
                $contato = Contato::findOne(['perfil_empresarial_id'=>$id]);
                $produtos = Produtos::findOne(['perfil_empresarial_id'=>$id]);

                if (!is_null($localizacao)){
                    $localizacao->delete();
                }
                if (!is_null($contato)){
                    $contato->delete();
                }
                if (!is_null($produtos)){
                     $produtos->deleteAll('perfil_empresarial_id='.$id);
                }

                $model_del->delete();
            }
        endforeach;

        $model = new PerfilEmpresarial();
        $localizacao = new Localizacao();
        $contato = new Contato();
        $produtos = [new Produtos];

        return $this->render('principal', [ 
                'model' => $model, 
                'localizacao' =>$localizacao,
                'contato' =>$contato,
                'produtos' => $produtos,
                'perfilative' =>$model->perfil_ative, 
                'localative' =>$localizacao->local_ative, 
                'produtoative' =>$model->produto_ative, 
            ]);
    } 

    public function actionLoadupdate($id=null)
    { 
        

        $user_id=Yii::$app->user->getId(); 
        
        if(!is_null($id)){
            $model = $this->findModel($id);
            $localizacao = Localizacao::findOne(['perfil_empresarial_id'=>$id]);
            $contato = Contato::findOne(['perfil_empresarial_id'=>$id]);
            $produtos = Produtos::findAll(['perfil_empresarial_id'=>$id]);

            if(is_null($localizacao)){
                $localizacao = new Localizacao();
            }
            if(is_null($contato)){
                $contato = new Contato();
            }
            
            if(empty($produtos)){
                $produtos = [new Produtos];
            }
        }else{
            
            $model = new PerfilEmpresarial();
            $localizacao = new Localizacao();
            $contato = new Contato();
            $produtos = [new Produtos];
            $model_user_perfil = UserPerfilEmpresarial::findOne($user_id); 

            if (!is_null($model_user_perfil)){
            $model = $this->findModel($model_user_perfil->perfil_empresarial_id); 

            $model_user_perfil->delete();
            }
            
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if ($localizacao->load(Yii::$app->request->post())) {
                $localizacao->save();
            }

            if ($contato->load(Yii::$app->request->post())) {
                $contato->save();
            }

            //if ($produtos->load(Yii::$app->request->post())) {
                
                $oldIDs = ArrayHelper::map($produtos, 'id', 'id');
                $oldImages = ArrayHelper::map($produtos, 'imagem', 'imagem');
                $produtos = Model::createMultiple(Produtos::classname(), $produtos);
                Model::loadMultiple($produtos, Yii::$app->request->post());

                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($produtos, 'id', 'id')));

                foreach($produtos as $i=>$produto):

                    $files[$i]=  UploadedFile::getInstanceByName("Produtos[".$i."][imagem]");

                    if($files[$i]){
                        $ext = end((explode(".", $files[$i]->name)));
                        // generate a unique file name

                        $produtos[$i]->imagem= "/Uploads/Produtos/" . md5(uniqid()) .".{$ext}";
                        $paths[$i]= Yii::getAlias ('@webroot') .$produtos[$i]->imagem;
                    }   
                endforeach;
                /*
                $paths_db[] = $model->logo_rooturl;
                //Elimina os ficheiros anteriormente guardados:
                foreach ($paths_db as $file) 
                    unlink($file);
                */

                //$valid = $model->validate();
                //$valid = Model::validateMultiple($produtos) && $valid;

                //if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                 
                            if (! empty($deletedIDs)) {
                                Produtos::deleteAll(['id' => $deletedIDs]);                                
                            }

                            $prod_imgs_delete = Produtos::findAll(['perfil_empresarial_id'=>$model->id]);
                            foreach ($prod_imgs_delete as $prod_img_delete){
                                if (!empty($prod_img_delete->imagem)){
                                unlink(Yii::getAlias ('@webroot').$prod_img_delete->imagem);
                                }
                            }
                            foreach ($produtos as $produto) {
                    

                                $produto->perfil_empresarial_id = $model->id;

                                if (! ($flag = $produto->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }else{
                                    if($files[$i]){
                                        $y=0;
                                        foreach ($paths as $path) {

                                            $files[$y]->saveAs($paths[$y]);
                                            $y++;
                                        }
                                    }
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                //}
            //}



            return $this->render('principal', [ 
                'model' => $model, 
                'localizacao' =>$localizacao,
                'contato' =>$contato,
                'produtos' => $produtos,
                'perfilative' =>$model->perfil_ative, 
                'localative' =>$localizacao->local_ative, 
                'produtoative' =>$model->produto_ative, 
            ]); 
        } else {
            return $this->render('principal', [ 
                'model' => $model, 
                'localizacao' =>$localizacao,
                'contato' =>$contato,
                'produtos' => $produtos,
                'perfilative' =>$model->perfil_ative, 
                'localative' =>$localizacao->local_ative, 
                'produtoative' =>$model->produto_ative, 
            ]); 
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('principal', [ 
                'model' => $model, 
                'modeltrue' =>true, 
            ]); 
        } else {
            return $this->render('principal', [ 
                'model' => $model, 
                'modeltrue' =>true, 
            ]); 
        }
    }

    /**
     * Deletes an existing PerfilEmpresarial model.
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
     * Finds the PerfilEmpresarial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PerfilEmpresarial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PerfilEmpresarial::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
