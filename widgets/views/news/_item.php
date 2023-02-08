<?php
/** @var News $model */

use app\models\News;
use yii\bootstrap5\Html;
use yii\widgets\Pjax;

?>

<div class="card p-0 m-3" style="width: 18rem;">
    <img class="card-img-top" src="<?= $model->img_path ?>" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title"><?= $model->label ?></h5>
        <p><?= $model->content ?></p>
    </div>
    <div class="mx-auto pb-3">
        <?php Pjax::begin(['enablePushState' => false]) ?>
        <?= Html::beginForm('/news/add-favorite', 'post', ['data' => ['pjax' => true]]) ?>
        <?= Html::submitButton('Add to favorite', ['class' => 'btn btn-outline-secondary mx-2', 'id' => 'addButton']) ?>
        <?= Html::hiddenInput('news_id', $model->id, ['id' => 'newsIdInput']) ?>
        <a href="/news/view/<?= $model->id ?>" class="btn btn-outline-success mx-2" role="button">Go to news</a>
        <?= Html::endForm() ?>
        <?php Pjax::end() ?>
    </div>
</div>