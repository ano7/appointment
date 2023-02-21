<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Dear <?= $user->username ?>,

<?=$user->password_reset_token?> is your OTP (One Time Password) for resetting your password for the account 52142969 on <?=Yii::$app->name?>.
