<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "m_gender".
 *
 * @property int $id
 * @property string $Name Gender
 * @property string $Code
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string|null $Record_Modified_On
 *
 * @property TUserInfo[] $tUserInfos
 */
class MGender extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_gender';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'Code', 'Record_Created_By'], 'required'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Record_Status'], 'string'],
            [['Name'], 'string', 'max' => 50],
            [['Code'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Gender'),
            'Code' => Yii::t('app', 'Code'),
            'Record_Created_On' => Yii::t('app', 'Record Created On'),
            'Record_Created_By' => Yii::t('app', 'Record Created By'),
            'Record_Updated_By' => Yii::t('app', 'Record Updated By'),
            'Record_Status' => Yii::t('app', 'Record Status'),
            'Record_Modified_On' => Yii::t('app', 'Record Modified On'),
        ];
    }

    /**
     * Gets query for [[TUserInfos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTUserInfos()
    {
        return $this->hasMany(TUserInfo::className(), ['Gender_ID' => 'id']);
    }
}
