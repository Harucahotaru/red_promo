<?php

use app\models\News;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $categoryId */
/* @var $sort */
?>

<?php Pjax::begin([
    'timeout' => 1000
]); ?>
<?= ListView::widget([
    'dataProvider' => News::findFavoriteNewsProvider(),
    'itemView' => '_item',
    'itemOptions' => [
        'tag' => false,
    ],
    'options' => [
        'class' => 'row'
    ],
    'emptyText' => 'There is no news here yet(',
]);
Pjax::end();
?>