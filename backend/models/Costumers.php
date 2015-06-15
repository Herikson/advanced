<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "costumers".
 *
 * @property integer $costumer_id
 * @property string $costumer_name
 * @property string $zip_code
 * @property string $cidade
 * @property string $provincia
 */
class Costumers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'costumers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['costumer_name', 'zip_code', 'cidade', 'provincia'], 'required'],
            [['costumer_name', 'cidade', 'provincia'], 'string', 'max' => 100],
            [['zip_code'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'costumer_id' => 'Costumer ID',
            'costumer_name' => 'Costumer Name',
            'zip_code' => 'Zip Code',
            'cidade' => 'Cidade',
            'provincia' => 'Provincia',
        ];
    }
}
