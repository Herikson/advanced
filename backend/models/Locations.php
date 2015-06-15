<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property integer $local_id
 * @property string $zip_code
 * @property string $cidade
 * @property string $provincia
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zip_code', 'cidade', 'provincia'], 'required'],
            [['zip_code'], 'string', 'max' => 20],
            [['cidade', 'provincia'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'local_id' => 'Local ID',
            'zip_code' => 'Zip Code',
            'cidade' => 'Cidade',
            'provincia' => 'Provincia',
        ];
    }
}
