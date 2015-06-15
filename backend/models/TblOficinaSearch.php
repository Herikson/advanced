<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TblOficina;

/**
 * TblOficinaSearch represents the model behind the search form about `backend\models\TblOficina`.
 */
class TblOficinaSearch extends TblOficina
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'cliente_id'], 'integer'],
            [['Nome', 'Matricula', 'Data_Entrada'], 'safe'],
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
        $query = TblOficina::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ID' => $this->ID,
            'cliente_id' => $this->cliente_id,
            'Data_Entrada' => $this->Data_Entrada,
        ]);

        $query->andFilterWhere(['like', 'Nome', $this->Nome])
            ->andFilterWhere(['like', 'Matricula', $this->Matricula]);

        return $dataProvider;
    }
}
