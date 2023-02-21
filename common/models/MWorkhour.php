<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "m_workhour".
 *
 * @property int $id
 * @property int $Instructor_ID
 * @property int $Day_ID Day
 * @property int|null $Start_Time
 * @property int|null $End_Time
 * @property string|null $Is_Break
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string $Record_Modified_On
 *
 * @property MDay $day
 * @property MReportingTime $startTime
 * @property MReportingTime $endTime
 * @property TUserInfo $instructor
 */
class MWorkhour extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_workhour';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Instructor_ID', 'Day_ID', 'Record_Created_By'], 'required'],
            [['Instructor_ID', 'Day_ID', 'Start_Time', 'End_Time', 'Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Is_Break', 'Record_Status'], 'string'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Day_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MDay::className(), 'targetAttribute' => ['Day_ID' => 'id']],
            [['Start_Time'], 'exist', 'skipOnError' => true, 'targetClass' => MReportingTime::className(), 'targetAttribute' => ['Start_Time' => 'id']],
            [['End_Time'], 'exist', 'skipOnError' => true, 'targetClass' => MReportingTime::className(), 'targetAttribute' => ['End_Time' => 'id']],
            [['Instructor_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TUserInfo::className(), 'targetAttribute' => ['Instructor_ID' => 'User_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Instructor_ID' => 'Instructor ID',
            'Day_ID' => 'Day',
            'Start_Time' => 'Start Time',
            'End_Time' => 'End Time',
            'Is_Break' => 'Is Break',
            'Record_Created_On' => 'Record Created On',
            'Record_Created_By' => 'Record Created By',
            'Record_Updated_By' => 'Record Updated By',
            'Record_Status' => 'Record Status',
            'Record_Modified_On' => 'Record Modified On',
        ];
    }

    /**
     * Gets query for [[Day]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDay()
    {
        return $this->hasOne(MDay::className(), ['id' => 'Day_ID']);
    }

    /**
     * Gets query for [[StartTime]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStartTime()
    {
        return $this->hasOne(MReportingTime::className(), ['id' => 'Start_Time']);
    }

    /**
     * Gets query for [[EndTime]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEndTime()
    {
        return $this->hasOne(MReportingTime::className(), ['id' => 'End_Time']);
    }

    /**
     * Gets query for [[Instructor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructor()
    {
        return $this->hasOne(TUserInfo::className(), ['User_ID' => 'Instructor_ID']);
    }
}
