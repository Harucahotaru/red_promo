<?php

use app\models\Categories;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $categoryId */
/* @var $sort */
?>

<?php Pjax::begin([
    'timeout' => 1000
]); ?>
<?= ListView::widget([
    'dataProvider' => Categories::findPopularCategoriesProvider(),
    'itemView' => '_item',
    'itemOptions' => [
        'tag' => false,
    ],
    'options' => [
        'class' => 'row'
    ],
]);
Pjax::end();
?>
