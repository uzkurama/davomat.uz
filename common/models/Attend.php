<?php

namespace common\models;

use Yii;
/**
 * This is the model class for table "{{%attend}}".
 *
 * @property int $id
 * @property int $attend
 * @property int $lesson_id
 * @property int $student_id
 * @property int $group_id
 * @property int $chair_id
 * @property int $faculty_id
 * @property string $date
 */
class Attend extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attend}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attend', 'lesson_id', 'student_id', 'group_id', 'chair_id', 'faculty_id', 'date'], 'required'],
            [['attend', 'lesson_id', 'student_id', 'group_id', 'chair_id', 'faculty_id'], 'integer'],
            [['date'], 'string', 'max' => 20],
        ];
    }

    public function getStudent() {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    public function getGroups() {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function getChairs() {
        return $this->hasOne(Chair::className(), ['id' => 'chair_id']);
    }

    public function getFaculties() {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attend' => 'Davomat',
            'lesson_id' => 'Para',
            'student_id' => 'Talaba',
            'group_id' => 'Guruh',
            'chair_id' => 'Yo\'nalish',
            'faculty_id' => 'Fakultet',
            'date' => 'Sanasi',
        ];
    }

    public function getFaculty()
    {
        $faculty = Faculty::find()->select(['name', 'id'])->indexBy('id')->column();
        return $faculty;
    }

    public function getChair($faculty_id)
    {
        return Chair::find()->select(['id', 'name'])->where(['faculty_id' => $faculty_id])->asArray()->all();
    }

    public function getGroup($faculty_id, $chair_id)
    {
        return Group::find()->select(['id', 'name'])->where(['faculty_id' => $faculty_id, 'chair_id' => $chair_id])->asArray()->all();
    }

    public function getLesson()
    {
        $lesson = Lesson::find()->select(['name', 'id'])->indexBy('id')->column();
        return $lesson;
    }
}
