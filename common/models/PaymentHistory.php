<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_history".
 *
 * @property int $id
 * @property int $User_ID
 * @property string $Payer_ID
 * @property string $Paypal_ID
 * @property string $Transaction_ID
 * @property string $Email
 * @property string $First_Name
 * @property string $Last_Name
 * @property string $Amount
 * @property string $Currency_Code
 * @property string $Status
 * @property string $Payment_Created_Date
 * @property string $Payment_Updated_Date
 * @property string $Record_Created_On
 * @property int $Record_Created_By
 * @property int|null $Record_Updated_By
 * @property string $Record_Status
 * @property string|null $Record_Modified_On
 *
 * @property TUserInfo $user
 * @property TUserWallet[] $tUserWallets
 */
class PaymentHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['User_ID', 'Payer_ID', 'Paypal_ID', 'Transaction_ID', 'Email', 'First_Name', 'Last_Name', 'Amount', 'Currency_Code', 'Status', 'Payment_Created_Date', 'Payment_Updated_Date', 'Record_Created_By'], 'required'],
            [['User_ID', 'Record_Created_By', 'Record_Updated_By'], 'integer'],
            [['Record_Created_On', 'Record_Modified_On'], 'safe'],
            [['Record_Status'], 'string'],
            [['Payer_ID', 'Paypal_ID', 'Transaction_ID', 'Email', 'First_Name', 'Last_Name', 'Status', 'Payment_Created_Date', 'Payment_Updated_Date'], 'string', 'max' => 50],
            [['Amount'], 'string', 'max' => 100],
            [['Currency_Code'], 'string', 'max' => 20],
            [['User_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TUserInfo::className(), 'targetAttribute' => ['User_ID' => 'User_ID']],
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
            'Payer_ID' => 'Payer ID',
            'Paypal_ID' => 'Paypal ID',
            'Transaction_ID' => 'Transaction ID',
            'Email' => 'Email',
            'First_Name' => 'First Name',
            'Last_Name' => 'Last Name',
            'Amount' => 'Amount',
            'Currency_Code' => 'Currency Code',
            'Status' => 'Status',
            'Payment_Created_Date' => 'Payment Created Date',
            'Payment_Updated_Date' => 'Payment Updated Date',
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
     * Gets query for [[TUserWallets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTUserWallets()
    {
        return $this->hasMany(TUserWallet::className(), ['Order_ID' => 'id']);
    }
}
