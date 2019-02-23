<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%student}}".
 *
 * @property int $id
 * @property string $name
 * @property int $group_id
 * @property int $chair_id
 * @property int $faculty_id
 */
class Student extends \yii\db\ActiveRecord
{
    public $imgFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%student}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'group_id', 'chair_id', 'faculty_id','gender_id','course_id','shift_id'], 'required'],
            [['group_id', 'chair_id', 'faculty_id', 'passport_number', 'study_finan', 'phone_number', 'type_home','gender_id', 'mother_number', 'father_number'], 'integer'],
            [['name', 'adress'], 'string', 'max' => 100],
            [['mother_name', 'father_name', 'mother_post', 'father_post'], 'string', 'max' => 200],
            [['image', 'passport_seria', 'born_date'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'F.I.Sh.',
            'group_id' => 'Guruhi',
            'chair_id' => 'Yo\'nalishi',
            'shift_id' => 'Smenasi',
            'course_id' => 'Kurs',
            'faculty_id' => 'Fakulteti',
            'image' => 'Rasm',
            'imgFile' => 'Rasm',
            'born_date' => 'Tug\'ilgan sanasi',
            'passport_seria' => 'Passport seriya',
            'passport_number' => 'Passport raqami',
            'adress' => 'Uy manzili',
            'type_home' => 'Turar joyi',
            'study_finan' => 'O\'quv turi',
            'phone_number' => 'Telefon raqami',
            'gender_id' => 'Jinsi',
            'father_name' => 'Otasining ismi',
            'mother_name' => 'Onasining ismi',
            'father_post' => 'Otasining ish joyi',
            'mother_post' => 'Onasining ish joyi',
            'father_number' => 'Otasining tel. raqami',
            'mother_number' => 'Onasining tel. raqami',
        ];
    }

    public function getFaculty()
    {
        $faculty = Faculty::find()->select(['name', 'id'])->indexBy('id')->column();
        return $faculty;
    }

    public function getTypes() {
        $type = Type::find()->select(['name', 'id'])->indexBy('id')->column();
        return $type;
    }

    public function getChair($faculty_id)
    {
        return Chair::find()->select(['id', 'name'])->where(['faculty_id' => $faculty_id])->asArray()->all();
    }

    public function getGroup()
    {
        return Group::find()->select(['name'])->where(['faculty_id' => Yii::$app->user->identity->faculty_id])->asArray()->all();
    }

    public function getGroup_details()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function getChairs() {
        return $this->hasOne(Chair::className(), ['id' => 'chair_id']);
    }

    public function getFaculties() {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }

    public function getType() {
        return $this->hasOne(Type::className(), ['id' => 'type_home']);
    }
}
