<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Attend;

/**
 * AttendSearch represents the model behind the search form of `common\models\Attend`.
 */
class AttendSearch extends Attend
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'chair_id', 'faculty_id', 'date'], 'required'],
            [['id', 'attend', 'lesson_id', 'student_id', 'group_id', 'chair_id', 'faculty_id'], 'integer'],
            [['d', 'date'], 'safe'],
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
        $query = Attend::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->load($params, '')) {}

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'attend' => $this->attend,
            'lesson_id' => $this->lesson_id,
            'student_id' => $this->student_id,
            'group_id' => $this->group_id,
            'chair_id' => $this->chair_id,
            'faculty_id' => $this->faculty_id,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }

    public function formName() {
         return '';
    }
}
