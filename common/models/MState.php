<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "m_state".
 *
 * @property int $id
 * @property int $Country_ID
 * @property string $Name
 * @property string $Code
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string|null $Record_Modified_On
 *
 * @property MDistrict[] $mDistricts
 * @property MCountry $country
 * @property TUserInfo[] $tUserInfos
 */
class MState extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_state';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Country_ID', 'Name', 'Code', 'Record_Created_By'], 'required'],
            [['Country_ID', 'Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Record_Status'], 'string'],
            [['Name'], 'string', 'max' => 50],
            [['Code'], 'string', 'max' => 5],
            [['Country_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MCountry::className(), 'targetAttribute' => ['Country_ID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Country_ID' => 'Country ID',
            'Name' => 'Name',
            'Code' => 'Code',
            'Record_Created_On' => 'Record Created On',
            'Record_Created_By' => 'Record Created By',
            'Record_Updated_By' => 'Record Updated By',
            'Record_Status' => 'Record Status',
            'Record_Modified_On' => 'Record Modified On',
        ];
    }

    /**
     * Gets query for [[MDistricts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMDistricts()
    {
        return $this->hasMany(MDistrict::className(), ['State_ID' => 'id']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(MCountry::className(), ['id' => 'Country_ID']);
    }

    /**
     * Gets query for [[TUserInfos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTUserInfos()
    {
        return $this->hasMany(TUserInfo::className(), ['State_ID' => 'id']);
    }
}
