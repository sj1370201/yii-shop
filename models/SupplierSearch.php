<?php

namespace app\models;

use app\constants\SupplierConstant;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SupplierSearch represents the model behind the search form of `app\models\Supplier`.
 */
class SupplierSearch extends Supplier
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'code', 't_status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Supplier::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//        ]);

        $this->id_symbol = empty($params['SupplierSearch']['id_symbol']) ? 0 : $params['SupplierSearch']['id_symbol'];
        $idList = [];
        if (!empty($params['checkedIdArr'])) {
            $idList = explode("," ,$params['checkedIdArr']);
        }

//        $query->andFilterWhere([SupplierConstant::$idSymbolArr[$params['SupplierSearch']['id_symbol']], 'id', $this->id])
        $query->andFilterWhere([SupplierConstant::$idSymbolArr[$this->id_symbol], 'id', $this->id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['=', 't_status', !empty($this->t_status) ? SupplierConstant::$tStatusArr[$this->t_status] : ''])
            ->andFilterWhere(['in', 'id',  $idList]);
//        var_dump($query->createCommand()->getRawSql());
        return $dataProvider;
    }
}
