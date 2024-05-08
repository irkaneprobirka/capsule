<?php

use app\models\LookComment;
use app\models\User;
use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

$parentCommentUser = $model->parent_id ? $model->parent->user : null;
$childrenComment = LookComment::find()->where(['parent_id' => $model->id])->all();
// VarDumper::dump($parentCommentUser, 10, true);die;

?>

<?php
// Ассоциативный массив для отслеживания уже выведенных основных комментариев
$renderedMainComments = [];
?>
<?php if ($model->parent_id == null) : ?>
    <div class="toast show w-75 m-auto mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
        <div class="toast-header">
            <p>#<?= Html::encode($model->id) . ' ' ?></p>
            <!-- <span class="avatar avatar-xs me-2" style="background-image: url(...)"></span> -->
            <?= Html::img('@web/img/' . User::findOne($model->user_id)->image_profile, ['class' => 'avatar avatar-xs me-2 mx-3 rounded-5', 'style' => 'width: 3rem; height: 3rem;']) ?>
            <strong class="me-auto"><?= Html::encode(User::findOne($model->user_id)->login) ?></strong>
            <?= Html::a('Ответить', '#', ['class' => 'reply', 'data-parent' => $model->id]) ?>
            <!-- <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button> -->
        </div>
        <div class="toast-body">
            <p class="d-flex justify-content-end">
                <?php if ($parentCommentUser) : ?>
                    <span class="reply-to">Ответ на комментарий пользователя <?= Html::encode($parentCommentUser->login) . ' #' . $model->parent->id ?></span>
                <?php endif; ?>
            </p>
            <?= Html::encode($model->comment) ?>
            <div class="d-flex flex-wrap justify-content-end">
                <p><?= date('m.d.Y H:i', strtotime(Html::encode($model->created_at))) ?></p>
            </div>
        </div>
    </div>
    <?php array_push($renderedMainComments, $model->id) ?>
    
<?php endif; ?>
<?php if ($childrenComment) : ?>
    <?php foreach ($childrenComment as $key => $child) : ?>
        <div class="toast show w-75 m-auto mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
            <div class="toast-header">
                <p>#<?= Html::encode($child->id) . ' ' ?></p>
                <!-- <span class="avatar avatar-xs me-2" style="background-image: url(...)"></span> -->
                <?= Html::img('@web/img/' . User::findOne($child->user_id)->image_profile, ['class' => 'avatar avatar-xs me-2 rounded-5 mx-3', 'style' => 'width: 3rem; height: 3rem;']) ?>
                <strong class="me-auto"><?= Html::encode(User::findOne($child->user_id)->login) ?></strong>
                <?= Html::a('Ответить', '#', ['class' => 'reply', 'data-parent' => $model->id]) ?>
                <!-- <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button> -->
            </div>
            <div class="toast-body">
                <p class="d-flex justify-content-end">
                    <?php if ($child->parent_id) : ?>
                        <span class="reply-to">Ответ на комментарий пользователя <?= User::findOne(LookComment::findOne($child->parent_id)->user_id)->login . ' #' . LookComment::findOne($child->parent_id)->id ?></span>
                    <?php endif; ?>
                </p>
                <?= Html::encode($child->comment) ?>
                <div class="d-flex flex-wrap justify-content-end">
                    <p><?= date('m.d.Y H:i', strtotime(Html::encode($child->created_at))) ?></p>
                </div>
            </div>
        </div>
        <?php array_push($renderedMainComments, $child->id) ?>
    <?php endforeach; ?>
<?php endif; ?>