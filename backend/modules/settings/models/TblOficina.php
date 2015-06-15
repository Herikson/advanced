<?php

namespace backend\modules\settings\models;

use Yii;

/**
 * This is the model class for table "tbl_oficina".
 *
 * @property integer $ID
 * @property string $Nome
 * @property string $Matricula
 * @property integer $cliente_id
 * @property string $Data_Entrada
 *
 * @property TblCliente $cliente
 */
class TblOficina extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_oficina';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome', 'Matricula', 'cliente_id', 'Data_Entrada'], 'required'],
            [['cliente_id'], 'integer'],
            [['Data_Entrada'], 'safe'],
            [['Nome'], 'string', 'max' => 100],
            [['Matricula'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Nome' => 'Nome',
            'Matricula' => 'Matricula',
            'cliente_id' => 'Cliente ID',
            'Data_Entrada' => 'Data  Entrada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(TblCliente::className(), ['ID' => 'cliente_id']);
    }
}
