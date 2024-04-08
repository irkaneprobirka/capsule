<?php

use yii\bootstrap5\Html;

?>

<div class="admin-panel-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>

    <?= Html::a('Управление ролями', ['/admin-panel/stylist'], ['class' => 'btn btn-primary']) ?>

</div>
