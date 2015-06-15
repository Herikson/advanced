<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "perfil_empresarial".
 *
 * @property integer $id
 * @property integer $perfil_pai_id
 * @property string $nome
 * @property string $descricao
 * @property string $tipo
 * @property string $Marcacoes
 * @property integer $visualizacoes
 * @property string $site_url
 * @property string $logo
 * @property string $logo_rooturl
 * @property string $Data_criacao
 * @property integer $user_id
 * @property string $status
 *
 * @property Contato[] $contatos
 * @property Localizacao[] $localizacaos
 * @property PerfilEmpresarial $perfilPai
 * @property PerfilEmpresarial[] $perfilEmpresarials
 * @property Produtos[] $produtos
 * @property Servicos[] $servicos
 */
class PerfilEmpresarial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $perfil_ative;
    public $produto_ative;

    public static function tableName()
    {
        return 'perfil_empresarial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perfil_pai_id', 'visualizacoes', 'user_id'], 'integer'],
            [['descricao', 'Marcacoes', 'status'], 'string'],
            [['logo', 'logo_rooturl', 'status'], 'required'],
            [['Data_criacao'], 'safe'],
            ['perfil_ative','boolean'],
            ['produto_ative','boolean'],
            [['nome'], 'string', 'max' => 200],
            [['tipo', 'site_url'], 'string', 'max' => 500],
            [['logo', 'logo_rooturl'], 'string', 'max' => 2000],
            [['nome'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'perfil_pai_id' => 'Filial de...',
            'nome' => 'Nome',
            'descricao' => 'Descrição',
            'tipo' => 'Tipo',
            'Marcacoes' => 'Marcações',
            'visualizacoes' => 'Visualizações',
            'site_url' => 'Site Url',
            'logo' => 'Logo',
            'logo_rooturl' => 'Logo Rooturl',
            'Data_criacao' => 'Data Criação',
            'user_id' => 'User ID',
            'status' => 'Estado Atual',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContatos()
    {
        return $this->hasMany(Contato::className(), ['perfil_empresarial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalizacaos()
    {
        return $this->hasMany(Localizacao::className(), ['perfil_empresarial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerfilPai()
    {
        return $this->hasOne(PerfilEmpresarial::className(), ['id' => 'perfil_pai_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerfilEmpresarials()
    {
        return $this->hasMany(PerfilEmpresarial::className(), ['perfil_pai_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produtos::className(), ['perfil_empresarial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicos()
    {
        return $this->hasMany(Servicos::className(), ['perfil_empresarial_id' => 'id']);
    }
}
