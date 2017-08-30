<?php
/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2016 Modern Kernel
 */


namespace modernkernel\sms\models;

use MongoDB\BSON\UTCDateTime;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SMSSearch represents the model behind the search form about `modernkernel\sms\models\SMS`.
 */
class SMSSearch extends SMS
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sms_id', 'to', 'text', 'created_at'], 'safe'],
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
        $query = SMS::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]],
            //'pagination'=>['pageSize'=>20],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
//        $query->andFilterWhere([
//            //'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//        ]);

        $query->andFilterWhere(['like', 'sms_id', $this->sms_id])
            ->andFilterWhere(['like', 'to', $this->to])
            ->andFilterWhere(['like', 'text', $this->text]);

        if(!empty($this->created_at)){
            if(is_a($this, '\yii\db\ActiveRecord')){
                $query->andFilterWhere([
                    'DATE(CONVERT_TZ(FROM_UNIXTIME(`created_at`), :UTC, :ATZ))' => $this->created_at,
                ])->params([
                    ':UTC'=>'+00:00',
                    ':ATZ'=>date('P')
                ]);
            }
            else {
                $query->andFilterWhere([
                    'created_at' => ['$gte'=>new UTCDateTime(strtotime($this->created_at)*1000)],
                ])->andFilterWhere([
                    'created_at' => ['$lt'=>new UTCDateTime((strtotime($this->created_at)+86400)*1000)],
                ]);
            }

        }

        return $dataProvider;
    }
}
