<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PerfilEmpresarial;

/**
 * PerfilEmpresarialSearch represents the model behind the search form about `backend\models\PerfilEmpresarial`.
 */
class PerfilEmpresarialSearch extends PerfilEmpresarial
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'perfil_pai_id', 'visualizacoes', 'user_id'], 'integer'],
            [['nome', 'descricao', 'tipo', 'Marcacoes', 'site_url', 'logo', 'logo_rooturl', 'Data_criacao', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PerfilEmpresarial::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'perfil_pai_id' => $this->perfil_pai_id,
            'visualizacoes' => $this->visualizacoes,
            'Data_criacao' => $this->Data_criacao,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'Marcacoes', $this->Marcacoes])
            ->andFilterWhere(['like', 'site_url', $this->site_url])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'logo_rooturl', $this->logo_rooturl])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
