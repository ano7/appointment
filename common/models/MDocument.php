<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "m_document".
 *
 * @property int $id
 * @property string $Name
 * @property string $Type
 * @property string $Content
 * @property float $Size
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string|null $Record_Modified_On
 *
 * @property MServices[] $mServices
 */
class MDocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'Type', 'Content', 'Size', 'Record_Created_By'], 'required'],
            [['Content', 'Record_Status'], 'string'],
            [['Size'], 'number'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Name'], 'string', 'max' => 100],
            [['Type'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Name'),
            'Type' => Yii::t('app', 'Type'),
            'Content' => Yii::t('app', 'Content'),
            'Size' => Yii::t('app', 'Size'),
            'Record_Created_On' => Yii::t('app', 'Record Created On'),
            'Record_Created_By' => Yii::t('app', 'Record Created By'),
            'Record_Updated_By' => Yii::t('app', 'Record Updated By'),
            'Record_Status' => Yii::t('app', 'Record Status'),
            'Record_Modified_On' => Yii::t('app', 'Record Modified On'),
        ];
    }

    /**
     * Gets query for [[MServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMServices()
    {
        return $this->hasMany(MServices::className(), ['Picture_ID' => 'id']);
    }
}
