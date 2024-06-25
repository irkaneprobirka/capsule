<?php

use app\models\CategoryStylist;
use app\models\Order;
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
        <h6 class="fw-semibold mb-0"><?= Html::encode(User::findOne($model->stylist_id)->login) ?></h6>
    </td>
    <td class="border-bottom-0">
        <h6 class="fw-semibold mb-0"><?= Html::encode(Status::getStatus()[$model->status_id]) ?></h6>
    </td>
    <td class="border-bottom-0">
        <div class="d-flex align-items-center gap-2">
            <?=
            Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-info m-1'])
            ?>
        </div>
    </td>

</tr>