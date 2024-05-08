<?php

use app\models\User;
use yii\bootstrap5\Html;

$parentCommentUser = $model->parent ? $model->parent->user : null;

?>

<div class="d-flex border border-1 rounded-3 p-3 align-items-center m-1 w-100">
    <?= Html::img('@web/img/' . User::findOne($model->user_id)->image_profile, ['class' => 'flex-shrink-0 me-3 rounded-circle', 'style' => 'width: 3rem; height: 3rem;']) ?>
    <div class="d-flex flex-column justify-content-end" style="width: 100%;">
        <div class="d-flex flex-wrap justify-content-between">
            <h5 class="mt-0"><?= Html::encode(User::findOne($model->user_id)->login) ?></h5>
            <p>
                <?php if ($parentCommentUser) : ?>
                    <span class="reply-to">Ответ на комментарий пользователя <?= Html::encode($parentCommentUser->login) ?></span>
                <?php endif; ?>
            </p>
        </div>
        <p><?= Html::encode($model->comment) ?></p>
    </div>
</div>