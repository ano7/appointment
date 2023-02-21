<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "m_services".
 *
 * @property int $id
 * @property int|null $Picture_ID Picture
 * @property int $Category_ID Category
 * @property string $Name
 * @property string $Description
 * @property float $Price
 * @property string|null $Course_Level
 * @property int $Duration_Info
 * @property string|null $Start_Date
 * @property string|null $End_Date
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string $Record_Modified_On
 *
 * @property MDocument $picture
 * @property MCategory $category
 * @property ServiceInstructorMapping[] $serviceInstructorMappings
 */
class MServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Picture_ID', 'Category_ID', 'Duration_Info', 'Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Category_ID', 'Name', 'Description', 'Price', 'Duration_Info', 'Record_Created_By'], 'required'],
            [['Description', 'Course_Level', 'Record_Status'], 'string'],
            [['Price'], 'number'],
            [['Start_Date', 'End_Date', 'Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Name'], 'string', 'max' => 100],
            [['Picture_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MDocument::className(), 'targetAttribute' => ['Picture_ID' => 'id']],
            [['Category_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MCategory::className(), 'targetAttribute' => ['Category_ID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Picture_ID' => 'Picture',
            'Category_ID' => 'Category',
            'Name' => 'Name',
            'Description' => 'Description',
            'Price' => 'Price',
            'Course_Level' => 'Course Level',
            'Duration_Info' => 'No. of Hours',
            'Start_Date' => 'Start Date',
            'End_Date' => 'End Date',
            'Record_Created_On' => 'Record Created On',
            'Record_Created_By' => 'Record Created By',
            'Record_Updated_By' => 'Record Updated By',
            'Record_Status' => 'Record Status',
            'Record_Modified_On' => 'Record Modified On',
        ];
    }

    /**
     * Gets query for [[Picture]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPicture()
    {
        return $this->hasOne(MDocument::className(), ['id' => 'Picture_ID']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(MCategory::className(), ['id' => 'Category_ID']);
    }

    /**
     * Gets query for [[ServiceInstructorMappings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceInstructorMappings()
    {
        return $this->hasMany(ServiceInstructorMapping::className(), ['Service_ID' => 'id']);
    }
}
