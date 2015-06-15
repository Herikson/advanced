<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "entidade".
 *
 * @property integer $id
 * @property string $nome
 * @property string $descricao
 * @property integer $tp_entidade_id
 * @property string $Marcacoes
 * @property integer $visualizacoes
 * @property string $link
 * @property string $logo
 * @property integer $user_id
 * @property string $entidade_status
 *
 * @property Contatos[] $contatos
 * @property TpEntidade $tpEntidade
 * @property Localizacao[] $localizacaos
 * @property Produtos[] $produtos
 * @property Servicos[] $servicos
 */
class Entidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'descricao', 'tp_entidade_id', 'entidade_status'], 'required'],
            [['descricao', 'Marcacoes', 'entidade_status'], 'string'],
            [['tp_entidade_id', 'visualizacoes', 'user_id'], 'integer'],
            [['nome'], 'string', 'max' => 200],
            [['link'], 'string', 'max' => 500],
            [['logo'], 'string', 'max' => 2000]
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
            'descricao' => 'Descrição',
            'tp_entidade_id' => 'Tp Entidade ID',
            'Marcacoes' => 'Marcações',
            'visualizacoes' => 'Visualizações',
            'link' => 'Link',
            'logo' => 'Logo',
            'user_id' => 'User ID',
            'entidade_status' => 'Entidade Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContatos()
    {
        return $this->hasMany(Contatos::className(), ['entidade_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTpEntidade()
    {
        return $this->hasOne(TpEntidade::className(), ['id' => 'tp_entidade_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalizacaos()
    {
        return $this->hasMany(Localizacao::className(), ['entidade_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produtos::className(), ['entidade_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicos()
    {
        return $this->hasMany(Servicos::className(), ['entidade_id' => 'id']);
    }
}
