<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "costumer".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 *
 * @property Adress[] $adresses
 */
class Costumer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'costumer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdresses()
    {
        return $this->hasMany(Adress::className(), ['customer_id' => 'id']);
    }
}
