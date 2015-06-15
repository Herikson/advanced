<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Entidade;

/**
 * EntidadeSearch represents the model behind the search form about `backend\models\Entidade`.
 */
class EntidadeSearch extends Entidade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tp_entidade_id', 'visualizacoes', 'user_id'], 'integer'],
            [['nome', 'descricao', 'Marcacoes', 'link', 'logo', 'entidade_status'], 'safe'],
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
        $query = Entidade::find();

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
            'tp_entidade_id' => $this->tp_entidade_id,
            'visualizacoes' => $this->visualizacoes,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'Marcacoes', $this->Marcacoes])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'entidade_status', $this->entidade_status]);

        return $dataProvider;
    }
}
