<?php

namespace backend\controllers;

use backend\models\PerfilEmpresarial;
use backend\models\UserPerfilEmpresarial;
use yii\web\Session;

class UploadlogoController extends \yii\web\Controller
{
    public function actionCreate()
    {
        if (empty($_FILES['images'])) {
            echo json_encode(['error'=>'Nenhum Ficheiro selecionado']);
            return; // or process or throw an exception
        }

    $root=$_POST['root'];
    $base_url=$_POST['base_url'];

    // get the files posted
    $images = $_FILES['images'];
    $user_id= $_POST['user_id'];
    // get user id posted
    // $userid = empty($_POST['userid']) ? '' : $_POST['userid'];

    // get user name posted
    // $username = empty($_POST['username']) ? '' : $_POST['username'];

    // a flag to see if everything is ok
    $success = null;

    // file paths to store
    $paths= [];
    $paths_db= [];
    
    // loop and process files
    for($i=0; $i < 1; $i++){

        $ext = explode('.', basename($images['name'][$i]));
        $url="/Uploads/Logotipo/" . md5(uniqid()) . "." . $ext[count($ext)-1];
        $target_path = $root.$url;
        $base_url = $base_url.$url;

        if(move_uploaded_file($images['tmp_name'][$i], $target_path)) {
            $success = true;
            $paths[] = $target_path;
            
        }else{
            $success = false;
            break;
        }

    }
    
    $output=[];

    //check and process based on successful status 
    if ($success === true){
        // Guardar dados na database:

        if (($model_user_perfil= UserPerfilEmpresarial::findOne($user_id)) !== null) {
            
            $model= PerfilEmpresarial::findOne($model_user_perfil->perfil_empresarial_id);

            $paths_db[] = $model->logo_rooturl;
            //Elimina os ficheiros anteriormente guardados:
            foreach ($paths_db as $file) 
                unlink($file);
            //Actualiza com novos dados:
            $model->logo=$base_url;
            $model->logo_rooturl=$target_path;
            $model->save();

        }else{
            $model = new PerfilEmpresarial();
            //Upload pela primeira vez:
            $model->logo=$base_url;
            $model->logo_rooturl=$target_path;
            $model->Data_criacao=date('Y-m-d h:m:s');
            $model->user_id=$user_id;
            $model->status='Inativo';
                
            $model->save();

            $totalerror =count($model->getErrors());

            if ($totalerror > 0){
                $output = ['error'=>'(DB error): Falha ao carregar Logotipo'];
                foreach ($paths as $file) 
                    unlink($file);
            }else{
                $model_user_perfil = new UserPerfilEmpresarial();
                //Fazer controlo do perfil criado:
                $model_user_perfil->user_id=$user_id;
                $model_user_perfil->perfil_empresarial_id=$model->id;
                $model_user_perfil->save();
            }
        }
        
     }else{
        if ($success === false) {
            $output = ['error'=>'Falha ao carregar Logotipo'];
            // delete any uploaded files
            foreach ($paths as $file) 
                unlink($file);
            }
         else
            $output = ['error'=>'Falha ao carregar Logotipo'];
        }
    // return a json encoded response for plugin to process successfully
    echo json_encode($output);
    return;

    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
