<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_user_order_detail".
 *
 * @property int $id
 * @property int $User_ID
 * @property int|null $Order_ID
 * @property int|null $Appointment_ID
 * @property int $Amount
 * @property string $Transaction_Type
 * @property int $Available_Amount
 * @property string $Order_Status
 * @property string|null $Remarks
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string $Record_Modified_On
 *
 * @property TUserInfo $user
 * @property ServiceAppointment $appointment
 * @property PaymentHistory $order
 */
class TUserOrderDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_user_order_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['User_ID', 'Amount', 'Transaction_Type', 'Available_Amount', 'Record_Created_By'], 'required'],
            [['User_ID', 'Order_ID', 'Appointment_ID', 'Amount', 'Available_Amount', 'Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Transaction_Type', 'Order_Status', 'Remarks', 'Record_Status'], 'string'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['User_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TUserInfo::className(), 'targetAttribute' => ['User_ID' => 'User_ID']],
            [['Appointment_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceAppointment::className(), 'targetAttribute' => ['Appointment_ID' => 'id']],
            [['Order_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentHistory::className(), 'targetAttribute' => ['Order_ID' => 'id']],
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
            'Order_ID' => 'Order ID',
            'Appointment_ID' => 'Appointment ID',
            'Amount' => 'Amount',
            'Transaction_Type' => 'Transaction Type',
            'Available_Amount' => 'Available Amount',
            'Order_Status' => 'Order Status',
            'Remarks' => 'Remarks',
            'Record_Created_On' => 'Record Created On',
            'Record_Created_By' => 'Record Created By',
            'Record_Updated_By' => 'Record Updated By',
            'Record_Status' => 'Record Status',
            'Record_Modified_On' => 'Record Modified On',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TUserInfo::className(), ['User_ID' => 'User_ID']);
    }

    /**
     * Gets query for [[Appointment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppointment()
    {
        return $this->hasOne(ServiceAppointment::className(), ['id' => 'Appointment_ID']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(PaymentHistory::className(), ['id' => 'Order_ID']);
    }
}
