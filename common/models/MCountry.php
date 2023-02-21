<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "m_country".
 *
 * @property int $id
 * @property string $Name
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string|null $Record_Modified_On
 *
 * @property MState[] $mStates
 */
class MCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'Record_Created_By'], 'required'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Record_Status'], 'string'],
            [['Name'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'Record_Created_On' => 'Record Created On',
            'Record_Created_By' => 'Record Created By',
            'Record_Updated_By' => 'Record Updated By',
            'Record_Status' => 'Record Status',
            'Record_Modified_On' => 'Record Modified On',
        ];
    }

    /**
     * Gets query for [[MStates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMStates()
    {
        return $this->hasMany(MState::className(), ['Country_ID' => 'id']);
    }
}
