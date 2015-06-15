<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_perfil_empresarial".
 *
 * @property integer $user_id
 * @property integer $perfil_empresarial_id
 *
 * @property User $user
 */
class UserPerfilEmpresarial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_perfil_empresarial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'perfil_empresarial_id'], 'required'],
            [['user_id', 'perfil_empresarial_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'perfil_empresarial_id' => 'Perfil Empresarial ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
