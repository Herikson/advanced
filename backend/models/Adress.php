<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "adress".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $full_name
 * @property string $adress_line1
 * @property string $adress_line2
 * @property string $city
 * @property string $state
 * @property string $postal_code
 *
 * @property Costumer $customer
 */
class Adress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adress';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'full_name', 'adress_line1', 'adress_line2', 'city', 'state', 'postal_code'], 'required'],
            [['customer_id'], 'integer'],
            [['full_name'], 'string', 'max' => 128],
            [['adress_line1', 'adress_line2'], 'string', 'max' => 255],
            [['city'], 'string', 'max' => 64],
            [['state'], 'string', 'max' => 32],
            [['postal_code'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'full_name' => 'Full Name',
            'adress_line1' => 'Adress Line1',
            'adress_line2' => 'Adress Line2',
            'city' => 'City',
            'state' => 'State',
            'postal_code' => 'Postal Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Costumer::className(), ['id' => 'customer_id']);
    }
}
