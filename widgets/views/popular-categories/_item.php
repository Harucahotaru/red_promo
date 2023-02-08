<?php

use app\models\Categories;

/** @var Categories $model */
?>

<div class="card my-3" style="width: 100%;">
    <a data-pjax=0 href="/categories/<?= $model->id ?>">
        <div class="card-body">
            <h5 class="card-title">Category: <?= $model->name ?></h5>
        </div>
    </a>
</div>
