<?php

use app\models\Age;
use app\models\CategoryClothes;
use app\models\CategoryStylist;
use app\models\Clothes;
use app\models\Description;
use app\models\Gender;
use app\models\Season;
use app\models\Type;
use app\models\User;
use yii\bootstrap5\Html;
use yii\helpers\VarDumper;


?>


<div class="d-flex align-items-start m-3">
    <div class="card rounded-3" style="width: 18rem; height: 30rem;">
        <div class="card-body">
            <img src="../../web/src/assets/images/profile/user-1.jpg" alt="" width="90" height="90" class="rounded-circle user-image d-flex justify-content-center m-auto mb-3">
            <h5 class="text-center bg-primary rounded-5 w-50 m-auto p-1 mb-3" style="color: white;"><?= User::findOne($model->user_id)->login ?></h5>
            <h5 class="text-center bg-danger rounded-5 w-50 m-auto p-1 mt-3 mb-3" style="color: white;"><?= CategoryStylist::getStylistCategory()[$model->category_stylist_id]?></h5>
            <h5 class="d-flex justify-content-center m-auto"><?= $model->description ?></h5>
        </div>
    </div>
    <div class="form-check ms-3 mt-3">
        <input class="form-check-input" type="checkbox" name="selectedCards[]" value="<?= $model->user_id ?>" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault"></label>
    </div>
</div>