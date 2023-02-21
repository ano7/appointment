<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "m_reporting_time".
 *
 * @property int $id
 * @property string $Type
 * @property string $Time_Slot
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string $Record_Modified_On
 *
 * @property MTimeslot[] $mTimeslots
 * @property MTimeslot[] $mTimeslots0
 * @property MWorkhour[] $mWorkhours
 * @property MWorkhour[] $mWorkhours0
 */
class MReportingTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_reporting_time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Type', 'Time_Slot', 'Record_Created_By'], 'required'],
            [['Type', 'Record_Status'], 'string'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Time_Slot'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Type' => 'Type',
            'Time_Slot' => 'Time Slot',
            'Record_Created_On' => 'Record Created On',
            'Record_Created_By' => 'Record Created By',
            'Record_Updated_By' => 'Record Updated By',
            'Record_Status' => 'Record Status',
            'Record_Modified_On' => 'Record Modified On',
        ];
    }

    /**
     * Gets query for [[MTimeslots]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMTimeslots()
    {
        return $this->hasMany(MTimeslot::className(), ['Start_Time' => 'id']);
    }

    /**
     * Gets query for [[MTimeslots0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMTimeslots0()
    {
        return $this->hasMany(MTimeslot::className(), ['End_Time' => 'id']);
    }

    /**
     * Gets query for [[MWorkhours]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMWorkhours()
    {
        return $this->hasMany(MWorkhour::className(), ['Start_Time' => 'id']);
    }

    /**
     * Gets query for [[MWorkhours0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMWorkhours0()
    {
        return $this->hasMany(MWorkhour::className(), ['End_Time' => 'id']);
    }
}
