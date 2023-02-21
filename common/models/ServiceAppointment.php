<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_appointment".
 *
 * @property int $id
 * @property int $Customer_ID
 * @property int|null $Instructor_ID
 * @property int $Service_ID
 * @property int $Timeslot_ID
 * @property int $Day_ID
 * @property string $Appointment_Date
 * @property int $Duration_Val
 * @property string $Appointment_Status
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string $Record_Modified_On
 *
 * @property TUserInfo $customer
 * @property TUserInfo $instructor
 * @property MTimeslot $timeslot
 * @property MDay $day
 * @property MServices $service
 */
class ServiceAppointment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_appointment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Customer_ID', 'Service_ID', 'Timeslot_ID', 'Day_ID', 'Appointment_Date', 'Duration_Val', 'Record_Created_By'], 'required'],
            [['Customer_ID', 'Instructor_ID', 'Service_ID', 'Timeslot_ID', 'Day_ID', 'Duration_Val', 'Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Appointment_Date', 'Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Appointment_Status', 'Record_Status'], 'string'],
            [['Customer_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TUserInfo::className(), 'targetAttribute' => ['Customer_ID' => 'User_ID']],
            [['Instructor_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TUserInfo::className(), 'targetAttribute' => ['Instructor_ID' => 'User_ID']],
            [['Timeslot_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MTimeslot::className(), 'targetAttribute' => ['Timeslot_ID' => 'id']],
            [['Day_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MDay::className(), 'targetAttribute' => ['Day_ID' => 'id']],
            [['Service_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MServices::className(), 'targetAttribute' => ['Service_ID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Customer_ID' => 'Customer ID',
            'Instructor_ID' => 'Instructor ID',
            'Service_ID' => 'Service ID',
            'Timeslot_ID' => 'Timeslot ID',
            'Day_ID' => 'Day ID',
            'Appointment_Date' => 'Appointment Date',
            'Duration_Val' => 'Duration Val',
            'Appointment_Status' => 'Appointment Status',
            'Record_Created_On' => 'Record Created On',
            'Record_Created_By' => 'Record Created By',
            'Record_Updated_By' => 'Record Updated By',
            'Record_Status' => 'Record Status',
            'Record_Modified_On' => 'Record Modified On',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(TUserInfo::className(), ['User_ID' => 'Customer_ID']);
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

    /**
     * Gets query for [[Timeslot]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimeslot()
    {
        return $this->hasOne(MTimeslot::className(), ['id' => 'Timeslot_ID']);
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
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(MServices::className(), ['id' => 'Service_ID']);
    }
}
