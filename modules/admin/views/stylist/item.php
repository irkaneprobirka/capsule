<?php

use app\models\CategoryStylist;
use app\models\Stylist;
use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

use function PHPSTORM_META\type;

?>
<tr class="border border-1">
    <td class="border-bottom-0">
        <h6 class="fw-semibold mb-0"><?= Html::encode($model->id) ?></h6>
    </td>
    <td class="border-bottom-0 w-25">
        <h6 class="fw-semibold mb-1"><?= Html::encode($model->login) ?></h6>
        <span class="fw-normal"><?php
                                $userRoles = Yii::$app->authManager->getRolesByUser($model->id);
                                $roles = '';
                                foreach ($userRoles as $value) {
                                    $roles .= $value->description . ', ';
                                }
                                $roles = rtrim($roles, ', ');
                                echo $roles;
                                ?></span>
    </td>
    <td class="border-bottom-0 w-25">
        <div class="d-flex align-items-center gap-2">
            <?php
            $res = Stylist::find()
                ->where(['user_id' => $model->id])
                ->andWhere(['!=', 'id', $model->id])
                ->count();
            // VarDumper::dump($res, 10, true);
            if ($res) {
                $stylist = Stylist::find()->where(['user_id' => $model->id])->one()->category_stylist_id;
                $category = CategoryStylist::getStylistCategory()[$stylist];
                echo $category;
            } else {
                echo '';
            }
            ?>
        </div>
    </td>
    <td class="border-bottom-0 w-25">
        <div class="d-flex align-items-center gap-2">
            <?=
                Html::a('Назначить роль', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary m-1'])
            ?>
        </div>
    </td>

</tr>