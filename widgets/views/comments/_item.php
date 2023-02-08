<?php

/** @var Comments $model */

use app\models\Comments;
?>

<div class="card my-3" style="width: 100%;">
    <div class="card-body">
        <h5 class="card-title">Review by: <?=$model->username?></h5>
        <div class="py-4">
            <?=$model->content?>
        </div>
    </div>
</div>
