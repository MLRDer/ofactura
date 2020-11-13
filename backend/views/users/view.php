<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
?>
<div class="users-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'fio',
            'date_birth',
            'sex',
            'phone',
            'lang',
            'tin',
            'role_id',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'created_at',
            'updated_at',
            'verification_token',
        ],
    ]) ?>

</div>
