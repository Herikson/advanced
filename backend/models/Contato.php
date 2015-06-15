<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contato".
 *
 * @property integer $id
 * @property integer $perfil_empresarial_id
 * @property string $email
 * @property string $telefone
 * @property integer $telemovel
 *
 * @property PerfilEmpresarial $perfilEmpresarial
 */
class Contato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perfil_empresarial_id'], 'required'],
            [['perfil_empresarial_id', 'telemovel'], 'integer'],
            [['email', 'telefone'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'perfil_empresarial_id' => 'Perfil Empresarial ID',
            'email' => 'Email',
            'telefone' => 'Telefone',
            'telemovel' => 'Telemovel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerfilEmpresarial()
    {
        return $this->hasOne(PerfilEmpresarial::className(), ['id' => 'perfil_empresarial_id']);
    }
}
