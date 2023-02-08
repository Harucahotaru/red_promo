<?php
/** @var Categories $category */

/** @var $sort */

use app\models\Categories;
use app\widgets\News;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => '/'];
$this->params['breadcrumbs'][] = $category->name;
?>

<div>
    <h1><?=$category->name?></h1>
    <div>
        <?= Html::beginForm("/categories/$category->id") ?>

        <div class="input-group pt-4 pb-2">

            <div class="input-group-prepend">
                <?= Html::dropDownList('type', null, Categories::getSortList(), [
                    'class' => "btn btn-outline-secondary dropdown-toggle",
                    'data-toggle' => "dropdown"
                ]) ?>

                <?= Html::dropDownList('direction', null, [SORT_ASC => 'Ascending', SORT_DESC => 'Descending'], [
                    'class' => "btn btn-outline-secondary dropdown-toggle",
                    'data-toggle' => "dropdown"
                ]) ?>
            </div>

            <div class="mx-1">
                <?= Html::submitButton('Sort', ['class' => 'btn btn-outline-success']) ?>
            </div>

        </div>

        <?= Html::endForm() ?>
    </div>
    <div>
        <?= News::widget(['categoryId' => $category->id, 'sort' => $sort]) ?>
    </div>
</div>
