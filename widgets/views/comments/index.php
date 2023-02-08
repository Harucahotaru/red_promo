<?php

use app\models\Comments;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $newsId */
?>

<?php Pjax::begin([
    'timeout' => 1000
]); ?>
<?= ListView::widget([
    'dataProvider' => Comments::findByNewsProvider($newsId),
    'itemView'     => '_item',
    'itemOptions'  => [
        'tag' => false,
    ],
    'options'      => [
        'class' => 'row'
    ],
    'emptyText' => 'There are no reviews here yet, but you can be the first)',
    'layout'       => "{pager}\n{items}\n",
]);
Pjax::end();
?>