<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_user_info".
 *
 * @property int $id
 * @property int|null $User_ID
 * @property string $User_Type
 * @property string $Name
 * @property int $Contact_No
 * @property int $Gender_ID Gender
 * @property int|null $Picture_ID Profile Picture
 * @property int $State_ID
 * @property int $District_ID
 * @property string $Address
 * @property string $Record_Created_On
 * @property int|null $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string $Record_Modified_On
 *
 * @property MWorkhour[] $mWorkhours
 * @property PaymentHistory[] $paymentHistories
 * @property ServiceAppointment[] $serviceAppointments
 * @property ServiceAppointment[] $serviceAppointments0
 * @property ServiceInstructorMapping[] $serviceInstructorMappings
 * @property User $user
 * @property MGender $gender
 * @property MDocument $picture
 * @property MState $state
 * @property MDistrict $district
 * @property TUserOrderDetail[] $tUserOrderDetails
 */
class TUserInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_user_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['User_ID', 'Contact_No', 'Gender_ID', 'Picture_ID', 'State_ID', 'District_ID', 'Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['User_Type', 'Name', 'Contact_No', 'Gender_ID', 'State_ID', 'District_ID', 'Address'], 'required'],
            [['User_Type', 'Record_Status'], 'string'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Name'], 'string', 'max' => 50],
            [['Address'], 'string', 'max' => 255],
            [['User_ID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['User_ID' => 'id']],
            [['Gender_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MGender::className(), 'targetAttribute' => ['Gender_ID' => 'id']],
            [['Picture_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MDocument::className(), 'targetAttribute' => ['Picture_ID' => 'id']],
            [['State_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MState::className(), 'targetAttribute' => ['State_ID' => 'id']],
            [['District_ID'], 'exist', 'skipOnError' => true, 'targetClass' => MDistrict::className(), 'targetAttribute' => ['District_ID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'User_ID' => 'User ID',
            'User_Type' => 'User Type',
            'Name' => 'Name',
            'Contact_No' => 'Contact No',
            'Gender_ID' => 'Gender',
            'Picture_ID' => 'Profile Picture',
            'State_ID' => 'State',
            'District_ID' => 'District',
            'Address' => 'Address',
            'Record_Created_On' => 'Record Created On',
            'Record_Created_By' => 'Record Created By',
            'Record_Updated_By' => 'Record Updated By',
            'Record_Status' => 'Record Status',
            'Record_Modified_On' => 'Record Modified On',
        ];
    }

    /**
     * Gets query for [[MWorkhours]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMWorkhours()
    {
        return $this->hasMany(MWorkhour::className(), ['Instructor_ID' => 'User_ID']);
    }

    /**
     * Gets query for [[PaymentHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentHistories()
    {
        return $this->hasMany(PaymentHistory::className(), ['User_ID' => 'User_ID']);
    }

    /**
     * Gets query for [[ServiceAppointments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceAppointments()
    {
        return $this->hasMany(ServiceAppointment::className(), ['Customer_ID' => 'User_ID']);
    }

    /**
     * Gets query for [[ServiceAppointments0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceAppointments0()
    {
        return $this->hasMany(ServiceAppointment::className(), ['Instructor_ID' => 'User_ID']);
    }

    /**
     * Gets query for [[ServiceInstructorMappings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceInstructorMappings()
    {
        return $this->hasMany(ServiceInstructorMapping::className(), ['Instructor_ID' => 'User_ID']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'User_ID']);
    }

    /**
     * Gets query for [[Gender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(MGender::className(), ['id' => 'Gender_ID']);
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
     * Gets query for [[State]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(MState::className(), ['id' => 'State_ID']);
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(MDistrict::className(), ['id' => 'District_ID']);
    }

    /**
     * Gets query for [[TUserOrderDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTUserOrderDetails()
    {
        return $this->hasMany(TUserOrderDetail::className(), ['User_ID' => 'User_ID']);
    }
}
