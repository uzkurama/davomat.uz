<?php

namespace common\models;

use Yii;
use common\models\Group;
use common\models\Attend;
// use commmon\models\Group;

/**
 * This is the model class for table "{{%chair}}".
 *
 * @property int $id
 * @property string $name
 * @property int $faculty_id
 */
class Chair extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%chair}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'faculty_id'], 'required'],
            [['faculty_id'], 'integer'],
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
            'faculty_id' => 'Fakulteti',
        ];
    }

    public function getGroups()
    {
        return $this->hasOne(Group::className(), ['chair_id' => 'id']);
    }

    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }
}
