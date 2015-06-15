<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Produtos;

/**
 * ProdutosSearch represents the model behind the search form about `backend\models\Produtos`.
 */
class ProdutosSearch extends Produtos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'preco', 'desconto', 'perfil_empresarial_id'], 'integer'],
            [['nome', 'imagem'], 'safe'],
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
        $query = Produtos::find();

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
            'preco' => $this->preco,
            'desconto' => $this->desconto,
            'perfil_empresarial_id' => $this->perfil_empresarial_id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'imagem', $this->imagem]);

        return $dataProvider;
    }
}
