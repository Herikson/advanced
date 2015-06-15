<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Localizacao;

/**
 * LocalizacaoSearch represents the model behind the search form about `backend\models\Localizacao`.
 */
class LocalizacaoSearch extends Localizacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pais', 'ilha', 'cidade', 'zona', 'rua'], 'safe'],
            [['entidade_id'], 'integer'],
            [['google_latitude', 'google_longitude'], 'number'],
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
        $query = Localizacao::find();

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
            'entidade_id' => $this->entidade_id,
            'google_latitude' => $this->google_latitude,
            'google_longitude' => $this->google_longitude,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'ilha', $this->ilha])
            ->andFilterWhere(['like', 'cidade', $this->cidade])
            ->andFilterWhere(['like', 'zona', $this->zona])
            ->andFilterWhere(['like', 'rua', $this->rua]);

        return $dataProvider;
    }
}
