<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "localizacao".
 *
 * @property string $id
 * @property integer $perfil_empresarial_id
 * @property integer $pais_id
 * @property integer $ilha_id
 * @property string $cidade
 * @property string $zona
 * @property string $rua
 * @property double $google_latitude
 * @property double $google_longitude
 *
 * @property Ilha $ilha
 * @property PerfilEmpresarial $perfilEmpresarial
 */
class Localizacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $google_local; 
    public $local_ative;

    public static function tableName()
    {
        return 'localizacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perfil_empresarial_id'], 'required'],
            [['perfil_empresarial_id', 'pais_id', 'ilha_id'], 'integer'],
            [['google_latitude', 'google_longitude'], 'number'],
            ['local_ative','boolean'],
            [['id', 'cidade', 'zona', 'rua'], 'string', 'max' => 45]
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
            'pais_id' => 'Paises...',
            'ilha_id' => 'Ilha',
            'cidade' => 'Cidade',
            'zona' => 'Zona',
            'rua' => 'Rua',
            'google_latitude' => 'Google Latitude',
            'google_longitude' => 'Google Longitude',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIlha()
    {
        return $this->hasOne(Ilha::className(), ['id' => 'ilha_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerfilEmpresarial()
    {
        return $this->hasOne(PerfilEmpresarial::className(), ['id' => 'perfil_empresarial_id']);
    }
}
