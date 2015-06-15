<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pais".
 *
 * @property integer $paisId
 * @property string $paisNome
 * @property string $paisName
 */
class Pais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pais';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paisNome', 'paisName'], 'required'],
            [['paisNome', 'paisName'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'paisId' => 'Pais ID',
            'paisNome' => 'Pais Nome',
            'paisName' => 'Pais Name',
        ];
    }
}
