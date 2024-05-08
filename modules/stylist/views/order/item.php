<?php

use app\models\CategoryStylist;
use app\models\Status;
use app\models\Stylist;
use app\models\User;
use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

?>
<tr class="border border-1">
    <td class="border-bottom-0">
        <h6 class="fw-semibold mb-0"><?= Html::encode($model->id) ?></h6>
    </td>
    <td class="border-bottom-0">
        <h6 class="fw-semibold mb-0"><?= Html::encode(User::findOne($model->user_id)->login) ?></h6>
    </td>
    <td class="border-bottom-0">
        <h6 class="fw-semibold mb-0"><?= Html::encode(Status::getStatus()[$model->status_id]) ?></h6>
    </td>
    <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <?= $model->status_id == 1
                            ? '<span class="badge bg-info rounded-3 fw-semibold">Средний</span>'
                            : '' ?>
                            <?= $model->status_id == 2
                            ? '<span class="badge bg-danger rounded-3 fw-semibold">Высокий</span>'
                            : '' ?>
                            <?= $model->status_id == 3
                            ? '<span class="badge bg-success rounded-3 fw-semibold">Низкий</span>'
                            : '' ?>
                          </div>
                        </td>
    <td class="border-bottom-0 w-25">
        <div class="d-flex align-items-center gap-2">
            <?= $model->status_id == 1
                ?
                Html::a('Принять в работу', ['deny', 'id' => $model->id], ['class' => 'btn btn-outline-primary m-1'])
                : '' ?>
            <?=
            Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-info m-1'])
            ?>
            <?= $model->status_id == 2
                ? Html::a('Выполнить заказ', ['apply', 'id' => $model->id], ['class' => 'btn btn-outline-primary m-1'])
                : '' ?>
        </div>
    </td>

</tr>