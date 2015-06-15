<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "produtos".
 *
 * @property integer $id
 * @property string $nome
 * @property string $imagem
 * @property integer $preco
 * @property integer $desconto
 * @property integer $perfil_empresarial_id
 *
 * @property PerfilEmpresarial $perfilEmpresarial
 */
class Produtos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'produtos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['preco', 'desconto', 'perfil_empresarial_id'], 'integer'],
            [['perfil_empresarial_id'], 'required'],
            [['nome'], 'string', 'max' => 45],
            [['imagem'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'imagem' => 'Imagem',
            'preco' => 'Preco',
            'desconto' => 'Desconto',
            'perfil_empresarial_id' => 'Perfil Empresarial ID',
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
