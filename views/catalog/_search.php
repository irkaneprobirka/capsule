<?php

use app\models\Age;
use app\models\Gender;
use app\models\Season;
use app\models\Type;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$age = Age::getAge();
$gender = Gender::getGender();
$season = Season::getSeason();
$type = Type::getType();

// Получаем текущие параметры запроса
$currentAgeIds = Yii::$app->request->get('age_id', []);
$currentGenderIds = Yii::$app->request->get('gender_id', []);
$currentSeasonIds = Yii::$app->request->get('season_id', []);
$currentTypeIds = Yii::$app->request->get('type_id', []);

// Функция для проверки, является ли значение активным
function isActive($id, $activeIds) {
    return in_array($id, (array) $activeIds);
}

$this->registerJs("
    $('.btn-check').change(function() {
        $(this).closest('form').submit();
    });
");
?>

<div class="category-buttons">
    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['index'], 'options' => ['data-pjax' => 1]]); ?>

    <div class="d-flex flex-wrap">
        <?php foreach ($age as $id => $name) : ?>
            <?= Html::checkbox('age_id[]', isActive($id, $currentAgeIds), ['id' => 'age-' . $id, 'value' => $id, 'class' => 'btn-check']) ?>
            <label class="btn <?= isActive($id, $currentAgeIds) ? 'btn-warning active' : 'btn-outline-warning' ?> rounded-5 m-2" for="age-<?= $id ?>">
                <?= Html::encode($name) ?>
            </label>
        <?php endforeach; ?>

        <?php foreach ($gender as $id => $name) : ?>
            <?= Html::checkbox('gender_id[]', isActive($id, $currentGenderIds), ['id' => 'gender-' . $id, 'value' => $id, 'class' => 'btn-check']) ?>
            <label class="btn <?= isActive($id, $currentGenderIds) ? 'btn-primary active' : 'btn-outline-primary' ?> rounded-5 m-2" for="gender-<?= $id ?>">
                <?= Html::encode($name) ?>
            </label>
        <?php endforeach; ?>

        <?php foreach ($season as $id => $name) : ?>
            <?= Html::checkbox('season_id[]', isActive($id, $currentSeasonIds), ['id' => 'season-' . $id, 'value' => $id, 'class' => 'btn-check']) ?>
            <label class="btn <?= isActive($id, $currentSeasonIds) ? 'btn-success active' : 'btn-outline-success' ?> rounded-5 m-2" for="season-<?= $id ?>">
                <?= Html::encode($name) ?>
            </label>
        <?php endforeach; ?>

        <?php foreach ($type as $id => $name) : ?>
            <?= Html::checkbox('type_id[]', isActive($id, $currentTypeIds), ['id' => 'type-' . $id, 'value' => $id, 'class' => 'btn-check']) ?>
            <label class="btn <?= isActive($id, $currentTypeIds) ? 'btn-danger active' : 'btn-outline-danger' ?> rounded-5 m-2" for="type-<?= $id ?>">
                <?= Html::encode($name) ?>
            </label>
        <?php endforeach; ?>

        <?= Html::a('Очистить', ['/catalog/index'], ['class' => 'btn btn-primary m-2 rounded-5']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
