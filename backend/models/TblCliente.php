<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_cliente".
 *
 * @property integer $ID
 * @property string $Nome
 * @property integer $BI
 * @property string $Morada
 *
 * @property TblOficina[] $tblOficinas
 */
class TblCliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome', 'BI', 'Morada'], 'required'],
            [['BI'], 'integer'],
            [['Nome', 'Morada'], 'string', 'max' => 100]
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
            'BI' => 'Bi',
            'Morada' => 'Morada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblOficinas()
    {
        return $this->hasMany(TblOficina::className(), ['cliente_id' => 'ID']);
    }
}
