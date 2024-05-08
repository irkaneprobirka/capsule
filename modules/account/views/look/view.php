<?php

use app\models\Clothes;
use app\models\LookComment;
use app\models\LookItem;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Look $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Looks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="look-view">

    <?php Pjax::begin([
        'id' => 'catalog-view-pjax',
    ]) ?>


    <h1 class='d-flex justify-content-center '><?= Html::encode($this->title) ?></h1>

    <p>
        <? Html::a('Назад', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <? LookComment::find()->where(['look_id' => $model->id])->all() == null
            ? Html::a('Удалить образ', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить?',
                    'method' => 'post',
                ],
            ]) : '' ?>
    </p>
    <?php
    $lookItems = LookItem::find()->where(['look_id' => $model->id])->all();
    $clothesIds = [];
    foreach ($lookItems as $lookItem) {
        $clothesIds[] = $lookItem->clothes_id;
    }

    // получение данных для отображения карточек одежды
    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => Clothes::find()->where(['id' => $clothesIds]),
        'pagination' => false, // Отключаем пагинацию, чтобы отобразить все карточки
    ]);
    ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => "<div class='d-flex rounded-3 p-3 align-items-center justify-content-between flex-wrap m-3'>{items}</div>",
        'itemView' => 'itemClothesViewLook', // Представление для каждой карточки одежды
    ]) ?>

    

    <?php if(!$model->is_copied == 1):?>
    <?php $form = ActiveForm::begin(['action' => ['create-comment', 'look_id' => $model->id], 'options' => ['class' => 'w-75 m-auto']]); ?>

    <?= $form->field($commentModel, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($commentModel, 'parent_id')->hiddenInput()->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    $commentdataProvider = new \yii\data\ActiveDataProvider([
        'query' => LookComment::find()->where(['look_id' => $model->id]),
    ]);
    ?>

    <?= ListView::widget([
        'dataProvider' => $commentdataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => "<div class='d-flex toast show w-100 mt-3 flex-column'>{items}</div>",
        'itemView' => 'itemComment', // Представление для каждого комментария
    ]) ?>

    <?php ActiveForm::end(); ?>
    <?php endif;?>
    <?php Pjax::end() ?>
</div>

<?php
// JavaScript для обработки нажатия на ссылку "Ответить"
$js = <<<JS
$(document).ready(function() {
    $('.reply').click(function(e) {
        e.preventDefault();
        var parentId = $(this).data('parent');
        $('#lookcomment-parent_id').val(parentId); // скрытое поле для parent_id имеет id="lookcomment-parent_id"
    });
});
JS;
$this->registerJs($js);
?>