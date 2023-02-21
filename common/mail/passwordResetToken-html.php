<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Dear <?= Html::encode($user->username) ?>,</p>

    <p><?=$user->password_reset_token?> is your OTP (One Time Password) for resetting your password for the account on <?=Yii::$app->name?>.</p>
    
</div>
