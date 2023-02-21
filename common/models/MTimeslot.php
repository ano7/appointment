<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "m_timeslot".
 *
 * @property int $id
 * @property int $Start_Time
 * @property int $End_Time
 * @property string $Type
 * @property int $Parent_Timeslot_ID
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string $Record_Modified_On
 *
 * @property MReportingTime $startTime
 * @property MReportingTime $endTime
 * @property ServiceAppointment[] $serviceAppointments
 */
class MTimeslot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_timeslot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Start_Time', 'End_Time', 'Parent_Timeslot_ID', 'Record_Created_By'], 'required'],
            [['Start_Time', 'End_Time', 'Parent_Timeslot_ID', 'Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Type', 'Record_Status'], 'string'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Start_Time'], 'exist', 'skipOnError' => true, 'targetClass' => MReportingTime::className(), 'targetAttribute' => ['Start_Time' => 'id']],
            [['End_Time'], 'exist', 'skipOnError' => true, 'targetClass' => MReportingTime::className(), 'targetAttribute' => ['End_Time' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Start_Time' => 'Start Time',
            'End_Time' => 'End Time',
            'Type' => 'Type',
            'Parent_Timeslot_ID' => 'Parent Timeslot ID',
            'Record_Created_On' => 'Record Created On',
            'Record_Created_By' => 'Record Created By',
            'Record_Updated_By' => 'Record Updated By',
            'Record_Status' => 'Record Status',
            'Record_Modified_On' => 'Record Modified On',
        ];
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
     * Gets query for [[ServiceAppointments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceAppointments()
    {
        return $this->hasMany(ServiceAppointment::className(), ['Timeslot_ID' => 'id']);
    }
}
