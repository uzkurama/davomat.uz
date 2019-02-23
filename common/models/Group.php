<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%group}}".
 *
 * @property int $id
 * @property string $name
 * @property int $chair_id
 * @property int $faculty_id
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%group}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'chair_id', 'shift_id', 'faculty_id'], 'required'],
            [['chair_id', 'faculty_id', 'shift_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
            'chair_id' => 'Kafedrasi',
            'faculty_id' => 'Fakulteti',
            'shift_id' => 'Smenasi',
        ];
    }

    public function getFaculty()
    {
        return Faculty::find()->select(['name', 'id'])->indexBy('id')->column();
    }

    public function getChair($chair_id)
    {
        return Chair::find()->select(['id', 'name'])->where(['faculty_id' => $chair_id])->asArray()->all();
    }

    public function getGroup($faculty_id, $chair_id)
    {
        return self::find()->select(['id', 'name'])->where(['faculty_id' => $faculty_id, 'chair_id' => $chair_id])->asArray()->all();
    }

    public function getChairs()
    {
        return $this->hasOne(Chair::className(), ['id' => 'chair_id']);
    }

    public function getFaculties()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }
}
