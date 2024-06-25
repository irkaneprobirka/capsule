<?php

use app\models\LookComment;
use app\models\User;
use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

$parentCommentUser = $model->parent_id ? LookComment::findOne($model->parent_id)->user : null;
$childrenComment = LookComment::find()->where(['parent_id' => $model->id])->all();

?>

<?php
// Ассоциативный массив для отслеживания уже выведенных основных комментариев
$renderedMainComments = [];
?>
<?php if ($model->parent_id == null) : ?>
    <div class="toast show w-75 m-auto mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast" id="comment-<?= $model->id ?>">
        <div class="toast-header">
            <p>#<?= Html::encode($model->id) . ' ' ?></p>
            <?= Html::img('@web/img/' . User::findOne($model->user_id)->image_profile, ['class' => 'avatar avatar-xs me-2 mx-3 rounded-5', 'style' => 'width: 3rem; height: 3rem;']) ?>
            <strong class="me-auto"><?= Html::encode(User::findOne($model->user_id)->login) ?></strong>
            <?= Html::a('Ответить', '#', ['class' => 'reply', 'data-parent' => $model->id]) ?>
        </div>
        <div class="toast-body">
            <p class="d-flex justify-content-end">
                <?php if ($parentCommentUser) : ?>
                    <span class="reply-to">Ответ на комментарий пользователя <?= Html::encode($parentCommentUser->login) . Html::a(' #' . $model->parent_id, '#comment-' . $model->parent_id) ?></span>
                <?php endif; ?>
            </p>
            <?= Html::encode($model->comment) ?>
            <div class="d-flex flex-wrap justify-content-end">
                <p><?= date('m.d.Y H:i', strtotime(Html::encode($model->created_at))) ?></p>
            </div>
        </div>
    </div>
    <?php $renderedMainComments[$model->id] = true; ?>
<?php endif; ?>

<?php if ($childrenComment) : ?>
    <?php foreach ($childrenComment as $key => $child) : ?>
        <div class="toast show w-75 m-auto mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast" id="comment-<?= $child->id ?>">
            <div class="toast-header">
                <p>#<?= Html::encode($child->id) . ' ' ?></p>
                <?= Html::img('@web/img/' . User::findOne($child->user_id)->image_profile, ['class' => 'avatar avatar-xs me-2 rounded-5 mx-3', 'style' => 'width: 3rem; height: 3rem;']) ?>
                <strong class="me-auto"><?= Html::encode(User::findOne($child->user_id)->login) ?></strong>
                <?= Html::a('Ответить', '#', ['class' => 'reply', 'data-parent' => $child->id]) ?>
            </div>
            <div class="toast-body">
                <p class="d-flex justify-content-end">
                    <?php if ($child->parent_id) : ?>
                        <span class="reply-to">Ответ на комментарий пользователя <?= User::findOne(LookComment::findOne($child->parent_id)->user_id)->login . Html::a(' #' . $child->parent_id, '#comment-' . $child->parent_id) ?></span>
                    <?php endif; ?>
                </p>
                <?= Html::encode($child->comment) ?>
                <div class="d-flex flex-wrap justify-content-end">
                    <p><?= date('m.d.Y H:i', strtotime(Html::encode($child->created_at))) ?></p>
                </div>
            </div>
        </div>
        <?php $renderedMainComments[$child->id] = true; ?>
    <?php endforeach; ?>
<?php endif; ?>