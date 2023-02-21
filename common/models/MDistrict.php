<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "m_district".
 *
 * @property int $id
 * @property int $State_ID
 * @property string $Name District
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string $Record_Modified_On
 *
 * @property MState $state
 * @property TUserInfo[] $tUserInfos
 */
class MDistrict extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['State_ID', 'Name', 'Record_Created_By'], 'required'],
            [['State_ID', 'Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Record_Status'], 'string'],
            [['Name'], 'string', 'max' => 50],
            [['State_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MState::className(), 'targetAttribute' => ['State_ID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'State_ID' => 'State ID',
            'Name' => 'District',
            'Record_Created_On' => 'Record Created On',
            'Record_Created_By' => 'Record Created By',
            'Record_Updated_By' => 'Record Updated By',
            'Record_Status' => 'Record Status',
            'Record_Modified_On' => 'Record Modified On',
        ];
    }

    /**
     * Gets query for [[State]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(MState::className(), ['id' => 'State_ID']);
    }

    /**
     * Gets query for [[TUserInfos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTUserInfos()
    {
        return $this->hasMany(TUserInfo::className(), ['District_ID' => 'id']);
    }
}
