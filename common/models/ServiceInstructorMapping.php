<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_instructor_mapping".
 *
 * @property int $id
 * @property int $Service_ID Service
 * @property int $Instructor_ID Instructor
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string $Record_Modified_On
 *
 * @property MServices $service
 * @property TUserInfo $instructor
 */
class ServiceInstructorMapping extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_instructor_mapping';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Service_ID', 'Instructor_ID', 'Record_Created_By'], 'required'],
            [['Service_ID', 'Instructor_ID', 'Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Record_Status'], 'string'],
            [['Service_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MServices::className(), 'targetAttribute' => ['Service_ID' => 'id']],
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
            'Service_ID' => 'Service',
            'Instructor_ID' => 'Instructor',
            'Record_Created_On' => 'Record Created On',
            'Record_Created_By' => 'Record Created By',
            'Record_Updated_By' => 'Record Updated By',
            'Record_Status' => 'Record Status',
            'Record_Modified_On' => 'Record Modified On',
        ];
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
