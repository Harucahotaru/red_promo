<?php

use app\models\News;
use app\widgets\Comments;
use yii\bootstrap5\Html;

/** @var News $news */

$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => '/'];
$this->params['breadcrumbs'][] = ['label' => $news->getCategory()->name, 'url' => "/categories/" . $news->getCategory()->id];
$this->params['breadcrumbs'][] = $news->label;
?>

<div>
    <h1 class="py-2"><?=$news->label?></h1>
    <div class="row">
        <div class="col-lg-4">
            <img src="<?=$news->img_path?>" style="width: 100%">
        </div>
        <div class="col-lg-6"><?=$news->content?></div>
    </div>
    <div class="py-4">
        <h3 class="py-2">Комментарии</h3>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Leave your feedback
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <?= Html::beginForm('/comments/save') ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <?= Html::input('text', 'username', null, ['placeholder' => 'Username', 'class' => 'my-2 py-2 col-lg-12'])?>
                        <?= Html::textarea('content', null, ['placeholder' => 'You feedback'])?>
                        <?= Html::hiddenInput('news_id', $news->id)?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
    <div>
        <?= Comments::widget(['newsId' => $news->id])?>
    </div>
</div>
