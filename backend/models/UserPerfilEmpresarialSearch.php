<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserPerfilEmpresarial;

/**
 * UserPerfilEmpresarialSearch represents the model behind the search form about `backend\models\UserPerfilEmpresarial`.
 */
class UserPerfilEmpresarialSearch extends UserPerfilEmpresarial
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'perfil_empresarial_id'], 'integer'],
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
        $query = UserPerfilEmpresarial::find();

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
            'user_id' => $this->user_id,
            'perfil_empresarial_id' => $this->perfil_empresarial_id,
        ]);

        return $dataProvider;
    }
}
